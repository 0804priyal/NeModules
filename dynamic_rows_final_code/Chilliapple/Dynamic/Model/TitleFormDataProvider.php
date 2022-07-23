<?php

namespace Chilliapple\Dynamic\Model;

use Chilliapple\Dynamic\Model\ResourceModel\DynamicRows\CollectionFactory;
use Chilliapple\Dynamic\Model\TitleFactory;
use Magento\Store\Model\StoreManagerInterface;
class TitleFormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    // @codingStandardsIgnoreStart
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blogCollectionFactory,
        StoreManagerInterface $storeManager,
        TitleFactory $titleFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $blogCollectionFactory->create();
        $this->_storeManager = $storeManager;
        $this->_titleFactory=$titleFactory;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    // @codingStandardsIgnoreEnd

    public function getData()
    {
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();  
    $request = $objectManager->get('Magento\Framework\App\Request\Http');  
    $id = $request->getParam('id');
        $titleModel = $this->_titleFactory->create()->load($id);
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        $this->loadedData[$id]=$titleModel->getData();
        foreach ($items as $item) {
           $this->loadedData[$id]['dynamic_rows_container'][] = $item->getData();       
        }
 
        return $this->loadedData;
    }
    public function getMediaUrl()
    {
        $mediaUrl = $this->_storeManager->getStore()
                        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl;
    }
}