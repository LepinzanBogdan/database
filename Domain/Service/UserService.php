<?php
/**
 * Created by PhpStorm.
 * Date: 17-Aug-17
 * Time: 4:10 PM
 */


Class UserService extends BaseService
{
    private $userRespository;
    private $userValidator;

    /**
     * CategoryService constructor.
     * @param $db - database
     */
    public function __construct()
    {
        $this->userRespository = new UserRepository();
    }


    public function loadFromDB($primaryKey)
    {
        return $this->userRespository->loadFromDB($primaryKey);
    }

    public function loadFromArray($array)
    {
        return $this->userRespository->loadFromArray($array);
    }

    public function save($data)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validator = [
                'username' => 'required:true',
                'password' => 'required:true,minLength:6',
                'age' => 'required:true',
            ];
            $this->userValidator = new Validation($validator);
            if (!$this->userValidator->validationForm($data)) {
                return false;
            }
        }
        $data['password'] = md5($data['password']);
        $this->userRespository->save($data);
        return true;
    }

    public function delete()
    {
        return $this->userRespository->delete();
    }

    public function getElements()
    {
        return $this->userRespository->getElements();
    }

    public function toArray()
    {
        return $this->userRespository->toArray();
    }

    public function insert()
    {
        return $this->userRespository->insert();
    }

    public function update()
    {
        return $this->userRespository->update();
    }

    public function getIdForLastElementAdded()
    {
        return $this->userRespository->getIdForLastElementAdded();
    }

    public function checkExist($array)
    {
        return $this->userRespository->checkExist($array);
    }

    public function uploadImage($imageName)
    {
        return $this->userRespository->uploadImage($imageName);
    }

    /**
     * @param $id
     */
    public function removeImage($id)
    {
        return $this->userRespository->removeImage($id);
    }

    /**
     * @param $array - array
     * @return mixed
     * Delete one or more rows from database depending on the given value
     */
    public function deleteByProperty($array)
    {
        return $this->userRespository->deleteByProperty($array);
    }

    public function getNumber()
    {
        return $this->userRespository->getNumber();
    }


}