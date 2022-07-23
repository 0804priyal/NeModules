<?php
namespace Cloudways\EventsObservers\Observer\Product;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
     
class Data implements ObserverInterface
    {
        /**
         * Below is the method that will fire whenever the event runs!
         *
         * @param Observer $Observer
         */
        public function execute(Observer $Observer)
        {
            $Product = $Observer->getProduct();
            //$apiData = $Observer->getApidata();
            $originalName = $Product->getName();
            $modifiedName = $originalName . ' - Modified by Magento 2 Events and Observers';
            $Product->setName($modifiedName);
        }
    }