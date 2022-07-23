<?php

namespace Chilliapple\Log\Controller\Adminhtml\Log;

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
        \Chilliapple\Log\Model\LogFactory $logFactory,
        \Chilliapple\Log\Model\ResourceModel\Log $logResourceModel,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->logFactory = $logFactory;
        $this->logResourceModel = $logResourceModel;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->adminsession = $adminsession;
     
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
        // echo "<pre>";
        // print_r($postData);
        // die(__FILE__);
        $data = [
            'log' => $postData["log"],
            'comment' => $postData["comment"]            
        ];

        $blog_id = $this->getRequest()->getParam('id');
        if ($data) {
            $userData = $this->logFactory->create();
            if ($blog_id) {
                $userData->load($blog_id);
                $data = [
                    'id' => $blog_id,
                    'log' => $postData["log"],
                    'comment' => $postData["comment"]
                
                ];
            }
            $userData->setData($data);
            try {
                $this->logResourceModel->save($userData);
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
