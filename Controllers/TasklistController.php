<?php

namespace Controllers;

use Core\Database;
use Models\Tasklist;

class TasklistController
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public static function index()
    {
        $tasklistsArr = Database::all("tasklists");
        $tasklists = [];
        foreach ($tasklistsArr as $tasklist) {
            array_push($tasklists, new Tasklist($tasklist["id"], $tasklist["title"]));
        }
        
        return $tasklists;
    }

    /**
     * Store a newly created resource in database.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $params = $request->getParams();
        $columns = ["title"];
        $values = [$params["title"]];
        
        Database::insert("tasklists", $columns, $values);

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
        $columns = ["title"];
        $values = [$params["title"]];
        $id = $params["id"];

        Database::update("tasklists", $columns, $values, "id", $id);

        header("Location: ../Public/index.php");
        die();
    }

    /**
     * Remove the specified resource from database.
     * 
     * @param Request $request
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