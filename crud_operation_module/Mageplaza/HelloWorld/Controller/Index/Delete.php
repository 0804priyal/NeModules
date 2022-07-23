<?php  

namespace Mageplaza\HelloWorld\Controller\Index;
 
class Delete extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
     protected $_request;
     protected $_postFactory;
 
     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Magento\Framework\App\Request\Http $request,
          \Mageplaza\HelloWorld\Model\PostFactory $postFactory
          )
     {
          $this->_pageFactory = $pageFactory;
          $this->_request = $request;
          $this->_postFactory = $postFactory;
          return parent::__construct($context);
     }
 
     public function execute()
     {
               $post_id = $this->_request->getParam('post_id');
          $post = $this->_postFactory->create();
          $result = $post->setId($post_id);
          $result = $result->delete();
          return $this->_redirect('helloworld/index/display');
     }
}
