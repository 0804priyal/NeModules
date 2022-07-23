<?php

namespace Chilliapple\Log\Controller\Log;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Context
     */
    protected $context;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
      
    /**
     * 
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        
        $resultPage = $this->resultPageFactory->create();
       // echo "Hello22";
        //die();
		return $resultPage;
    }
}