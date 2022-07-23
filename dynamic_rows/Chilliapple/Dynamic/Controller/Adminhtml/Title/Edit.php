<?php

namespace Chilliapple\Dynamic\Controller\Adminhtml\Title;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        //$postData = $this->getRequest()->getPostValue();
        //$id = $this->getRequest()->getParam('id');
        //echo $id;
        //die();

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Record'));
        return $resultPage;
    }
}