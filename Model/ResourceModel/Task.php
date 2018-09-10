<?php

namespace Central\TaskManagement\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Task extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_date;

    /**
     * Task constructor.
     * @param Context $context
     * @param DateTime $date
     * @param null $connectionName
     */
    public function __construct(Context $context, DateTime $date, $connectionName = null)
    {
        parent::__construct($context, $connectionName);
        $this->_date = $date;
    }

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('central_taskmanagement', 'task_id');
    }

    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        if (strtotime($object->getEndTime()) - strtotime($object->getStartTime()) < 0) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('End Time is before than Start time.')
            );
        }

        if ($object->isObjectNew() && !$object->hasCreationTime()) {
            $object->setCreationTime($this->_date->gmtDate());
        }
        $object->setUpdateTime($this->_date->gmtDate());

        return parent::_beforeSave($object);
    }
}