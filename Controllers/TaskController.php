<?php

namespace Controllers;

use Core\Database;
use Models\Task;

class TaskController
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public static function index()
    {
        $tasksArr = Database::all("tasks");
        $tasks = [];
        foreach ($tasksArr as $task) {
            array_push($tasks, new Task($task["id"], $task["tasklistId"], $task["description"], $task["duration"], $task["status"]));
        }

        return $tasks;
    }

    /**
     * Store a newly created resource in database.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $params = $request->getParams();
        $columns = ["tasklistId", "description", "duration", "status"];
        $values = [$params["tasklistId"], $params["description"], $params["duration"], $params["status"]];

        Database::insert("tasks", $columns, $values);

        header("Location: ../Public/index.php");
        die();
    }

    /**
     * Update the specified resource in database.
     * 
     * @param Request $request
     */
    public function update(Request $request)
    {
        $params = $request->getParams();
        $columns = ["tasklistId", "description", "duration", "status"];
        $values = [$params["tasklistId"], $params["description"], $params["duration"], $params["status"]];
        $id = $params["id"];

        Database::update("tasks", $columns, $values, "id", $id);

        header("Location: ../Public/index.php");
        die();
    }

    /**
     * Remove the specified resource from database.
     *
     */
    public function destroy(Request $request)
    {
        $params = $request->getParams();
        $id = $params["id"];

        Database::delete("tasks", "id", $id);

        header("Location: ../Public/index.php");
        die();
    }
}