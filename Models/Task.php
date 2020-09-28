<?php

namespace Models;

class Task
{
    private $id = 0;
    private $tasklistId = 0;
    private $description = "";
    private $duration = 0;
    private $status = "";

    /**
     * Constructs a task.
     * 
     * @param int $id
     * @param int $tasklistId
     * @param string $description
     * @param int $duration
     * @param string $status
     */
    public function __construct($id, $tasklistId, $description, $duration, $status)
    {
        $this->id = $id;
        $this->tasklistId = $tasklistId;
        $this->description = $description;
        $this->duration = $duration;
        $this->status = $status;
    }

    /** GETTERS **/
    public function getId()
    {
        return $this->id;
    }

    public function getTasklistId()
    {
        return $this->tasklistId;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getStatus()
    {
        return $this->status;
    }
}