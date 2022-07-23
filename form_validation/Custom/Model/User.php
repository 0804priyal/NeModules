<?php
namespace Nethues\Custom\Model;

class User extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'custom_user_details_table';

    /**
     * @var string
     */
    protected $_eventObject = 'user_details';

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
        $this->_init('Nethues\Custom\Model\ResourceModel\User');
    }
}
