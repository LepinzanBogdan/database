<?php
/**
 * Created by PhpStorm.
 * Date: 24-Aug-17
 * Time: 12:10 PM
 */

class UserModel extends BaseModel {

    protected $table = 'user';
    protected $id;
    protected $name;
    protected $age;
    protected $password;


    public function __construct($table = false, $pk = false)
    {
        parent::__construct($table, $pk);
    }

}