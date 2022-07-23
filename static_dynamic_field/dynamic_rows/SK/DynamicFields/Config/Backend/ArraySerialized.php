<?php
/**
 * @package   SK\DynamicFields
 * @author    Kishan Savaliya <kishansavaliyakb@gmail.com>
 */

namespace SK\DynamicFields\Config\Backend;

use Magento\Framework\App\Config\Value as ConfigValue;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Serialize\SerializerInterface;

class ArraySerialized extends ConfigValue
{    
    protected $_serializer;
    
    public function __construct(
        Context $context,
        Registry $registry,
        ScopeConfigInterface $config,
        TypeListInterface $cacheTypeList,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        SerializerInterface $serializer,
        array $data = []
    ) {
        $this->_serializer = $serializer;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    public function beforeSave()
    {
        $value = $this->getValue();
        unset($value['__empty']);
        $encodedValue = $this->_serializer->serialize($value);
        $this->setValue($encodedValue);
    }

    protected function _afterLoad()
    {
        $value = $this->getValue();
        if ($value)
        {
            $decodedValue = $this->_serializer->unserialize($value);
            $this->setValue($decodedValue);
        }
    }
}