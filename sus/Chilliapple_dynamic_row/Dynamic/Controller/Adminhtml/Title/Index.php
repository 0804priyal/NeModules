<?php

namespace Chilliapple\Dynamic\Controller\Adminhtml\Title;

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
           /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
           $resultPage = $this->resultPageFactory->create();
           $resultPage->setActiveMenu('Chilliapple_Dynamic::dynamic');
           $resultPage->getConfig()->getTitle()->prepend(__('Manage Title'));
           return $resultPage;
    }
}
