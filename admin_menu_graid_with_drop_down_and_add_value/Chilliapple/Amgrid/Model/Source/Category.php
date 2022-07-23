<?php
namespace Chilliapple\Amgrid\Model\Source;
 
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;
 
class Category implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
 
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }
 
    public function toOptionArray()
    {
        $options[] = ['label' => '-- Please Select --', 'value' => ''];
        $collection = $this->collectionFactory->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_active', '1');
 
        foreach ($collection as $category) {
            $options[] = [
                'label' => $category->getName(),
                'value' => $category->getId(),
            ];
        }
 
        return $options;
    }
}