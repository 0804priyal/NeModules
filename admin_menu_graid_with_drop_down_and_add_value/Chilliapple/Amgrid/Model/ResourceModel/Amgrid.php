<?php
namespace Chilliapple\Amgrid\Model\ResourceModel;

class Amgrid extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    const KEY_LOG = 'amgrid_title';
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
