<?php

namespace Sv\Extrafees\Model\Quote\Total;

use Magento\Store\Model\ScopeInterface;

class Handlingfess extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal {

	protected $helperData;

	protected $quoteValidator = null;

	public function __construct(\Magento\Quote\Model\QuoteValidator $quoteValidator,
		\Sv\Extrafees\Helper\Data $helperData) {
		$this -> quoteValidator = $quoteValidator;
		$this -> helperData = $helperData;
	}

	public function collect(\Magento\Quote\Model\Quote $quote,
		\Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
		\Magento\Quote\Model\Quote\Address\Total $total
		) {
		parent :: collect($quote, $shippingAssignment, $total);
		if (!count($shippingAssignment -> getItems())) {
			return $this;
		}

		$enabled = $this -> helperData -> isModuleEnabledHandlingfess();
		$minimumOrderAmount = $this -> helperData -> getMinimumOrderAmountHandlingfess();
		$subtotal = $total -> getTotalAmount('subtotal');
		if ($enabled && $minimumOrderAmount <= $subtotal) {
			// $handlingfess = $quote->gethandlingfess();
		    $handlingfess=$this->helperData->getCustomFeeHandlingfess();
			// Try to test with sample value
			//$handlingfess = 0.01;
			$total -> setTotalAmount('handlingfess', $handlingfess);
			$total -> setBaseTotalAmount('handlingfess', $handlingfess);
			$total -> setHandlingfess($handlingfess);
			$total -> setBaseHandlingfess($handlingfess);
			$quote -> setHandlingfess($handlingfess);
			$quote -> setBaseHandlingfess($handlingfess);
			$total -> setGrandTotal($total -> getGrandTotal() + $handlingfess);
			$total -> setBaseGrandTotal($total -> getBaseGrandTotal() + $handlingfess);
		}
		return $this;
	}

	public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total) {
		$enabled = $this -> helperData -> isModuleEnabledHandlingfess();
		$minimumOrderAmount = $this -> helperData -> getMinimumOrderAmountHandlingfess();
		$subtotal = $quote -> getSubtotal();
		$handlingfess = $quote -> getHandlingfess();

		$result = [];
		if ($enabled && ($minimumOrderAmount <= $subtotal) && $handlingfess) {
			$result = [
			'code' => 'handlingfess',
			'title' => $this -> helperData -> getFeeLabelHandlingfess(),
			'value' => $handlingfess
			];
		}
		return $result;
	}

	public function getLabel() {
		return __('handling fees');
	}

	protected function clearValues(\Magento\Quote\Model\Quote\Address\Total $total) {
		$total -> setTotalAmount('subtotal', 0);
		$total -> setBaseTotalAmount('subtotal', 0);
		$total -> setTotalAmount('tax', 0);
		$total -> setBaseTotalAmount('tax', 0);
		$total -> setTotalAmount('discount_tax_compensation', 0);
		$total -> setBaseTotalAmount('discount_tax_compensation', 0);
		$total -> setTotalAmount('shipping_discount_tax_compensation', 0);
		$total -> setBaseTotalAmount('shipping_discount_tax_compensation', 0);
		$total -> setSubtotalInclTax(0);
		$total -> setBaseSubtotalInclTax(0);
	}
}  