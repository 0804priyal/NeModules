<?php

namespace Chilliapple\Dynamic\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = array(
            '0'=> 'New Title',
            '1' => 'Enable',
            '2' => 'Disable'
        );
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => __($value),
                'value' => $key,
            ];
        }
        return $options;
    }
}
