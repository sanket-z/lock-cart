<?php
/**
 * Copyright © 2022 PT Kemana Teknologi Solusi. All rights reserved.
 * http://www.kemana.com
 */

/**
 * @category Kemana
 * @package  Kemana_LockCart
 * @license  Proprietary
 *
 * @author   Sanket Zadafiya <szadafiya@kemana.com>
 */
namespace Kemana\LockCart\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws Zend_Db_Exception
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $quote = 'quote';

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quote),
                'is_locked',
                [
                    'type'    => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'length'  => 10,
                    'default' => 0,
                    'comment' => 'Is locked cart',
                ]
            );

        $setup->endSetup();
    }
}
