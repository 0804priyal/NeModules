define(
    [
		'ko',
        'Sv_Extrafees/js/view/checkout/summary/handlingfess',
		'Magento_Checkout/js/model/quote',
		'Magento_Catalog/js/price-utils',
		'Magento_Checkout/js/model/totals'
    ],
    function (ko, Component,quote,priceUtils, totals) {
        'use strict';

		var custom_fee_amount = 0;

		if (totals.getSegment('handlingfess'))
		{
			custom_fee_amount=totals.getSegment('handlingfess').value
		}

		var handlingfess_label = window.checkoutConfig.handlingfess_label;

        return Component.extend({

			getFormattedPrice: ko.observable(priceUtils.formatPrice(custom_fee_amount, quote.getPriceFormat())),
			getFeeLabelHandlingfess:ko.observable(handlingfess_label),
            isDisplayed: function () {
                return this.isFullMode() && this.getPureValue() != 0;
            }
        });
    }
);