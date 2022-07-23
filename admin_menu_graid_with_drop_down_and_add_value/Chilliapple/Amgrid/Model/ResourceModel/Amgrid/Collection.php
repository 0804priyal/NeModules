<?php

namespace Chilliapple\Amgrid\Model\ResourceModel\Amgrid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init('Chilliapple\Amgrid\Model\Amgrid', 'Chilliapple\Amgrid\Model\ResourceModel\Amgrid');
    }
}
