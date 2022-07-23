<?php
/**
 * @package   Sv\CheckoutCustomForm
 * @author    Slawomir Sv <slawek.Sv@gmail.com>
 * @copyright © 2017 Slawomir Sv
 * @license   See LICENSE file for license details.
 */

declare(strict_types=1);

namespace Sv\CheckoutCustomForm\Model;

use Magento\Quote\Model\QuoteIdMaskFactory;
use Sv\CheckoutCustomForm\Api\CustomFieldsGuestRepositoryInterface;
use Sv\CheckoutCustomForm\Api\CustomFieldsRepositoryInterface;
use Sv\CheckoutCustomForm\Api\Data\CustomFieldsInterface;

/**
 * Class CustomFieldsGuestRepository
 *
 * @category Model/Repository
 * @package  Sv\CheckoutCustomForm\Model
 */
class CustomFieldsGuestRepository implements CustomFieldsGuestRepositoryInterface
{
    /**
     * @var QuoteIdMaskFactory
     */
    protected $quoteIdMaskFactory;

    /**
     * @var CustomFieldsRepositoryInterface
     */
    protected $customFieldsRepository;

    /**
     * @param QuoteIdMaskFactory              $quoteIdMaskFactory
     * @param CustomFieldsRepositoryInterface $customFieldsRepository
     */
    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        CustomFieldsRepositoryInterface $customFieldsRepository
    ) {
        $this->quoteIdMaskFactory     = $quoteIdMaskFactory;
        $this->customFieldsRepository = $customFieldsRepository;
    }

    /**
     * @param string                $cartId
     * @param CustomFieldsInterface $customFields
     * @return CustomFieldsInterface
     */
    public function saveCustomFields(
        string $cartId,
        CustomFieldsInterface $customFields
    ): CustomFieldsInterface {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->customFieldsRepository->saveCustomFields((int)$quoteIdMask->getQuoteId(), $customFields);
    }
}
