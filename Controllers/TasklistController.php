<?php

namespace Controllers;

use Core\Request;
use Core\Controller;
use Core\Database;
use Models\Tasklist;
use Controllers\TaskController;

class TasklistController extends Controller
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

        header("Location: /");
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

        header("Location: /");
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

        Database::delete("tasklists", "id", $id);
        Database::delete("tasks", "tasklistId", $id);

        header("Location: /");
        die();
    }
}