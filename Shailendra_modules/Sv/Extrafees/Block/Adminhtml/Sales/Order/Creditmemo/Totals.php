<?php

namespace Sv\Extrafees\Block\Adminhtml\Sales\Order\Creditmemo;

class Totals extends \Magento\Framework\View\Element\Template {

	protected $_creditmemo = null;

	protected $_source;

	protected $_dataHelper;

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

	public function getCreditmemo() {
		return $this -> getParentBlock() -> getCreditmemo();
	}

	public function initTotals() {

		$this -> getParentBlock();
		$this -> getCreditmemo();
		$this -> getSource();

		
		if ($this -> getSource() -> getHandlingfess()) {
		$total = new \Magento\Framework\DataObject([
			'code' => 'handlingfess',
		    'strong' => false,
			'value' => $this -> getSource() -> getHandlingfess(),
			'label' => $this -> _dataHelper -> getFeeLabelHandlingfess(),
			]
			);
		$this -> getParentBlock() -> addTotalBefore($total, 'grand_total');
		}
	

		return $this;
	}
}
