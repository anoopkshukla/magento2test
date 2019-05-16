<?php 
namespace THR\CustomPrice\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{
    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
		
		$installer = $setup;
        $installer->startSetup();
		
		$installer->run('create table custom_price_table(item_id int not null unsigned, quote_id int not null unsigned, custom_price decimal(12,4))');
		
		
		$installer->endSetup();
		
 
    }
}
 