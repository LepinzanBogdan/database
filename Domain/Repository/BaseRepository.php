<?php
/**
 * Created by PhpStorm.
 * Date: 17-Aug-17
 * Time: 1:06 PM
 */

Class BaseRepository
{

    protected $baseModel;

    /**
     * BaseRepository constructor.
     * @param $db
     */
    public function __construct($table = false, $pk = false)
    {
        $this->baseModel = new BaseModel($table, $pk);
    }

    public function loadFromDB($primaryKey)
    {
        return $this->baseModel->loadFromDB($primaryKey);
    }

    public function loadFromArray($array)
    {
        return $this->baseModel->loadFromArray($array);
    }

    public function save($array)
    {
        return $this->baseModel->save($array);
    }

    public function delete()
    {
        return $this->baseModel->delete();
    }

    public function getElements()
    {
        return $this->baseModel->getElements();
    }

    public function toArray()
    {
        return $this->baseModel->toArray();
    }

    public function insert()
    {
        return $this->baseModel->insert();
    }

    public function update()
    {
        return $this->baseModel->update();
    }

    public function getIdForLastElementAdded()
    {
        return $this->baseModel->getIdForLastElementAdded();
    }

    public function checkExist($array)
    {
        return $this->baseModel->checkExist($array);
    }

    /**
     * @param $image - represents the file that was uploaded.
     * @return string - it is the name of the image
     */
    public function uploadImage($image)
    {
        $target_dir = UPLOADS_URL . "uploads/";  // this is the directory where the image is saved
        $target_file = $target_dir . substr($image['name'][0], 0, strpos($image['name'][0], '.')) . '' . time() . '' .
            substr($image['name'][0], strpos($image['name'][0], '.'), strlen($image['name'][0])); //specifies the path of the file to be uploaded
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($image['tmp_name'][0]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($image['size'][0] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($image['tmp_name'][0], $target_file)) {
                echo "The file " . basename($image['name'][0]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        return substr($image['name'][0], 0, strpos($image['name'][0], '.')) . '' . time() . '' . substr($image['name'][0], strpos($image['name'][0], '.'), strlen($image['name'][0]));
    }

    /**
     * @param $id - load record where primary key is equal with $id
     * remove image from uploads directory.
     */
    public function removeImage($id) {
        $this->loadFromDB($id);
        $image = $this->toArray()['image'];
        unlink(UPLOADS_URL . "uploads/". $image);
    }

    /**
     * @param bool $array
     * Get number of rows
     * @return int
     */
    public function getNumber($array = false)
    {
        if (!$array) {
            return $this->db->getCount("Select * FROM {$this->table}");
        } else
            return count($array);
    }


    /**
     * @param $array - array
     * @return mixed
     * Delete one or more rows from database depending on the given value
     */
    public function deleteByProperty($array)
    {
        return $this->baseModel->deleteByProperty($array);
    }

    /**
     * @param $values
     * @return
     * Insert one row
     */

    /*public function insert($values)
    {
        $val = implode(',', array_values($values));  //make string from array - for values
        $keys = implode(',', array_keys($values));   // make string from array - for keys
        return $this->db->execute("INSERT INTO {$this->table} ({$keys}) VALUES ({$val})");
    }*/

    /**
     * @param $id
     * @return
     * Delete one row
     */
    /*public function delete($id)
    {
        return $this->db->execute("DELETE FROM {$this->table} WHERE id={$id}");
    }*/

    /**
     * @param $values - array $keys represent the columns and $value represent the values to be added
     * @param $searchField -
     * @param $compareField -
     * @return
     * Update one row
     */
    /*public function update($values, $searchField, $compareField)
    {
        $fields = "";
        foreach ($values as $keys => $value) {
            $fields .= $keys . "=" . $value . ",";
        }
        $fields = trim($fields, ",");
        return $this->db->execute("UPDATE {$this->table} SET {$fields} WHERE {$searchField}={$compareField}");
    }*/


}