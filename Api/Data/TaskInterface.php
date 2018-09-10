<?php

namespace Central\TaskManagement\Api\Data;


/**
 * Interface TaskInterface
 * @package Central\TaskManagement\Api\Data
 */
interface TaskInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const TASK_ID = 'task_id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const START_TIME = 'start_time';
    const END_TIME = 'end_time';
    const ASSIGNED_PERSON = 'assigned_person';
    const STATUS = 'status';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME = 'update_time';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Task Name
     * @return string|null
     */
    public function getName();

    /**
     * Get Task Description
     * @return string|null
     */
    public function getDescription();

    /**
     * Get Task Start Time
     * @return string|null
     */
    public function getStartTime();

    /**
     * Get Task End Time
     * @return string|null
     */
    public function getEndTime();

    /**
     * Get Task Assigned Person
     * @return string|null
     */
    public function getAssignedPerson();

    /**
     * Get Status
     * @return int
     */
    public function getStatus();

    /**
     * Get Task Creation Time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get Update Time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Set ID
     * @param int $id
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setId($id);

    /**
     * Set Task Name
     * @param string $name
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setName($name);


    /**
     * Set Task Description
     * @param string $description
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setDescription($description);

    /**
     * Set Start Time
     * @param string $startTime
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setStartTime($startTime);

    /**
     * Set End Time
     * @param string $endTime
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setEndTime($endTime);

    /**
     * Set Assigned Person
     * @param string $assignedPerson
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setAssignedPerson($assignedPerson);

    /**
     * Set Status
     * @param int $status
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setStatus($status);

    /**
     * Set Creation Time
     * @param string $creationTime
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set Update Time
     * @param string $updateTime
     * @return \Central\TaskManagement\Api\Data\TaskInterface
     */
    public function setUpdateTime($updateTime);

}