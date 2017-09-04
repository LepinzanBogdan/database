<?php
/**
 * Created by PhpStorm.
 * Date: 28-Aug-17
 * Time: 2:40 PM
 */

class ArticleRepository extends BaseRepository {

    protected $table = 'articole';
    protected $articleModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }

    public function loadFromDB($primaryKey)
    {
        return $this->articleModel->loadFromDB($primaryKey);
    }

    public function loadFromArray($array)
    {
        return $this->articleModel->loadFromArray($array);
    }

    public function save($array)
    {
        /*
        if (count($data['id']) != 0)
            $id = $data['id'];
        else
            $id = $this->articleRepository->getIdForLastElementAdded()[0]['id'];
        $data['articleCategoryRepository']->deleteByProperty(array('id_article' => $id));
        if (isset($data['categories'])) {
            foreach ($data['categories'] as $category) {
                $data['articleCategoryRepository']->save(array('id_article' => $id, 'id_category' => $category));
            }
        }
        unset($data['articleCategoryRepository']);*/
        return $this->articleModel->save($array);
    }

    public function delete()
    {
        return $this->articleModel->delete();
    }

    public function getElements()
    {
        return $this->articleModel->getElements();
    }

    public function toArray()
    {
        return $this->articleModel->toArray();
    }

    public function insert()
    {
        return $this->articleModel->insert();
    }

    public function update()
    {
        return $this->articleModel->update();
    }

    public function getIdForLastElementAdded()
    {
        return $this->articleModel->getIdForLastElementAdded();
    }

    public function checkExist($array) {
        return $this->articleModel->checkExist($array);
    }

    /**
     * @return : Get all article
     */
    public function getArticle()
    {
        return Application::$db->getAll("Select * From {$this->table}");
    }

    /**
     * @param $categorie
     * @first - first element selected
     * @last - how many elements were selected
     * @orderBy
     *
     * Get all articles from a certain category if paramaters first is false or
     * Get all articles from a certain category ordered by {$orderBy} and taken {$last} per query if paramters first it's a number
     *
     * @return :
     */
    public function getArticleByCategorie($categorie, $orderBy = false, $first = false, $last = false)
    {
        if ($last) {
            return Application::$db->getAll("Select * from {$this->table}
                      left join article_category on {$this->table}.id = article_category.id_article
                      left JOIN categorie on categorie.id = article_category.id_category
                      where categorie.id = {$categorie}
                      order by {$orderBy}
                      limit {$first},{$last}");
        } else {
            return Application::$db->getAll("Select * from {$this->table}
                left join article_category on {$this->table}.id = article_category.id_article
                left JOIN categorie on categorie.id = article_category.id_category
                where categorie.id = {$categorie}");
        }
    }

    /**
     * @param $orderBy
     * @param $number_articles
     * Return the first ($number_articles) articles ordered by ($orderBy)
     * @return mixed
     */
    public function getAllArticle($orderBy, $number_articles)
    {
        return Application::$db->getAll("Select * from {$this->table}
               inner join article_category on {$this->table}.id = article_category.id_article
               INNER JOIN categorie on categorie.id = article_category.id_category
               order by $orderBy
               limit {$number_articles}");
    }

    /**
     * @param $search
     * @return mixed
     */
    public function searchArticle($search)
    {
        return Application::$db->getAll("Select * from {$this->table}
                    inner join article_category on {$this->table}.id = article_category.id_article
                    INNER JOIN categorie on categorie.id = article_category.id_category
                    WHERE text_article LIKE '%{$search}%'
                    OR short_description LIKE '%{$search}%'
                    OR title LIKE '%{$search}%'");
    }

    /**
     * @param $array - array
     * @return mixed
     * Delete one or more rows from database depending on the given value
     */
    public function deleteByProperty($array) {
        return $this->articleModel->deleteByProperty($array);
    }

    /**
     * @param $article
     * @return mixed
     */
    public function getIdAllCategoriesByArticle($article) {
        $categories = Application::$db->getAll("Select id_category from article_category where id_article = {$article}");
        foreach ($categories as $key => $value){
            $categories[] = $value['id_category'];
        }
        return $categories;
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
}