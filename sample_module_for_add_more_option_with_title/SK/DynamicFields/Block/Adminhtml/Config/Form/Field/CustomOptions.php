<?php
/**
 * @package   SK\DynamicFields
 * @author    Kishan Savaliya <kishansavaliyakb@gmail.com>
 */

namespace SK\DynamicFields\Block\Adminhtml\Config\Form\Field;

use Magento\Framework\View\Element\Html\Select;

class CustomOptions extends Select
{
    public function setInputName($value)
    {
        return $this->setName($value);
    }
    
    public function setInputId($value)
    {
        return $this->setId($value);
    }
    
    public function _toHtml()
    {
        if (!$this->getOptions())
        {
            $this->setOptions($this->getDropdownOptions());
        }
        return parent::_toHtml();
    }

    private function getDropdownOptions()
    {
        $options = [
            ['label' => 'Option 1', 'value' => '1'],
            ['label' => 'Option 2', 'value' => '2'],
            ['label' => 'Option 3', 'value' => '3'],
            ['label' => 'Option 4', 'value' => '4'],
            ['label' => 'Option 5', 'value' => '5'],
        ];
        return $options;
    }
}