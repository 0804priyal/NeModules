<?php
namespace Contact\Data\Model\ResourceModel\Data;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	
	protected function _construct()
	{
		$this->_init('Contact\Data\Model\Data', 'Contact\Data\Model\ResourceModel\Data');
	}

}
