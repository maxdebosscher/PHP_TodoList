<?php

namespace Models;

use Core\Database;
use Models\Task;

class Tasklist
{
    private $id = 0;
    private $title = "";

    /**
     * Constructs a tasklist.
     * 
     * @param int $id
     * @param string $title
     */
    public function __construct($id, $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    /** GETTERS **/
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getTasks()
    {
        $tasksArr = Database::find("tasks", "tasklistId", $this->getId());
        $tasks = [];
        foreach ($tasksArr as $task) {
            array_push($tasks, new Task($task["id"], $task["tasklistId"], $task["description"], $task["duration"], $task["status"]));
        }

        return $tasks;
    }
}