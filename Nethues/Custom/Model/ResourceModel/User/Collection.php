<?php

namespace Nethues\Custom\Model\ResourceModel\User;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init('Nethues\Custom\Model\User', 'Nethues\Custom\Model\ResourceModel\User');
    }
}
