<?php

namespace Central\TaskManagement\Model\ResourceModel\Task;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'task_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Central\TaskManagement\Model\Task', 'Central\TaskManagement\Model\ResourceModel\Task');
    }

}