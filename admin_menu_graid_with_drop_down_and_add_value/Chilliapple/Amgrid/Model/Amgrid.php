<?php
namespace Chilliapple\Amgrid\Model;

class Amgrid extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'amgrid_title';

    /**
     * @var string
     */
    protected $_eventObject = 'amgrid_title';

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
        $this->_init('Chilliapple\Amgrid\Model\ResourceModel\Amgrid');
    }
}
