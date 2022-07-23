<?php

namespace Chilliapple\Dynamic\Ui\DataProvider;

use Chilliapple\Dynamic\Model\ResourceModel\Title\CollectionFactory;

class TitleDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Chilliapple\Dynamic\Model\ResourceModel\Title\Collection
     */
    protected $collection;
    /**
     * @var array
     */
    protected $addFieldStrategies;
    /**
     * @var array
     */
    protected $addFilterStrategies;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $addFieldStrategies
     * @param array $addFilterStrategies
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $addFieldStrategies = [],
        array $addFilterStrategies = [],
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->addFieldStrategies = $addFieldStrategies;
        $this->addFilterStrategies = $addFilterStrategies;
    }
}
