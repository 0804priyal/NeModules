<?php
 
namespace Mageplaza\HelloWorld\Block;
 
class Edit extends \Magento\Framework\View\Element\Template
{
     protected $_pageFactory;
     protected $_coreRegistry;
     protected $_contactLoader;
 
     public function __construct(
          \Magento\Framework\View\Element\Template\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Magento\Framework\Registry $coreRegistry,
          \Mageplaza\HelloWorld\Model\PostFactory $contactLoader,
          array $data = []
     ){
          $this->_pageFactory = $pageFactory;
          $this->_coreRegistry = $coreRegistry;
          $this->_contactLoader = $contactLoader;
          return parent::__construct($context,$data);
     }
 
     public function execute()
     {
          return $this->_pageFactory->create();
     }
 
     public function getEditData()
     {
          $post_id = $this->_coreRegistry->registry('post_id');
          //echo $post_id;
          //die();
          $postData = $this->_contactLoader->create();
          $result = $postData->load($post_id);
          $result = $result->getData();
          //print_r($result);
         // die(); 
          return $result;
     }
}