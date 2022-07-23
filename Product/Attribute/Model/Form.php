<?php
namespace Product\Attribute\Model;

class Form extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'hide_add_to_cart';

    /**
     * @var string
     */
    protected $_eventObject = 'hide_add_to_cart';

    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Product\Attribute\Model\ResourceModel\Form');
    }
}
