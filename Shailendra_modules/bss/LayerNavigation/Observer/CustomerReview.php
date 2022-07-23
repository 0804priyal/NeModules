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
namespace Bss\LayerNavigation\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class CustomerReview
 * @package Bss\LayerNavigation\Observer
 */
class CustomerReview implements ObserverInterface
{

    /**
     * @var \Magento\Review\Model\RatingFactory
     */
    protected $reviewFactory;

    /**
     * @var \Magento\Review\Model\RatingFactory
     */
    protected $ratingFactory;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $productloader;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * CustomerReview constructor.
     * \Magento\Review\Model\ReviewFactory $reviewFactory
     * @param \Magento\Review\Model\RatingFactory $ratingFactory
     * @param \Magento\Catalog\Model\ProductFactory $productloader
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Review\Model\ReviewFactory $reviewFactory,
        \Magento\Review\Model\RatingFactory $ratingFactory,
        \Magento\Catalog\Model\ProductFactory $productloader,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->reviewFactory = $reviewFactory;
        $this->ratingFactory = $ratingFactory;
        $this->productloader = $productloader;
        $this->logger = $logger;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /* @var $review \Magento\Review\Model\Review */
        $review = $observer->getEvent()->getObject();
        if ($review->isApproved()) {
            $product = $this->productloader->create()->load($review->getEntityPkValue());
            if ($product->getId()) {
                try {
                    $this->reviewFactory->create()->getEntitySummary($product, $review->getStoreId());
                    $ratingMd = $this->ratingFactory->create()->getReviewSummary($review->getId());
                    $rating = round($ratingMd['sum'] / 20);
                    // $review->getStoreId() approve in edit page
                    // $ratingMd->getStoreId() approve with mass action
                    $storeId = $review->getStoreId() ? $review->getStoreId() : $ratingMd->getStoreId();
                    // setStoreId in case multi store view
                    $product->setStoreId($storeId)->setRating($rating);
                    $product->save();
                } catch (\Exception $e) {
                    $this->logger->critical($e);
                }
            }
        }
    }
}
