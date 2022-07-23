<?php
namespace Chilliapple\Log\Model\ResourceModel;

class Log extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    const KEY_LOG = 'log';
    const KEY_LOG_ID = 'id';

    /**
     * construct
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            self::KEY_LOG,
            self::KEY_LOG_ID
        );
    }
}
