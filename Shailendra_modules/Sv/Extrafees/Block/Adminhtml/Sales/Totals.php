<?php

namespace Sv\Extrafees\Block\Adminhtml\Sales;

class Totals extends \Magento\Framework\View\Element\Template {

	protected $_dataHelper;

	protected $_currency;

	public function __construct(\Magento\Framework\View\Element\Template\Context $context,
		\Sv\Extrafees\Helper\Data $dataHelper,
		\Magento\Directory\Model\Currency $currency,
		array $data = []
		) {
		parent :: __construct($context, $data);
		$this -> _dataHelper = $dataHelper;
		$this -> _currency = $currency;
	}

	public function getOrder() {
		return $this -> getParentBlock() -> getOrder();
	}

	public function getSource() {
		return $this -> getParentBlock() -> getSource();
	}

	public function getCurrencySymbol() {
		return $this -> _currency -> getCurrencySymbol();
	}

	public function initTotals() {
		$this -> getParentBlock();
		$this -> getOrder();
		$this -> getSource();

		
		if ($this -> getSource() -> getHandlingfess()) {
			$total = new \Magento\Framework\DataObject([
				'code' => 'handlingfess',
				'value' => $this -> getSource() -> getHandlingfess(),
				'label' => $this -> _dataHelper -> getFeeLabelHandlingfess(),
				]
				);
			$this -> getParentBlock() -> addTotalBefore($total, 'grand_total');
		}
	

		return $this;
	}
}
