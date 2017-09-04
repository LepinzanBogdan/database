<?php
/**
 * Created by PhpStorm.
 * Date: 17-Aug-17
 * Time: 4:45 PM
 */


Class CategoryController extends BaseController
{

    private $categoryService;
    private $articleService;
    private $articleModel;

    /**
     * CategoryController constructor.
     * @param $db - database
     */
    public function __construct($db)
    {
        $this->categoryService = new CategoryService($db);
        $this->articleService = new ArticleService($db);
        return parent::__construct();
    }


    /**
     * @param $data - url's parameters
     *
     * Show all categories.
     *
     * @return mixed
     */
    public function showCategories($data)
    {
        $categories = $this->categoryService->getCategories();
        $articles = $this->articleService->getAllArticle('rand()', 5);
        $this->view->assign('categories', $categories);
        $this->view->assign('articles', $articles);
        $this->view->assign('title', 'Category');
        return $this->view->show("categoryView.php");
    }


    public function hasPermission($functionName)
    {
        if (UserController::isAdmin()) {

        }
        if (UserController::isUser()) {

        }
        switch ($functionName) {
            case 'showCategories':
                return true;
        }
        return false;
    }
}