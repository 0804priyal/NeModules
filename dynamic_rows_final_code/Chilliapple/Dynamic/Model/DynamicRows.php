<?php

namespace Chilliapple\Dynamic\Model;

use Magento\Framework\Model\AbstractModel;

class DynamicRows extends AbstractModel
{
   const CACHE_TAG = 'dynamicrows';
   protected $_cacheTag = 'dynamicrows';
   protected $_eventPrefix = 'dynamicrows'; 

   protected function _construct()
   {
     $this->_init('Chilliapple\Dynamic\Model\ResourceModel\DynamicRows');
   }
}