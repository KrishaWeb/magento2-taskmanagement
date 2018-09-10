<?php

namespace Central\TaskManagement\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Central\TaskManagement\Setup
 */
class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB Schema for Module
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $table = $installer->getConnection()->newTable(
            $installer->getTable('central_taskmanagement')
        )->addColumn(
            'task_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Task ID'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false, 'default' => null]
        )->addColumn(
            'description',
            Table::TYPE_TEXT,
            '2M',
            [],
            'Task description'
        )->addColumn(
            'start_time',
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Start Time'
        )->addColumn(
            'end_time',
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'End Time'
        )->addColumn(
            'assigned_person',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Assigned Person'
        )->addColumn(
            'status',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1'],
            'Status (values: TODO, In Progress, Done)'
        )->addColumn(
            'creation_time',
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Created At'
        )->addColumn(
            'update_time',
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Updated At'
        )->addIndex($installer->getIdxName('task', ['task_id']),
            ['task_id']
        )->setComment(
            'Task Management Table'
        );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}