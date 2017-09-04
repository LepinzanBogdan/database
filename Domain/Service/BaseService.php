<?php
/**
 * Created by PhpStorm.
 * Date: 17-Aug-17
 * Time: 4:06 PM
 */

Class BaseService {

    protected $baseRepository;

    /**
     * CategoryService constructor.
     * @param $db - database
     */
    public function __construct($table = false , $pk = false)
    {
        $this->baseRepository = new BaseRepository($table,$pk);
    }


    public function loadFromDB($primaryKey)
    {
        return $this->baseRepository->loadFromDB($primaryKey);
    }

    public function loadFromArray($array)
    {
        return $this->baseRepository->loadFromArray($array);
    }

    public function save($array)
    {
        return $this->baseRepository->save($array);
    }

    public function delete()
    {
        return $this->baseRepository->delete();
    }

    public function getElements()
    {
        return $this->baseRepository->getElements();
    }

    public function toArray()
    {
        return $this->baseRepository->toArray();
    }

    public function insert()
    {
        return $this->baseRepository->insert();
    }

    public function update()
    {
        return $this->baseRepository->update();
    }

    public function getIdForLastElementAdded()
    {
        return $this->baseRepository->getIdForLastElementAdded();
    }

    public function checkExist($array) {
        return $this->baseRepository->checkExist($array);
    }

    public function uploadImage($imageName) {
        return $this->baseRepository->uploadImage($imageName);
    }

    /**
     * Return number of rows resulted by query
     * @return mixed
     */
    public function getNumber() {
        return $this->categoryRepository->getNumber();
    }

    /**
     * @param $id
     */
    public function removeImage($id) {
        return $this->baseRepository->removeImage($id);
    }

    /**
     * @param $array - array
     * @return mixed
     * Delete one or more rows from database depending on the given value
     */
    public function deleteByProperty($array) {
        return $this->baseRepository->deleteByProperty($array);
    }
}
