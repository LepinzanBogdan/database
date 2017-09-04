<?php
/**
 * Created by PhpStorm.
 * Date: 28-Aug-17
 * Time: 3:06 PM
 */


class UserRepository extends BaseRepository {

    protected $table = 'user';
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function loadFromDB($primaryKey)
    {
        return $this->userModel->loadFromDB($primaryKey);
    }

    public function loadFromArray($array)
    {
        return $this->userModel->loadFromArray($array);
    }

    public function save($array)
    {
        return $this->userModel->save($array);
    }

    public function delete()
    {
        return $this->userModel->delete();
    }

    public function getElements()
    {
        return $this->userModel->getElements();
    }

    public function toArray()
    {
        return $this->userModel->toArray();
    }

    public function insert()
    {
        return $this->userModel->insert();
    }

    public function update()
    {
        return $this->userModel->update();
    }

    public function getIdForLastElementAdded()
    {
        return $this->userModel->getIdForLastElementAdded();
    }

    public function checkExist($array) {
        return $this->userModel->checkExist($array);
    }

    /**
     * @param $array - array
     * @return mixed
     * Delete one or more rows from database depending on the given value
     */
    public function deleteByProperty($array) {
        return $this->userModel->deleteByProperty($array);
    }

}