<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Nethues\ProductInfo\Controller\Index;

 use Magento\Framework\App\Action\Action;
 use Magento\Framework\App\Action\Context;
 use Magento\Framework\View\Result\PageFactory;

 class SavePost extends Action
  {
protected $resultPageFactory;

public function __construct(Context $context, PageFactory $pageFactory)
{
    $this->resultPageFactory = $pageFactory;
    parent::__construct($context);
}

public function execute()
{
   echo "hello from the controller";
   exit();
    $resultPage = $this->resultPageFactory->create();

    return $resultPage;
}
}
