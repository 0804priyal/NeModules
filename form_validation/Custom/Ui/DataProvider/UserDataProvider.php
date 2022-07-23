<?php

namespace Nethues\Custom\Ui\DataProvider;

use Nethues\Custom\Model\ResourceModel\User\CollectionFactory;

class UserDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Nethues\Custom\Model\ResourceModel\User\Collection
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
