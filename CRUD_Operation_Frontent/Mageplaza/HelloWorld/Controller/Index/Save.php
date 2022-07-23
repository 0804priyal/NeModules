<?php  

namespace Mageplaza\HelloWorld\Controller\Index;
 
use Magento\Framework\App\Filesystem\DirectoryList;
 
class Save extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
     protected $_postFactory;
     protected $_filesystem;
 
     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Mageplaza\HelloWorld\Model\PostFactory $postFactory,
          \Magento\Framework\Filesystem $filesystem
          )
     {
          $this->_pageFactory = $pageFactory;
          $this->_postFactory = $postFactory;
          $this->_filesystem = $filesystem;
          return parent::__construct($context);
     }
 
     public function execute()
     {
          if ($this->getRequest()->isPost()) {
               $input = $this->getRequest()->getPostValue();
              // print_r($input);
               //die();
               $post = $this->_postFactory->create();
               if (isset($input['post_id'])) {
                    $post_id = $input['post_id'];
               } else {
                    $post_id = 0;
               }
               if($post_id != 0){
                    $post->load($post_id);
                    $post->addData($input);
                    $post->setId($post_id);
                    $post->save();
               }else{
                    $post->setData($input)->save();
               }
               $this->messageManager->addSuccessMessage("Data added successfully!");
               return $this->_redirect('helloworld/index/display');
          }
          return $this->_redirect('helloworld/index/index');
     }
}
