<?php
namespace Chilliapple\Dynamic\Controller\Adminhtml\Title;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $uiExamplemodel;
    protected $dynamicRowResource;

    /**
     * @var Session
     */
    protected $adminsession;

    /**
     * @param Action\Context $context
     * @param Btitle           $uiExamplemodel
     * @param Session        $adminsession
     */
    public function __construct(
        Action\Context $context,
        \Chilliapple\Dynamic\Model\TitleFactory $titleFactory,
        \Chilliapple\Dynamic\Model\ResourceModel\Title $titleResourceModel,
        \Chilliapple\Dynamic\Model\DynamicRowsFactory $dynamicRowFactory,
        \Chilliapple\Dynamic\Model\ResourceModel\DynamicRowsFactory $dynamicRowResource,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->titleFactory = $titleFactory;
        $this->titleResourceModel = $titleResourceModel;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->adminsession = $adminsession;
        $this->dynamicRow = $dynamicRowFactory;
        $this->dynamicRowResource = $dynamicRowResource;
     
    }

    /**
     * Save btitle record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirectFactory = $this->resultRedirectFactory->create();
        $postData = $this->getRequest()->getPostValue();        
 
        $data = [
            'title' => $postData["title"],
        ];

        $id = $this->getRequest()->getParam('id');
        if(!empty($id)){
             $objectManager = \Magento\Framework\App\ObjectManager::getInstance();  
             $resource = $objectManager->get('Magento\Framework\App\ResourceConnection'); 
             $connection  = $resource->getConnection();
              $tableName = $connection->getTableName('dynamicrows');
              $whereConditions = [
                  $connection->quoteInto('title_id = ?', $id),
              ];

              $deleteRows = $connection->delete($tableName, $whereConditions);
        }
      //echo $id; exit;
        if ($data) {
            $userData = $this->titleFactory->create();
            if ($id) {
                $userData->load($id);
                $data = [
                    'id' => $id,
                    'title' => $postData["title"]                
                ];
            }
            $userData->setData($data);  

            try {
                $this->titleResourceModel->save($userData);
                
                // Dynamic Rows Save code //

                $dynamicRowData = $this->getRequest()->getParam('dynamic_rows_container');
                if (is_array($dynamicRowData) && !empty($dynamicRowData)) {
                   foreach ($dynamicRowData as $dynamicRowDatum) {
                        $dynamicRowDatum['title_id'] = $userData->getId();
                        $model = $this->dynamicRow->create();
                        unset($dynamicRowDatum['id']);
                        $model->addData($dynamicRowDatum);
                        $model->save();
                    }
                }
                $this->messageManager->addSuccess(__('The data has been saved.'));

                $this->adminsession->setFormData(false);
                
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return   $resultRedirectFactory->setPath('*/*/add');
                    } else {
                        return   $resultRedirectFactory->setPath('*/*/edit', ['id' => $userData->getId(), '_current' => true]);
                    }
                }
                return   $resultRedirectFactory->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                die($e);
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }
            $this->_getSession()->setFormData($data);
            return   $resultRedirectFactory->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return   $resultRedirectFactory->setPath('*/*/');
    }
}
