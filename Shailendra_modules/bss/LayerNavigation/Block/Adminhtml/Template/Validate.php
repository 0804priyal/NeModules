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
namespace Bss\LayerNavigation\Block\Adminhtml\Template;

class Validate extends \Magento\Backend\Block\Template
{
    /**
     * @var \Bss\LayerNavigation\Helper\Data
     */
    protected $moduleHelper;

    /**
     * Validate constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Bss\LayerNavigation\Helper\Data $moduleHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Bss\LayerNavigation\Helper\Data $moduleHelper,
        array $data = []
    ) {
        $this->moduleHelper = $moduleHelper;
        parent::__construct($context, $data);
    }

    /**
     * @return \Bss\LayerNavigation\Helper\Data
     */
    public function getModuleHelper()
    {
        return $this->moduleHelper;
    }
}
