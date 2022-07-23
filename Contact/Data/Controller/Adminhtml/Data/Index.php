<?php

namespace Contact\Data\Controller\Adminhtml\Data;

class Index extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
         $resultRedirect = $this->resultRedirectFactory->create();
         //echo "Hello";
         //die();
           /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
           $resultPage = $this->resultPageFactory->create();
           $resultPage->setActiveMenu('Contact_Data::contact');
           $resultPage->getConfig()->getTitle()->prepend(__('Manage Contact'));
           return $resultPage;
    }
}
