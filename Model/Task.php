<?php

namespace Central\TaskManagement\Model;


use Central\TaskManagement\Api\Data\TaskInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Task extends \Magento\Framework\Model\AbstractModel implements IdentityInterface, TaskInterface
{

    const STATUS_TODO = 0;
    const STATUS_INPROGRESS = 1;
    const STATUS_DONE = 2;
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'taskmanagement_task';
    /**
     * @var string
     */
    protected $_cacheTag = 'taskmanagement_task';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'taskmanagement_task';

    /**
     * Initialize resource model
     *
     * @return void
     */
    function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this->_init('Central\TaskManagement\Model\ResourceModel\Task');
    }

    /**
     * Prepare task's statuses.
     *
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_TODO => __('To Do'), self::STATUS_INPROGRESS => __('In Progress'), self::STATUS_DONE => __('Done')];
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId()
    {
        return $this->getData(self::TASK_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::TASK_ID, $id);
    }

    /**
     * Get Task Name
     * @return string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get Task Description
     * @return string|null
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * Get Task Start Time
     * @return string|null
     */
    public function getStartTime()
    {
        return $this->getData(self::START_TIME);
    }

    /**
     * Get Task End Time
     * @return string|null
     */
    public function getEndTime()
    {
        return $this->getData(self::END_TIME);
    }

    /**
     * Get Task Assigned Person
     * @return string|null
     */
    public function getAssignedPerson()
    {
        return $this->getData(self::ASSIGNED_PERSON);
    }

    /**
     * Get Status
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Get Task Creation Time
     *
     * @return string|null
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get Update Time
     *
     * @return string|null
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Set Task Name
     * @param string $name
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set Task Description
     * @param string $description
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Set Start Time
     * @param string $startTime
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setStartTime($startTime)
    {
        $this->setData(self::START_TIME, $startTime);
    }

    /**
     * Set End Time
     * @param string $endTime
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setEndTime($endTime)
    {
        $this->setData(self::END_TIME, $endTime);
    }

    /**
     * Set Assigned Person
     * @param string $assignedPerson
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setAssignedPerson($assignedPerson)
    {
        $this->setData(self::ASSIGNED_PERSON, $assignedPerson);
    }

    /**
     * Set Status
     * @param int $status
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set Creation Time
     * @param string $creationTime
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Set Update Time
     * @param string $updateTime
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }


}