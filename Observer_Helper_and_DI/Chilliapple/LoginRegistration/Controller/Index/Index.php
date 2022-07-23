<?php

namespace Chilliapple\LoginRegistration\Controller\Index;

use Magento\Framework\App\Action\Action;

use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{

      protected $pageFactory;

      public function __construct(
         \Magento\Framework\App\Action\Context $context,
         \Magento\Framework\View\Result\PageFactory $pageFactory
      ){
          parent::__construct($context);
          $this->pageFactory  = $pageFactory;
      }

      public function execute()
      {
          $page = $this->pageFactory->create();
          return $page;
      }
}