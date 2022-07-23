<?php
namespace Chilliapple\Dynamic\Model\ResourceModel;

class Title extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    const KEY_DYNAMICTITLE = 'dynamictitle';
    const KEY_DYNAMICTITLE_ID = 'id';

    /**
     * construct
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            self::KEY_DYNAMICTITLE,
            self::KEY_DYNAMICTITLE_ID
        );
    }
}
