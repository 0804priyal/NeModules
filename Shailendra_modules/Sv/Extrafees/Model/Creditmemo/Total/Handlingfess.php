<?php

namespace Sv\Extrafees\Model\Creditmemo\Total;

use Magento\Sales\Model\Order\Creditmemo\Total\AbstractTotal;

class Handlingfess extends AbstractTotal {

	public function collect(\Magento\Sales\Model\Order\Creditmemo $creditmemo) {

		$order = $creditmemo -> getOrder();

		$percent = $creditmemo -> getSubtotal() / $order -> getSubtotal();

		$creditmemo -> setHandlingfess(0);
		$creditmemo -> setBaseHandlingfess(0);

		$amount = $creditmemo -> getOrder() -> getHandlingfess() * $percent;
		$baseAmount = $creditmemo -> getOrder() -> getBaseHandlingfess() * $percent;

		$creditmemo -> setHandlingfess($amount);

		$creditmemo -> setBaseHandlingfess($baseAmount);

		$creditmemo -> setGrandTotal($creditmemo -> getGrandTotal() + $amount);
		$creditmemo -> setBaseGrandTotal($creditmemo -> getBaseGrandTotal() + $baseAmount);

		return $this;
	}
} 