<?php
/**
 * Checkout custom fields guest repository interface
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
 * Interface CustomFieldsGuestRepositoryInterface
 *
 * @category Api/Interface
 * @package  Sv\CheckoutCustomForm\Api
 */
interface CustomFieldsGuestRepositoryInterface
{
    /**
     * Save checkout custom fields
     *
     * @param string                                                   $cartId       Guest Cart id
     * @param \Sv\CheckoutCustomForm\Api\Data\CustomFieldsInterface $customFields Custom fields
     *
     * @return \Sv\CheckoutCustomForm\Api\Data\CustomFieldsInterface
     */
    public function saveCustomFields(
        string $cartId,
        CustomFieldsInterface $customFields
    ): CustomFieldsInterface;
}
