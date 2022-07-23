<?php
namespace Cloudways\Newmodule\Model;

class Data extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'newmodule';

    /**
     * @var string
     */
    protected $_eventObject = 'newmodule';

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
        $this->_init('Cloudways\Newmodule\Model\ResourceModel\Data');
    }
}
