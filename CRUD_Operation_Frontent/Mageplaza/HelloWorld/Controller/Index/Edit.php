<?php
 
namespace Mageplaza\HelloWorld\Controller\Index;
 
class Edit extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
     protected $_postFactory;
     protected $_request;
     protected $_coreRegistry;
 
     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Magento\Framework\App\Request\Http $request,
          \Mageplaza\HelloWorld\Model\PostFactory $postFactory,
          \Magento\Framework\Registry $coreRegistry
     ){
          $this->_pageFactory = $pageFactory;
          $this->_postFactory = $postFactory;
          $this->_request = $request;
          $this->_coreRegistry = $coreRegistry;
          return parent::__construct($context);
     }
 
     public function execute()
     {
        $post_id = $this->_request->getParam('post_id');

        //echo $post_id;
       // die();
        $this->_coreRegistry->register('post_id', $post_id);
          return $this->_pageFactory->create();
     }
}
