<?php

namespace Nethues\Custom\Controller\Adminhtml\User;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;


class Save extends \Magento\Backend\App\Action
{


    protected $uiExamplemodel;

    /**
     * @var Session
     */
    protected $adminsession;

    /**
     * @param Action\Context $context
     * @param Blog           $uiExamplemodel
     * @param Session        $adminsession
     */
    public function __construct(
        Action\Context $context,
        \Nethues\Custom\Model\UserFactory $userFactory,
        \Nethues\Custom\Model\ResourceModel\User $userResourceModel,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        Session $adminsession,
        \Nethues\Custom\Model\ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->userFactory = $userFactory;
        $this->userResourceModel = $userResourceModel;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->adminsession = $adminsession;
        $this->imageUploader = $imageUploader;
     
    }

    /**
     * Save blog record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirectFactory = $this->resultRedirectFactory->create();
        $postData = $this->getRequest()->getPostValue();

        $image = (isset($postData['image']['0']['name'])) ? $postData['image']['0']['name'] : null;
        //$driver->setImage($data['image']['0']['name']);
        if ($image !== null) {
            try {
                //$imageUploader = \Magento\Framework\App\ObjectManager::getInstance()->get('DriverImageUpload');
                $imageUploader = $this->imageUploader;
                if (isset($postData['image']['0']['tmp_name'])) {
                    $imageUploader->moveFileFromTmp($image);
                }
            } catch(\Exception $e) {
                $this->getMessageManager()->addErrorMessage($e->getMessage());
            }
        }
       
        $postData['image'] = $image;
        // echo "<pre>";
        // print_r($postData);
        // die(__FILE__);
        $data = [
            'first_name' => $postData["first_name"],
            'last_name' => $postData["last_name"],
            'email' => $postData["email"],
            'contact_number' => $postData["contact_number"],
            'other_details' => $postData["other_details"],
            'status'=> $postData['status'],
            'image'=>$postData['image'] 
            
        ];

        $blog_id = $this->getRequest()->getParam('id');
        if ($data) {
            $userData = $this->userFactory->create();
            if ($blog_id) {
                $userData->load($blog_id);
                $data = [
                    'id' => $blog_id,
                    'first_name' => $postData["first_name"],
                    'last_name' => $postData["last_name"],
                    'email' => $postData["email"],
                    'contact_number' => $postData["contact_number"],
                    'other_details' => $postData["other_details"],
                    'status'=> $postData['status'],
                    'image'=>$postData['image'] 
                    
                ];
            }
            $userData->setData($data);
            try {
                $this->userResourceModel->save($userData);
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return   $resultRedirectFactory->setPath('*/*/add');
                    } else {
                        return   $resultRedirectFactory->setPath('*/*/edit', ['id' => $userData->getBlogId(), '_current' => true]);
                    }
                }
                return   $resultRedirectFactory->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                die($e);
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }
            $this->_getSession()->setFormData($data);
            return   $resultRedirectFactory->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return   $resultRedirectFactory->setPath('*/*/');
    }
}
