<?php
namespace Product\Attribute\Model\ResourceModel;

class Form extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    const KEY_HIDE_ADD_TO_CART = 'hide_add_to_cart';
    const KEY_HIDE_ADD_TO_CART_ID = 'id';

    /**
     * construct
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            self::KEY_HIDE_ADD_TO_CART,
            self::KEY_HIDE_ADD_TO_CART_ID
        );
    }
}
