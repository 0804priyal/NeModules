<?php
namespace Chilliapple\Dynamic\Model;

class Title extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'dynamictitle';

    /**
     * @var string
     */
    protected $_eventObject = 'dynamictitle';

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
        $this->_init('Chilliapple\Dynamic\Model\ResourceModel\Title');
    }
}
