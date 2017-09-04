<?php
/**
 * Created by PhpStorm.
 * Date: 24-Aug-17
 * Time: 12:10 PM
 */

class CategoryModel extends BaseModel {

    protected $table = 'categorie';
    protected $id;
    protected $name;


    public function __construct($table = false, $pk = false)
    {
        parent::__construct($table, $pk);
    }

}