<?php
namespace Chilliapple\Amgrid\Block\Adminhtml;
class View extends \Magento\Backend\Block\Template
{
    public function __construct()
    {
        
    }
    
    public function sayHello()
	{
		return __('Hello World');
	}
}

	
