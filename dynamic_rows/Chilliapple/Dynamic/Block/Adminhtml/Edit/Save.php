<?php
 
namespace Chilliapple\Dynamic\Block\Adminhtml\Edit;
 
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\CatalogRule\Block\Adminhtml\Edit\GenericButton;
 
class Save extends GenericButton implements ButtonProviderInterface
 
{
 
    public function getButtonData()
 
    {
        $url = $this->getUrl('dynamic/title/save');
        return [
 
            'label' => __('Save'),
 
            'class' => 'save primary',
 
            'data_attribute' => [
 
                'mage-init' => ['button' => ['event' => 'save']],
 
                'form-role' => 'save',
 
            ],
 
            'sort_order' => 90,
 
        ];
 
    }
 
}