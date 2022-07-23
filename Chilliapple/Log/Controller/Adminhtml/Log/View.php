<?php

namespace Chilliapple\Log\Controller\Adminhtml\Log;

use Magento\Framework\Controller\ResultFactory;

class View extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Log Profile Details'));
        return $resultPage;
    }
}