<?php

namespace Contact\Data\Controller\Adminhtml\Data;

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
        \Contact\Data\Model\DataFactory $dataFactory,
        \Contact\Data\Model\ResourceModel\Data $dataResourceModel,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->dataFactory = $dataFactory;
        $this->dataResourceModel = $dataResourceModel;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->adminsession = $adminsession;
     
    }

    /**
     * Save Data record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirectFactory = $this->resultRedirectFactory->create();
        $postData = $this->getRequest()->getPostValue();        
        // echo "<pre>";
        // print_r($postData);
        // die(__FILE__);
        $data = [
            'name' => $postData["name"],
            'email' => $postData["email"],
            'telephone' => $postData["telephone"],
            'comment' => $postData["comment"]            
        ];

        $blog_id = $this->getRequest()->getParam('id');
        if ($data) {
            $userData = $this->dataFactory->create();
            if ($blog_id) {
                $userData->load($blog_id);
                $data = [
                    'id' => $blog_id,
                    'name' => $postData["name"],
                    'email' => $postData["email"],
                    'telephone' => $postData["telephone"],
                    'comment' => $postData["comment"]
                
                ];
            }
            $userData->setData($data);
            try {
                $this->dataResourceModel->save($userData);
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
