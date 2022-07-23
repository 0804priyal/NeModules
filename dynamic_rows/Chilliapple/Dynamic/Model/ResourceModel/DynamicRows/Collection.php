<?php
namespace Chilliapple\Dynamic\Model\ResourceModel\DynamicRows;

use  Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {

   protected $_idFieldName = 'id'; 

   protected function _construct() {
   $this->_init('Chilliapple\Dynamic\Model\DynamicRows', 'Chilliapple\Dynamic\Model\ResourceModel\DynamicRows');

   }

}