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

    /**
     * Decides how to return the tasks from the list.
     * 
     * @param int $tasklistId
     */
    public function getTasks($tasklistId)
    {
        $tasksArr = Database::find("tasks", ["tasklistId"], [$this->getId()]);

        if (isset($_GET["tasklistId"])) {
            if ($_GET["tasklistId"] === $tasklistId) {

                // If using sort:
                if (isset($_GET["sort"])) {
                    if ($_GET["sort"] === "asc") {
                        $tasksArr = Database::findSorted("tasks", "tasklistId", $this->getId(), "duration");
                    } else if ($_GET["sort"] === "desc") {
                        $tasksArr = Database::findSorted("tasks", "tasklistId", $this->getId(), "duration", true);
                    }
                }

                // If using filter:
                if (isset($_GET["filter"])) {
                    $status = $_GET["filter"];
                    if ($status != "None") {
                        $tasksArr = Database::find("tasks", ["tasklistId", "status"], [$this->getId(), $status]);
                    }
                }
            }
        }
        
        $tasks = [];
        foreach ($tasksArr as $task) {
            array_push($tasks, new Task($task["id"], $task["tasklistId"], $task["description"], $task["duration"], $task["status"]));
        }

        return $tasks;
    }
}