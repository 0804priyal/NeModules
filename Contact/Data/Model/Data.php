<?php
namespace Contact\Data\Model;

class Data extends \Magento\Framework\Model\AbstractModel
{

    protected function _construct()
    {
        $this->_init('Contact\Data\Model\ResourceModel\Data');
    }

}
