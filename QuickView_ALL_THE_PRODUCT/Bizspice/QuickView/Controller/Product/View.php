<?php
namespace Bizspice\QuickView\Controller\Product;
class View extends \Magento\Catalog\Controller\Product\View
{
    public function execute()
    {
        if ($this->getRequest()->getParam("iframe")) {
            $layout = $this->_view->getLayout();
            $layout->getUpdate()->addHandle('product_quickview');
        }
        return parent::execute();
    }
}