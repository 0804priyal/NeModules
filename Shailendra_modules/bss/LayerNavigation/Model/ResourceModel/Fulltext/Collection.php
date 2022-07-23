<?php
/**
 * BSS Commerce Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://bsscommerce.com/Bss-Commerce-License.txt
 *
 * @category  BSS
 * @package   Bss_LayerNavigation
 * @author    Extension Team
 * @copyright Copyright (c) 2018-2019 BSS Commerce Co. ( http://bsscommerce.com )
 * @license   http://bsscommerce.com/Bss-Commerce-License.txt
 */

namespace Bss\LayerNavigation\Model\ResourceModel\Fulltext;

use Magento\Framework\App\ObjectManager;

/**
 * Class Collection full text
 *
 * @SuppressWarnings(PHPMD.CookieAndSessionMisuse)
 */
class Collection extends \Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection
{
    /**
     * @var \Bss\LayerNavigation\Helper\Data
     */
    private $helper;

    /**
     * @var array
     */
    protected $addedFilters = [];

    /**
     * @var \Magento\Framework\Api\Search\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    private $filterBuilder;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->helper = ObjectManager::getInstance()
            ->get(\Bss\LayerNavigation\Helper\Data::class);
        parent::_construct();
    }

    /**
     * Apply attribute filter to facet collection
     *
     * @param string $field
     * @param null $condition
     * @return $this
     */
    public function addFieldToFilter($field, $condition = null)
    {
        if (is_string($field)) {
            $this->addedFilters[$field] = $condition;
        }
        if (is_string($field)) {
            $this->addedFilters[$field] = $condition;
        }
        $this->getSearchCriteriaBuilder();
        $this->getFilterBuilder();
        if (!is_array($condition) || !in_array(key($condition), ['from', 'to'], true)) {
            $this->filterBuilder->setField($field);
            $this->filterBuilder->setValue($condition);
            $this->searchCriteriaBuilder->addFilter($this->filterBuilder->create());
        } else {
            if (!empty($condition['from'])) {
                $this->filterBuilder->setField("{$field}.from");
                $this->filterBuilder->setValue($condition['from']);
                $this->searchCriteriaBuilder->addFilter($this->filterBuilder->create());
            }
            if (!empty($condition['to'])) {
                $this->filterBuilder->setField("{$field}.to");
                $this->filterBuilder->setValue($condition['to']);
                $this->searchCriteriaBuilder->addFilter($this->filterBuilder->create());
            }
        }
        return $this;
    }

    /**
     * Get filter builder.
     *
     * @deprecated 100.1.0
     * @return \Magento\Framework\Api\FilterBuilder
     */
    private function getFilterBuilder()
    {
        if ($this->filterBuilder === null) {
            $this->filterBuilder = ObjectManager::getInstance()->get(\Magento\Framework\Api\FilterBuilder::class);
        }
        return $this->filterBuilder;
    }

    /**
     * Set search criteria builder.
     *
     * @deprecated 100.1.0
     * @return \Magento\Framework\Api\Search\SearchCriteriaBuilder
     */
    private function getSearchCriteriaBuilder()
    {
        if ($this->searchCriteriaBuilder === null) {
            $this->searchCriteriaBuilder = ObjectManager::getInstance()
                ->get(\Magento\Framework\Api\Search\SearchCriteriaBuilder::class);
        }
        return $this->searchCriteriaBuilder;
    }

    /**
     * @param array $categoriesFilter
     * @return \Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection
     */
    public function addCategoriesFilter(array $categoriesFilter)
    {
        if (!empty($categoriesFilter['in'])) {
            $this->addedFilters['category_ids'] = $categoriesFilter['in'];
        }
        return parent::addCategoriesFilter($categoriesFilter);
    }

    /**
     *
     * @param array $condition
     *
     */
    public function multipleCategoriesFilter($condition)
    {
        if ($this->helper->isElasticSearchEngine()) {
            $this->addFieldToFilter('category_ids', $condition);
        } else {
            if (!is_array($condition)) {
                $condition = [$condition];
            }
            $countCondition = count($condition);
            if ($countCondition > 1) {
                $this->addCategoriesFilter(['in' => $condition]);
            } else {
                $this->addFieldToFilter('category_ids', implode(',', $condition));
            }
        }
    }

    /**
     * Get applied filters
     *
     * @return array
     */
    public function getAddedFilters()
    {
        return $this->addedFilters;
    }

    /**
     * @return $this
     */
    public function updateSearchCriteriaBuilder()
    {
        $searchCriteriaBuilder = ObjectManager::getInstance()
            ->create(\Magento\Framework\Api\Search\SearchCriteriaBuilder::class);
        $this->setSearchCriteriaBuilder($searchCriteriaBuilder);
        return $this;
    }

    /**
     * @return \Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection
     */
    protected function _prepareStatisticsData()
    {
        $this->_renderFilters();
        return parent::_prepareStatisticsData();
    }
}
