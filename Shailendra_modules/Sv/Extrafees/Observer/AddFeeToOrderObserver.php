<?php

namespace Sv\Extrafees\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddFeeToOrderObserver implements ObserverInterface
{

    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        $quote = $observer->getQuote();
		$order = $observer->getOrder();

		
        $CustomFeeHandlingfess = $quote->getHandlingfess();
        $CustomFeeBaseHandlingfess = $quote->getBaseHandlingfess();

        if ($CustomFeeHandlingfess&&$CustomFeeBaseHandlingfess) {

			$order->setData('handlingfess', $CustomFeeHandlingfess);
			$order->setData('base_handlingfess', $CustomFeeBaseHandlingfess);

        }


        return $this;

    }
}
