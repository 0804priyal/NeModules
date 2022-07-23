<?php
namespace Nethues\Custom\Model\ResourceModel;

class User extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    const KEY_CUSTOM_USER_DETAILS_TABLE = 'custom_user_details_table';
    const KEY_CUSTOM_USER_DETAILS_TABLE_ID = 'id';

    /**
     * construct
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            self::KEY_CUSTOM_USER_DETAILS_TABLE,
            self::KEY_CUSTOM_USER_DETAILS_TABLE_ID
        );
    }
}
