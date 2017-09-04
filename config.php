<?php include("Utils/Database.php"); ?>
<?php include("Utils/Validation.php"); ?>
<?php include("Domain/Repository/BaseRepository.php"); ?>
<?php include("Domain/Repository/UserRepository.php"); ?>
<?php include("Domain/Repository/CategoryRepository.php"); ?>
<?php include("Domain/Repository/ArticleRepository.php"); ?>
<?php include("Domain/Service/BaseService.php"); ?>
<?php include("Domain/Service/UserService.php"); ?>
<?php include("Domain/Service/ArticleService.php"); ?>
<?php include("Domain/Service/CategoryService.php"); ?>
<?php include("Domain/Controller/BaseController.php"); ?>
<?php include("Domain/Controller/UserController.php"); ?>
<?php include("Domain/Controller/ArticleController.php"); ?>
<?php include("Domain/Controller/CategoryController.php"); ?>
<?php include("Domain/Model/BaseModel.php"); ?>
<?php include("Domain/Model/UserModel.php"); ?>
<?php include("Domain/Model/CategoryModel.php"); ?>
<?php include("Domain/Model/ArticleModel.php"); ?>
<?php include("Utils/View.php"); ?>
<?php
/**
 * Created by PhpStorm.
 * Date: 18-Aug-17
 * Time: 12:28 PM
 */

define("DB_SERVER" , "localhost");
define("DB_USERNAME" , "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "blog");
define("URL_SITE", "http://localhost/DB/");
define("BASE_URL", "C:/wamp64/www/DB/");
define("UPLOADS_URL" , "C:/wamp64/www/DB/public/assets/");
define("ASSETS_PATH","http://localhost/DB/public/libs/metronic_v3.6.2/theme/assets/");

//$db = new Database(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


