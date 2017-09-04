<?php
/**
 * Created by PhpStorm.
 * Date: 17-Aug-17
 * Time: 4:11 PM
 */


Class ArticleService extends BaseService {
    private $articleRepository;
    private $articleCategoryRepository;
    private $articleValidator;
    /**
     * ArticleService constructor.
     * @param $db - database
     */
    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
        $this->articleCategoryRepository = new BaseRepository('article_category');
    }


    public function loadFromDB($primaryKey)
    {
        return $this->articleRepository->loadFromDB($primaryKey);
    }

    public function loadFromArray($array)
    {
        return $this->articleRepository->loadFromArray($array);
    }

    public function save($data)
    {
        $data['date'] = date("Y-m-d");
        $data['author_id'] = 2;
        if ($_FILES['image']['name'][0] != '') {
            if(strlen($data['id']) != 0) {
                $this->removeImage($data['id']);
            }
            $data['image'] = $this->articleRepository->uploadImage($_FILES['image']);  // added new image
        }

//        FOARTE FAIN !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! GJ(good job) WP (well played)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validator = [
                'title' => 'required:true,minLength:10',
                'short_description' => 'required:true,minWords:3',
                'text_article' => 'required:true',
            ];
            $this->articleValidator = new Validation($validator);
            if (!$this->articleValidator->validationForm($data)) {

                return false;
            }
        }

        $this->articleRepository->save($data);

        if (strlen($data['id']) != 0)
            $id = $data['id'];
        else
            $id = $this->articleRepository->getIdForLastElementAdded()[0]['id'];
        $this->articleCategoryRepository->deleteByProperty(array('id_article' => $id));
        if (isset($data['categories'])) {
            foreach ($data['categories'] as $category) {
                $this->articleCategoryRepository->save(array('id_article' => $id, 'id_category' => $category));
            }
        }
        return true;
    }

    public function delete()
    {
        return $this->articleRepository->delete();
    }

    public function getElements()
    {
        return $this->articleRepository->getElements();
    }

    public function toArray()
    {
        return $this->articleRepository->toArray();
    }

    public function insert()
    {
        return $this->articleRepository->insert();
    }

    public function update()
    {
        return $this->articleRepository->update();
    }

    public function getIdForLastElementAdded()
    {
        return $this->articleRepository->getIdForLastElementAdded();
    }

    public function checkExist($array) {
        return $this->articleRepository->checkExist($array);
    }

    public function uploadImage($imageName) {
        return $this->articleRepository->uploadImage($imageName);
    }

    /**
     * @param $id
     */
    public function removeImage($id) {
        return $this->articleRepository->removeImage($id);
    }

    /**
     * @param $array - array
     * @return mixed
     * Delete one or more rows from database depending on the given value
     */
    public function deleteByProperty($array) {
        return $this->articleRepository->deleteByProperty($array);
    }

    /**
     * @return : Get all article
     */
    public function getArticle()
    {
        return $this->articleRepository->getArticle();
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
        return $this->articleRepository->getArticleByCategorie($categorie, $orderBy, $first, $last);
    }

    /**
     * @param $orderBy
     * @param $number_articles
     * Return the first ($number_articles) articles ordered by ($orderBy)
     * @return mixed
     */
    public function getAllArticle($orderBy, $number_articles)
    {
        return $this->articleRepository->getAllArticle($orderBy, $number_articles);
    }


    /**
     * @param $article
     * @return mixed
     */
    public function getIdAllCategoriesByArticle($article) {
        return $this->articleRepository->getIdAllCategoriesByArticle($article);
    }

    /**
     * @param $search
     * @return mixed
     */
    public function searchArticle($search)
    {
        return $this->articleRepository->searchArticle($search);
    }

    /**
     * @param $values - the values to be added
     * Insert one article in dababase
     * @return mixed
     */
    /*public function insert($values){
        return $this->articleRepository->insert($values);
    }*/

    /**
     * @param $id
     * Delete one article from database
     * @return mixed
     */
    /*public function delete($id) {
        return $this->articleRepository->delete($id);
    }*/

    /**
     * @param $values - the values to be updated
     * @param $searchField -
     * @param $compareField
     * Update one article from database
     * @return mixed
     */
    /*public function update($values,$searchField,$compareField){

        return $this->articleRepository->update($values,$searchField,$compareField);
    }*/

    /**
     * Return number of rows resulted by query
     * @return mixed
     */
    public function getNumber($array=false) {
        return $this->articleRepository->getNumber($array);
    }

    /**
     * @param $categorie
     * Return all articles by category
     * @return mixed
     */
    /*public function getArticleByCategorie($categorie,$orderBy=false,$first=false,$last=false){
        return $this->articleRepository->getArticleByCategorie($categorie,$orderBy,$first,$last);
    }*/

    /**
     * Return all articles
     * @return mixed
     */
    /*public function getAllArticles(){
        return $this->articleRepository->getArticle();
    }*/


    /**
     * @param $number_articles
     * @return mixed
     */
    /*public function getAllArticle($orderBy,$number_articles){
        return $this->articleRepository->getAllArticle($orderBy,$number_articles);
    }*/

    /**
     * @param $search
     * @return mixed
     */
    /*public function searchArticle($search){
        return $this->articleRepository->searchArticle($search);
    }*/
}