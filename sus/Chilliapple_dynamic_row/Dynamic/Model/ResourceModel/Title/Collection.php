<?php

namespace Chilliapple\Dynamic\Model\ResourceModel\Title;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init('Chilliapple\Dynamic\Model\Title', 'Chilliapple\Dynamic\Model\ResourceModel\Title');
    }
}
