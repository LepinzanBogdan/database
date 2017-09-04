<?php
/**
 * Created by PhpStorm.
 * Date: 17-Aug-17
 * Time: 10:21 AM
 */

class Database
{
    private $conn;
    /**
     * Database constructor.
     * Connection to the database.
     */
    public function __construct($server,$username,$pass,$databaseName)
    {
        $this->conn = new mysqli($server,$username,$pass,$databaseName);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    /**
     * @param $sql
     * Return  all rows resulted from query
     * @return array
     */
    public function getAll($sql){
        $result = $this->conn->query($sql);
        if(!$result){
            die("Failed: " . $this->conn->error.'<br />'.$sql);
        }
        $ar = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ar[] = $row;
            }
        }
        return $ar;
    }

    /**
     * @param $sql - query
     * Return one row according to restriction
     * @return array|null
     */
    public function getRow($sql) {
        $result = $this->conn->query($sql);
        if(!$result){
            die("Failed: " . $this->conn->error.'<br />'.$sql);
        }
        return $result->fetch_assoc();
    }

    /**
     * @param $sql - query
     * Return number of rows resulted from query constraints
     * @return
     */
    public function getCount($sql){
        $result = $this->conn->query($sql);
        if(!$result){
            die("Failed: " . $this->conn->error.'<br />'.$sql);
        }
        return $result->num_rows;
    }

    /**
     * @param $sql - query
     * Function for execute query for insert, update or delete.
     * @return
     */
    public function execute($sql){
        $result = $this->conn->query($sql);
        if(!$result) {
            die("Execute query failed: " . $this->conn->error."<br />".$result);
        }
        return true;
    }

}