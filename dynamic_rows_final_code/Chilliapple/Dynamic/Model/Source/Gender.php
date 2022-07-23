<?php

namespace Chilliapple\Dynamic\Model\Source;

class Gender implements \Magento\Framework\Option\ArrayInterface
{
   public function toOptionArray()
   {
       $yesNoArray[] = [
           'label' => 'Male',
           'value' => 'Male',
       ];
       $yesNoArray[] = [
           'label' => 'Female',
           'value' => 'Female',
       ];
       return $yesNoArray;
   }
}