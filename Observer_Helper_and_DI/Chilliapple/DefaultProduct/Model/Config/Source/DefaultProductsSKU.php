<?php

namespace Chilliapple\DefaultProduct\Model\Config\Source;

class DefaultProductsSKU implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'product1', 'label' => __('product1')],
            ['value' => 'product2', 'label' => __('product2')],
            ['value' => 'product3', 'label' => __('product3')],
            ['value' => 'product4', 'label' => __('product4')]
        ];
    }
}

?>