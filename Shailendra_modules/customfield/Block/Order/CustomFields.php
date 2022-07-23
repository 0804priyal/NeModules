<?php
/**
 * CustomFields Block.
 *
 * @package   Sv\CheckoutCustomForm
 * @author    Slawomir Sv <slawek.Sv@gmail.com>
 * @copyright © 2017 Slawomir Sv
 * @license   See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Sv\CheckoutCustomForm\Block\Order;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\Sales\Model\Order;
use Sv\CheckoutCustomForm\Api\Data\CustomFieldsInterface;
use Sv\CheckoutCustomForm\Api\CustomFieldsRepositoryInterface;

/**
 * Class CustomFields
 *
 * @category Block/Order
 * @package  Sv\CheckoutCustomForm\Block
 */
class CustomFields extends Template
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry = null;

    /**
     * CustomFieldsRepositoryInterface
     *
     * @var CustomFieldsRepositoryInterface
     */
    protected $customFieldsRepository;

    /**
     * CustomFields constructor.
     *
     * @param Context                         $context                Context
     * @param Registry                        $registry               Registry
     * @param CustomFieldsRepositoryInterface $customFieldsRepository CustomFieldsRepositoryInterface
     * @param array                           $data                   Data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        CustomFieldsRepositoryInterface $customFieldsRepository,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->customFieldsRepository = $customFieldsRepository;
        $this->_isScopePrivate = true;
        $this->_template = 'order/view/custom_fields.phtml';
        parent::__construct($context, $data);
    }

    /**
     * Get current order
     *
     * @return Order
     */
    public function getOrder() : Order
    {
        return $this->coreRegistry->registry('current_order');
    }

    /**
     * Get checkout custom fields
     *
     * @param Order $order Order
     *
     * @return CustomFieldsInterface
     */
    public function getCustomFields(Order $order)
    {
        return $this->customFieldsRepository->getCustomFields($order);
    }
}
