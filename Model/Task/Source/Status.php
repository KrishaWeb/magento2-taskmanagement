<?php

namespace Central\TaskManagement\Model\Task\Source;


class Status implements \Magento\Framework\Data\OptionSourceInterface
{

    protected $task;

    /**
     * Status constructor.
     * @param \Central\TaskManagement\Model\Task $task
     */
    public function __construct(\Central\TaskManagement\Model\Task $task)
    {
        $this->task = $task;
    }


    /**
     * Get Status Array
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->task->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}