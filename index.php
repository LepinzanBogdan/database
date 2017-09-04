<?php include("config.php"); ?>
<?php include("Application.php"); ?>

<?php
/**
 * Created by PhpStorm.
 * Date: 17-Aug-17
 * Time: 10:21 AM
 */
//$action = $_GET['action'];
//if(isset($_GET['action'])) {
//
//    switch ($action) {
//        case 'showArticles' :
//            $articleController = new ArticleController($c);
//            $articleController->showArticle();
//            break;
//        case 'showCategories' :
//            $categoryController = new CategoryController($c);
//            $categoryController->showCategories();
//            break;
//        case 'showArticlesByCategory' :
//            $articleController = new ArticleController($c);
//            $articleController->showArticleCategory($_GET['id']);
//            break;
//        default :
//            break;
//    }
//}
$app = new Application($_REQUEST);
$app->run();
