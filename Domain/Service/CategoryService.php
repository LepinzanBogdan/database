<?php
/**
 * Created by PhpStorm.
 * Date: 17-Aug-17
 * Time: 4:10 PM
 */


Class CategoryService extends BaseService {
    private $categoryRepository;

    /**
     * CategoryService constructor.
     * @param $db - database
     */
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }


    public function loadFromDB($primaryKey)
    {
        return $this->categoryRepository->loadFromDB($primaryKey);
    }

    public function loadFromArray($array)
    {
        return $this->categoryRepository->loadFromArray($array);
    }

    public function save($array)
    {
        return $this->categoryRepository->save($array);
    }

    public function delete()
    {
        return $this->categoryRepository->delete();
    }

    public function getElements()
    {
        return $this->categoryRepository->getElements();
    }

    public function toArray()
    {
        return $this->categoryRepository->toArray();
    }

    public function insert()
    {
        return $this->categoryRepository->insert();
    }

    public function update()
    {
        return $this->categoryRepository->update();
    }

    public function getIdForLastElementAdded()
    {
        return $this->categoryRepository->getIdForLastElementAdded();
    }

    public function checkExist($array) {
        return $this->categoryRepository->checkExist($array);
    }

    public function uploadImage($imageName) {
        return $this->categoryRepository->uploadImage($imageName);
    }

    /**
     * @param $id
     */
    public function removeImage($id) {
        return $this->categoryRepository->removeImage($id);
    }

    /**
     * @param $array - array
     * @return mixed
     * Delete one or more rows from database depending on the given value
     */
    public function deleteByProperty($array) {
        return $this->categoryRepository->deleteByProperty($array);
    }

    /**
     * @return : Get all categories
     */
    public function getCategories(){
        return $this->categoryRepository->getCategories();
    }


    /**
     * @param $id
     * return category with the given id
     * @return mixed
     */
   /* public function getById($id) {
        return $this->categoryRepository->getById($id);
    }*/
    /**
     * @param $property
     * @param $value
     * Return all categories with property = value
     * @return mixed
     */
   /* public function getByProperty($property,$value) {
        return $this->categoryRepository->getByProperty($property,$value);
    }*/
    /**
     * @param $values - the values to be added
     * Insert one category in dababase
     * @return mixed
     */
    /*public function insert($values){
        return $this->categoryRepository->insert($values);
    }*/
    /**
     * @param $id
     * Delete one category from database
     * @return mixed
     */
    /*public function delete($id) {
        return $this->categoryRepository->delete($id);
    }*/
    /**
     * @param $values - the values to be updated
     * @param $searchField
     * @param $compareField
     * Update one category from database
     * @return mixed
     */
    /*public function update($values,$searchField,$compareField){
        return $this->categoryRepository->update($values,$searchField,$compareField);
    }*/
    /**
     * Return number of rows resulted by query
     * @return mixed
     */
    public function getNumber() {
        return $this->categoryRepository->getNumber();
    }
    /**
     * Return all categories
     * @return mixed
     */
    /*public function getAllCategories() {
        return $this->categoryRepository->getCategories();
    }*/


}