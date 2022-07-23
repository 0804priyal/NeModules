<?php

namespace Cloudways\Newmodule\Model\ResourceModel\Data;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init('Cloudways\Newmodule\Model\Data', 'Cloudways\Newmodule\Model\ResourceModel\Data');
    }
}
