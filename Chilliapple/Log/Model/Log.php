<?php
namespace Chilliapple\Log\Model;

class Log extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'log';

    /**
     * @var string
     */
    protected $_eventObject = 'log';

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
        $this->_init('Chilliapple\Log\Model\ResourceModel\Log');
    }
}
