<?php

namespace Chilliapple\Log\Ui\DataProvider;

use Chilliapple\Log\Model\ResourceModel\Log\CollectionFactory;

class LogDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Chilliapple\Log\Model\ResourceModel\Log\Collection
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
