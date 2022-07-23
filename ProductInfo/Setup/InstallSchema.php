<?php

namespace Nethues\ProductInfo\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context){
        $setup->startSetup();
        $table = $setup->getConnection()->newTable(
                $setup->getTable('productinfo')
            )->addColumn(
                'productinfo_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Productinfo Id'
            )->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Name'
            )->addColumn(
                'email',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Email'
            )->addColumn(
                'contact_number',
                Table::TYPE_TEXT,
                25,
                ['nullable' => true],
                'Contact Number'
            );
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }

}