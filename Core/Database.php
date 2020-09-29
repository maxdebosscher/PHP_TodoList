<?php

namespace Core;

use PDO;

class Database
{
    /**
     * Opens a database connection.
     * 
     * @return object
     */
    public static function connect()
    {
        $dsn = "mysql:host=localhost;dbname=opdr-php-todolist;";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        return new PDO($dsn, 'root', '', $opt);
    }

    /**
     * Returns all rows from a table.
     * 
     * @param string $table
     * 
     * @return array
     */
    public static function all($table)
    {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT * FROM $table");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $conn = null;

        return $result;
    }

    /**
     * Returns a single row from a table.
     * 
     * @param string $table
     * @param array $columns
     * @param array $keys
     * 
     * @return object
     */
    public static function find($table, $columns, $keys)
    {
        foreach ($columns as $columnKey => $column) {
            $query = "SELECT * FROM $table WHERE ".$columns[$columnKey]."='".$keys[$columnKey]."'";
            if ($columnKey > 0) {
                $query = $query." AND ".$column."='" .$keys[$columnKey]. "'";
            }
        }

        $conn = self::connect();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $conn = null;

        return $result;
    }

    /**
     * Inserts a single row into a table.
     * 
     * @param string $table
     * @param array $columns
     * @param array $values
     * 
     * @return object
     */
    public static function insert($table, $columns, $values)
    {
        $newColumns = "";
        foreach($columns as $column) {
            $newColumns = $newColumns."$column, ";
        }
        $newColumns = substr($newColumns, 0, -2);

        $newValues = "";
        foreach($values as $value) {
            $newValues = $newValues."'$value', ";
        }
        $newValues = substr($newValues, 0, -2);

        $conn = self::connect();
        $stmt = $conn->prepare("INSERT INTO $table ($newColumns) VALUES ($newValues)");
        $stmt->execute();
        $conn = null;
    }

    /**
     * Inserts a single row into a table.
     * 
     * @param string $table
     * @param array $columns
     * @param array $values
     * @param string $column
     * @param mixed $key
     */
    public static function update($table, $columns, $values, $column, $key)
    {
        $newValues = "";
        foreach($columns as $newKey => $newColumn) {
            $newValues = $newValues."$newColumn='".$values[$newKey]."', ";
        }
        $newValues = substr($newValues, 0, -2);

        $conn = self::connect();
        $stmt = $conn->prepare("UPDATE $table SET $newValues WHERE $column=$key");
        $stmt->execute();
        $conn = null;
    }

    /**
     * Deletes a single row from a table.
     * 
     * @param string $table
     * @param string $column
     * @param mixed $key
     */
    public static function delete($table, $column, $key)
    {
        $conn = self::connect();
        $stmt = $conn->prepare("DELETE FROM $table WHERE $column=$key");
        $stmt->execute();
        $conn = null;
    }

    /**
     * Returns all rows from a table where column is key, then sorts them.
     * 
     * @param string $table
     * @param string $column
     * @param mixed $key
     * @param string $sortedBy
     */
    public static function findSorted($table, $column, $key, $sortedBy)
    {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT * FROM $table WHERE $column=$key ORDER BY $sortedBy");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $conn = null;

        return $result;
    }

    /**
     * Returns all rows from a table where column is key, then sorts them descending.
     * 
     * @param string $table
     * @param string $column
     * @param mixed $key
     * @param string $sortedBy
     */
    public static function findSortedDesc($table, $column, $key, $sortedBy)
    {
        $conn = self::connect();
        $stmt = $conn->prepare("SELECT * FROM $table WHERE $column=$key ORDER BY $sortedBy DESC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $conn = null;

        return $result;
    }
}