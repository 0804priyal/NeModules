<?php

namespace Chilliapple\Dynamic\Model\ResourceModel; 

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class DynamicRows extends AbstractDb
{   
   protected function _construct()
   {
       $this->_init('dynamicrows', 'id');
   }

   public function deleteDynamicRows()
   {
       $connection = $this->getConnection();
       $connection->delete($this->getMainTable(), ['id > ?' => 0]);
   }
}