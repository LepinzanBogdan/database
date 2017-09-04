<?php
/**
 * Created by PhpStorm.
 * Date: 24-Aug-17
 * Time: 12:10 PM
 */


class BaseModel
{
    protected $db;
    protected $pk;
    protected $table;

    /**
     * BaseModel constructor.
     * @param bool $table
     * @param bool $pk
     */
    public function __construct($table = false, $pk = false)
    {
        $this->setTable($table); // set table
        $this->setPrimaryKey($pk); // set primary key
        $this->db = Application::$db; // set database
    }

    /**
     * @param $primaryKey - primary key
     * This function load an object from the given table where value from parameters primaryKey is equal with the primaryKey of the object
     */
    public function loadFromDB($primaryKey)
    {
        $array = $this->db->getRow("Select * From {$this->table} WHERE {$this->pk}={$primaryKey}");
        $this->loadFromArray($array);
    }

    /**
     * @param $array
     * This function load an object from the given array;
     */
    public function loadFromArray($array)
    {
        foreach ($array as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @param $table - value of table , if is false then $this->table is the value of the instantiated class otherwise it is the value given in the parameter.
     * set value for table.
     *
     */
    public function setTable($table)
    {
        if ($table) {
            $this->table = $table;
        } else {
            $this->table = get_object_vars($this)['table'];
        }
    }

    /**
     * @param $pk - primary key , if is false then $this->pk is id otherwise it is the primary key given in the parameter
     * set value for primary key
     */
    public function setPrimaryKey($pk)
    {
        if ($pk) {
            $this->pk = $pk;
        } else {
            $this->pk = 'id';
        }
    }

    /**
     * @param $array array
     * This function save an element in database;
     * She can make update or insert depending on the given array.
     * If primary key from array is set make update , otherwise insert
     *
     */
    public function save($array)
    {
        if (isset($array[$this->pk]) && strlen($array[$this->pk]) != 0 ) {
            $this->loadFromDB($array[$this->pk]);
            $this->loadFromArray($array);
            $this->update();
        } else {
            unset($array[$this->pk]);
            $this->loadFromArray($array);
            $this->insert();
        }
    }

    /**
     * @return mixed boolean
     * delete one row from the given table where the primary key of the table is equal to the primary key of the object
     */
    public function delete()
    {
        return $this->db->execute("DELETE FROM {$this->table} WHERE {$this->pk}={$this->{$this->pk}}");
    }

    /**
     * @return mixed array
     * get all elements from table
     */
    public function getElements()
    {
        return $this->db->getAll("Select * FROM {$this->table}");
    }

    /**
     * @return mixed array
     * This function converts an array from an object
     * $this->{$columns[$i]['Field']} - value from the object sent with key $columns[$i]['Field'](name of the column)
     */
    public function toArray()
    {
        $columns = $this->showColumn(); // all columns for the given table
        $arrayReturn = [];
        foreach ($columns as $value) {
            $arrayReturn[$value['Field']] = $this->{$value['Field']};
        }
        return $arrayReturn;
    }

    /**
     * @param $array - array
     * @return mixed
     * Delete one or more rows from database depending on the given array
     * $fields - properties
     */
    public function deleteByProperty($array) {
        $fields = '';
        foreach ($array as $key => $value) {
            $fields .= $key .'='.$value .' and ';
        }
        $fields = rtrim($fields,' and ');
        return $this->db->execute("DELETE FROM {$this->table} WHERE $fields");
    }

    /**
     * @return mixed boolean
     * Insert one row in the given table;
     * $keys - represents the name of the columns where the new values will be added
     * $values - these are the new values to be added
     */
    public function insert()
    {
        $columns = $this->showColumn(); // all columns for the given table
        $keys = '';
        $values = '';
        foreach ($columns as $value) {
            if (isset($this->{$value['Field']})) {
                $keys .= $value['Field'] . ',';
                $values .= "'{$this->{$value['Field']}}'" . ',';
            }
        }
        $keys = rtrim($keys, ",");  // remove last comma
        $values = rtrim($values, ","); // remove last comma
        return $this->db->execute("INSERT INTO {$this->table} ({$keys}) VALUES ({$values})");
    }

    /**
     * @return mixed boolean
     * update one row in database where the primary key of the table is equal to the primary key of the object.
     * $value['Field'] - represents the name of the column and
     * $this->{$value['Field'] - is the new value for this field
     */
    public function update()
    {
        $columns = $this->showColumn();  // all columns for the given table
        $fields = '';
        foreach ($columns as $value) {
            $fields .= $value['Field'] . '=' . "'{$this->{$value['Field']}}',";
        }
        $fields = rtrim($fields, ',');  // remove last comma
        return $this->db->execute("UPDATE {$this->table} SET {$fields} WHERE {$this->pk}={$this->{$this->pk}}");
    }

    /**
     * @return mixed array
     * get if for last element entered in table.
     */
    public function getIdForLastElementAdded()
    {
        return $this->db->getAll("SELECT id FROM {$this->table} ORDER BY id DESC LIMIT 1");
    }

    /**
     * @param $array
     * Check if exists a record in database
     * $key - is the name of the column and $value is the value that will compare with key
     * @return mixed
     */
    public function checkExist($array)
    {
        $fields = '';
        foreach ($array as $key => $value) {
            $fields .= $key . '= ' ."'". $value ."'".' and ';
        }
        $fields = rtrim($fields, ' and ');
        return $this->db->getRow("SELECT * FROM {$this->table} WHERE $fields");
    }

    /**
     * @return mixed
     * Return all columns name for the given table.
     */
    public function showColumn()
    {
        return $this->db->getAll("SHOW COLUMNS FROM {$this->table}");
    }

}