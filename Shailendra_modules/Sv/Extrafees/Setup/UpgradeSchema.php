<?php

namespace Sv\Extrafees\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $quoteAddressTable = 'quote_address';
        $quoteTable = 'quote';
        $orderTable = 'sales_order';
        $invoiceTable = 'sales_invoice';
        $creditmemoTable = 'sales_creditmemo';

		
        //Quote address tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteAddressTable),
                'handlingfess',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'12,4',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Handlingfess'
                ]
            );
        $setup->getConnection()
            ->addColumn(
              $setup->getTable($quoteAddressTable),
                'base_handlingfess',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'12,4',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Base Handlingfess'
                ]
            );
        //Quote tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'handlingfess',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'12,4',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Handlingfess'

                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'base_handlingfess',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'12,4',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Base Handlingfess'

                ]
            );
        //Order tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'handlingfess',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'12,4',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Handlingfess'

                ]
            );

         $setup->getConnection()
             ->addColumn(
                $setup->getTable($orderTable),
                'base_handlingfess',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'12,4',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Base Handlingfess'

                ]
            );
        //Invoice tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($invoiceTable),
                'handlingfess',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'12,4',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Handlingfess'

                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($invoiceTable),
                'base_handlingfess',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'12,4',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Base Handlingfess'

                ]
            );
        //Credit memo tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($creditmemoTable),
                'handlingfess',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'12,4',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Handlingfess'

                ]
            );
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($creditmemoTable),
                'base_handlingfess',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'12,4',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'Base Handlingfess'

                ]
            );


        $setup->endSetup();
    }
}
