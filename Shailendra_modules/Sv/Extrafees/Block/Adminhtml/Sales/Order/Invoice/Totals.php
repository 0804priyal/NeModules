<?php

namespace Sv\Extrafees\Block\Adminhtml\Sales\Order\Invoice;

class Totals extends \Magento\Framework\View\Element\Template {

	protected $_dataHelper;

	protected $_invoice = null;

	protected $_source;

	public function __construct(\Magento\Framework\View\Element\Template\Context $context,
		\Sv\Extrafees\Helper\Data $dataHelper,
		array $data = []
		) {
		$this -> _dataHelper = $dataHelper;
		parent :: __construct($context, $data);
	}

	public function getSource() {
		return $this -> getParentBlock() -> getSource();
	}

	public function getInvoice() {
		return $this -> getParentBlock() -> getInvoice();
	}

	public function initTotals() {
		$this -> getParentBlock();
		$this -> getInvoice();
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
