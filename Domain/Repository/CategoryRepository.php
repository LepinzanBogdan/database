<?php
/**
 * Created by PhpStorm.
 * Date: 28-Aug-17
 * Time: 3:06 PM
 */


class CategoryRepository extends BaseRepository {

    protected $table = 'categorie';
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function loadFromDB($primaryKey)
    {
        return $this->categoryModel->loadFromDB($primaryKey);
    }

    public function loadFromArray($array)
    {
        return $this->categoryModel->loadFromArray($array);
    }

    public function save($array)
    {
        return $this->categoryModel->save($array);
    }

    public function delete()
    {
        return $this->categoryModel->delete();
    }

    public function getElements()
    {
        return $this->categoryModel->getElements();
    }

    public function toArray()
    {
        return $this->categoryModel->toArray();
    }

    public function insert()
    {
        return $this->categoryModel->insert();
    }

    public function update()
    {
        return $this->categoryModel->update();
    }

    public function getIdForLastElementAdded()
    {
        return $this->categoryModel->getIdForLastElementAdded();
    }

    public function checkExist($array) {
        return $this->categoryModel->checkExist($array);
    }

    
    /**
     * @return : Get all categories
     */
    public function getCategories(){
        return Application::$db->getAll("SELECT * FROM {$this->table}");
    }

    /**
     * @param $array - array
     * @return mixed
     * Delete one or more rows from database depending on the given value
     */
    public function deleteByProperty($array) {
        return $this->categoryModel->deleteByProperty($array);
    }

}