<?php
/**
 * Created by PhpStorm.
 * Date: 17-Aug-17
 * Time: 4:45 PM
 */


Class ArticleController extends BaseController
{

    private $articleService;
    private $categoryService;

    /**
     * ArticleController constructor.
     * @param $db - database
     */
    public function __construct($db)
    {
        $this->articleService = new ArticleService();
        $this->categoryService = new CategoryService();
        return parent::__construct();
    }


    /**
     * Show all articles
     * @return mixed
     */
    public function showArticle($data)
    {
        $articles = $this->articleService->getArticle();
        $categories = $this->categoryService->getCategories();
        $this->view->assign('articles', $articles);
        $this->view->assign('categories', $categories);
        $this->view->assign('title', 'Article');
        return $this->view->show("articleView.php");
    }

    /**
     * Function for Add, delete and update article;
     */
    public function addDeleteUpdateArticle($data)
    {
        $articles = $this->articleService->getElements();
        $this->view->assign('id_user',$data['id_user']);
        $this->view->assign('articles', $articles);
        $this->view->assign('title', 'addDeleteUpdatePage');
        return $this->view->show('addDeleteUpdateArticle.php');
    }

    /**
     * @param $data - Url's parameters
     * Add and edit function
     */
    public function addUpdateArticle($data, $keepData = false)
    {
        $this->view->assign('id_user',$data['id_user']);
        $categories = $this->categoryService->getElements();
        $this->view->assign('categories', $categories);
        $this->view->assign('title', 'add-edit');
        if (isset($data['id']) && strlen($data['id']) != 0) {
            if (!$keepData) {
                $this->articleService->loadFromDB($data['id']);
            } else {
                $this->articleService->loadFromArray($data);
            }
            $article = $this->articleService->toArray();
            $idCategories = $this->articleService->getIdAllCategoriesByArticle($data['id']);
            $this->view->assign('idCategories', $idCategories);
            $this->view->assign('article', $article);
            $this->view->assign('idArticle', $data['id']);
        } else {
            if ($keepData) {
                $this->articleService->loadFromArray($data);
                $article = $this->articleService->toArray();
                $this->view->assign('article', $article);
            }
            $this->view->assign('idArticle', null);
        }
        return $this->view->show('addUpdateArticle.php');
    }

    /**
     * @param $data - URL's parameters
     */
    public function actionSaveArticle($data)
    {
        $this->view->assign('id_user',$data['id_user']);
        if (!$this->articleService->save($data)) {
            $this->addUpdateArticle($data, true);
        } else {
            header("Location: http://localhost/DB/article-add-delete-update/".$data['id_user']);
        }
    }

    /**
     * @param $data
     */
    public function deleteArticle($data)
    {

        $this->view->assign('id_user',$data['id_user']);
        $this->articleService->loadFromDB($data['id']);
        $article = $this->articleService->toArray();
        if (isset($article['image'])) {
            $this->articleService->removeImage($data['id']);
        }
        return $this->articleService->delete();
    }

    /**
     * Function for Add, delete and update category ;
     */
    public function addDeleteUpdateCategory($data)
    {

        $this->view->assign('id_user',$data['id_user']);
        $categories = $this->categoryService->getElements();
        $this->view->assign('categories', $categories);
        $this->view->assign('title', 'addDeleteUpdateCategory');
        return $this->view->show('addDeleteUpdateCategory.php');
    }

    /**
     * @param $data - Url's parameters
     * Add and edit function
     */
    public function addUpdateCategory($data)
    {
        $this->view->assign('id_user',$data['id_user']);
        $this->view->assign('title', 'add-edit-category');
        if (isset($data['id'])) {
            $this->categoryService->loadFromDB($data['id']);
            $category = $this->categoryService->toArray();
            $this->view->assign('category', $category);
            $this->view->assign('idCategory', $data['id']);
        } else {
            $this->view->assign('idCategory', null);
        }
        return $this->view->show('addUpdateCategory.php');
    }

    /**
     * @param $data - URL's parameters
     */
    public function actionSaveCategory($data)
    {
        $this->view->assign('id_user',$data['id_user']);
        if (!$this->categoryService->save($data)) {
            $this->addUpdateCategory($data);
        }
        header("Location: http://localhost/DB/category-add-delete-update/".$data['id_user']);
    }

    /**
     * @param $data
     */
    public function deleteCategory($data)
    {
        $this->view->assign('id_user',$data['id_user']);
        $this->categoryService->loadFromDB($data['id']);
        $this->categoryService->delete();
    }


    /**
     * @param $data - url's paramaters
     * Show all articles by given category
     * @return mixed
     */
    public function showArticleCategory($data)
    {
        $articlesCategory = $this->articleService->getArticleByCategorie($data['id'], 'date', $data['page'] * 5 - 5, 5);
        $numberArticles = $this->articleService->getNumber($this->articleService->getArticleByCategorie($data['id']));
        if (!count($articlesCategory) == 0) {
            $this->view->assign('articlesCategory', $articlesCategory);
            $this->view->assign('numberArticles', $numberArticles);
        }
        $categories = $this->categoryService->getCategories();
        $this->view->assign('categories', $categories);
        $this->view->assign('title', 'Article-Category');
        return $this->view->show("articleCategorieView.php");
    }

    /**
     * @param $data
     *
     * Shows the selected article, the category to which it belongs and recommendations with others articles from this category.
     *
     * @return mixed
     */
    public function showArticleDetails($data)
    {
        $this->articleService->loadFromDB($data['id']);
        $article = $this->articleService->toArray();
        $categories = $this->categoryService->getCategories();
        $articlesRandom = $this->articleService->getArticleByCategorie($data['category_id'], 'rand()', 0, 3);
        $this->view->assign('title', 'Article-Details');
        $this->view->assign('id_category', $data['category_id']);
        $this->view->assign('categories', $categories);
        $this->view->assign('article', $article);
        $this->view->assign('articlesRandom', $articlesRandom);
        return $this->view->show('articleDetailsView.php');
    }

    /**
     * @param $data - url's paramters
     * update views for the selected article
     */
    public function updateView($data)
    {
        $views = $data['views'] + 1;
        $this->articleService->save(array('id' => $data['idArticol'], 'vizualizari' => $views));
        $this->articleService->loadFromDB($data['idArticol']);
        $article = $this->articleService->toArray();
        echo $article['vizualizari'];
    }

    public function searchArticle($data)
    {
        $inputValue = $data['inputValue'];
        $searchArticles = $this->articleService->searchArticle($inputValue);
        $this->view->assign("articles", $searchArticles);
        $info["viewArticles"] = $this->view->getShow("article.php");
        $info["numberOfArticles"] = count($searchArticles);
        echo json_encode($info);
    }


    public function hasPermission($functionName)
    {
        if (UserController::isAdmin()) {
            switch ($functionName) {
                case 'addDeleteUpdateArticle':
                    return true;
                    break;
                case 'addUpdateArticle':
                    return true;
                    break;
                case 'actionSaveArticle':
                    return true;
                    break;
                case 'deleteArticle':
                    return true;
                    break;
                case 'addDeleteUpdateCategory':
                    return true;
                    break;
                case 'addUpdateCategory':
                    return true;
                    break;
                case 'actionSaveCategory':
                    return true;
                    break;
                case 'deleteCategory':
                    return true;
                    break;
            }
        }
        if (UserController::isUser()){
            switch ($functionName) {
                case 'addDeleteUpdateCategory':
                    return true;
                    break;
                case 'addDeleteUpdateArticle':
                    return true;
                    break;
            }
        }
        switch ($functionName) {
            case 'showArticle':
                return true;
                break;
            case 'showArticleCategory':
                return true;
                break;
            case 'showArticleDetails':
                return true;
                break;
            case 'updateView':
                return true;
                break;
            case 'searchArticle':
                return true;
                break;
        }

        return false;

    }
}