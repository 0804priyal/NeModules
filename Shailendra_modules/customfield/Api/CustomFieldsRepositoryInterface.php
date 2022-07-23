<?php
/**
 * Checkout custom fields repository interface
 *
 * @package   Sv\CheckoutCustomForm
 * @author    Slawomir Sv <slawek.Sv@gmail.com>
 * @copyright © 2017 Slawomir Sv
 * @license   See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Sv\CheckoutCustomForm\Api;

use Magento\Sales\Model\Order;
use Sv\CheckoutCustomForm\Api\Data\CustomFieldsInterface;

/**
 * Interface CustomFieldsRepositoryInterface
 *
 * @category Api/Interface
 * @package  Sv\CheckoutCustomForm\Api
 */
interface CustomFieldsRepositoryInterface
{
    /**
     * Save checkout custom fields
     *
     * @param int                                                      $cartId       Cart id
     * @param \Sv\CheckoutCustomForm\Api\Data\CustomFieldsInterface $customFields Custom fields
     *
     * @return \Sv\CheckoutCustomForm\Api\Data\CustomFieldsInterface
     */
    public function saveCustomFields(
        int $cartId,
        CustomFieldsInterface $customFields
    ): CustomFieldsInterface;

    /**
     * Get checkoug custom fields
     *
     * @param Order $order Order
     *
     * @return CustomFieldsInterface
     */
    public function getCustomFields(Order $order) : CustomFieldsInterface;
}
