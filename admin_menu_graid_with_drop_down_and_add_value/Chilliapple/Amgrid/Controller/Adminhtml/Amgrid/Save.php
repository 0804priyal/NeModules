<?php

namespace Chilliapple\Amgrid\Controller\Adminhtml\Amgrid;

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
     * @param Amgrid           $uiExamplemodel
     * @param Session        $adminsession
     */
    public function __construct(
        Action\Context $context,
        \Chilliapple\Amgrid\Model\AmgridFactory $amgridFactory,
        \Chilliapple\Amgrid\Model\ResourceModel\Amgrid $amgridResourceModel,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->amgridFactory = $amgridFactory;
        $this->amgridResourceModel = $amgridResourceModel;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->adminsession = $adminsession;
     
    }

    /**
     * Save Amgrid record action
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
            'title' => $postData["title"],
        ];

        $title_id = $this->getRequest()->getParam('id');
        if ($data) {
            $userData = $this->amgridFactory->create();
            if ($title_id) {
                $userData->load($title_id);
                $data = [
                    'id' => $title_id,
                    'title' => $postData["title"],
                
                ];
            }
            $userData->setData($data);
            try {
                $this->amgridResourceModel->save($userData);
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return   $resultRedirectFactory->setPath('*/*/add');
                    } else {
                        return   $resultRedirectFactory->setPath('*/*/edit', ['id' => $userData->getTitleId(), '_current' => true]);
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
