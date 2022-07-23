<?php

namespace Sv\Extrafees\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper {

	
	const CONFIG_CUSTOM_IS_ENABLED_HANDLINGFESS = 'handlingfess_customfee/handlingfess_customfee/handlingfess_status';
	const CONFIG_CUSTOM_FEE_HANDLINGFESS = 'handlingfess_customfee/handlingfess_customfee/handlingfess_customfeeamount';
	const CONFIG_FEE_LABEL_HANDLINGFESS = 'handlingfess_customfee/handlingfess_customfee/handlingfess_name';
	const CONFIG_MINIMUM_ORDER_AMOUNT_HANDLINGFESS = 'handlingfess_customfee/handlingfess_customfee/handlingfess_minimumorderamount';

	public function isModuleEnabledHandlingfess() {
		$storeScope = \Magento\Store\Model\ScopeInterface :: SCOPE_STORE;
		$isEnabled = $this -> scopeConfig -> getValue(self :: CONFIG_CUSTOM_IS_ENABLED_HANDLINGFESS, $storeScope);
		return $isEnabled;
	}

	public function getCustomFeeHandlingfess() {
		$storeScope = \Magento\Store\Model\ScopeInterface :: SCOPE_STORE;
		$fee = $this -> scopeConfig -> getValue(self :: CONFIG_CUSTOM_FEE_HANDLINGFESS, $storeScope);
		return $fee;
	}

	public function getFeeLabelHandlingfess() {
		$storeScope = \Magento\Store\Model\ScopeInterface :: SCOPE_STORE;
		$feeLabel = $this -> scopeConfig -> getValue(self :: CONFIG_FEE_LABEL_HANDLINGFESS, $storeScope);
		return $feeLabel;
	}

	public function getMinimumOrderAmountHandlingfess() {
		$storeScope = \Magento\Store\Model\ScopeInterface :: SCOPE_STORE;
		$MinimumOrderAmount = $this -> scopeConfig -> getValue(self :: CONFIG_MINIMUM_ORDER_AMOUNT_HANDLINGFESS, $storeScope);
		return $MinimumOrderAmount;
	}
	

}
