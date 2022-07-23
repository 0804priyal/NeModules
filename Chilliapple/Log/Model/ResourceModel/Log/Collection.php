<?php

namespace Chilliapple\Log\Model\ResourceModel\Log;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init('Chilliapple\Log\Model\Log', 'Chilliapple\Log\Model\ResourceModel\Log');
    }
}
