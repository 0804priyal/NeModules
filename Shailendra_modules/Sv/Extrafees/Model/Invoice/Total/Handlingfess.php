<?php

namespace Sv\Extrafees\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;

class Handlingfess extends AbstractTotal {

	public function collect(\Magento\Sales\Model\Order\Invoice $invoice) {

		$order = $invoice -> getOrder();

		$percent = $invoice -> getSubtotal() / $order -> getSubtotal();

		$invoice -> setHandlingfess(0);
		$invoice -> setBaseHandlingfess(0);

		$amount = $invoice -> getOrder() -> getHandlingfess() * $percent;

		$baseAmount = $invoice -> getOrder() -> getBaseHandlingfess() * $percent;

		$invoice -> setHandlingfess($amount);

		$invoice -> setBaseHandlingfess($baseAmount);

		$invoice -> setGrandTotal($invoice -> getGrandTotal() + $amount);
		$invoice -> setBaseGrandTotal($invoice -> getBaseGrandTotal() + $invoice -> getBaseHandlingfess() * $baseAmount);

		return $this;
	}
} 