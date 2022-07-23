<?php
/**
 * @package   SK\DynamicFields
 * @author    Kishan Savaliya <kishansavaliyakb@gmail.com>
 */

namespace SK\DynamicFields\Block\Adminhtml\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;

class DynamicFields extends AbstractFieldArray
{
    private $_dropdownFieldRenderer;

    protected function _prepareToRender()
    {
        $this->addColumn(
            'text_field',
            [
                'label' => __('Text Field'),
                'class' => 'required-entry'
            ]
        );
        $this->addColumn(
            'email_field',
            [
                'label' => __('Email'),
                'class' => 'required-entry validate-email'
            ]
        );
        $this->addColumn(
            'dropdown_field',
            [
                'label' => __('Dropdown Field'),
                'renderer' => $this->getDropdownFieldRenderer(),
                'class' => 'required-entry'
            ]
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add New Row');
    }

    protected function _prepareArrayRow(DataObject $row)
    {
        $options = [];
        $dropdownField = $row->getDropdownField();
        if ($dropdownField !== null)
        {
            $options['option_' . $this->getDropdownFieldRenderer()->calcOptionHash($dropdownField)] = 'selected="selected"';
        }
        $row->setData('option_extra_attrs', $options);
    }

    private function getDropdownFieldRenderer()
    {
        if (!$this->_dropdownFieldRenderer)
        {
            $this->_dropdownFieldRenderer = $this->getLayout()->createBlock(
                CustomOptions::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]);
        }
        return $this->_dropdownFieldRenderer;
    }
}