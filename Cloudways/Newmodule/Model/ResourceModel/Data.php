<?php
namespace Cloudways\Newmodule\Model\ResourceModel;

class Data extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    const KEY_NEWMODULE = 'newmodule';
    const KEY_NEWMODULE_ID = 'id';

    /**
     * construct
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            self::KEY_NEWMODULE,
            self::KEY_NEWMODULE_ID
        );
    }
}
