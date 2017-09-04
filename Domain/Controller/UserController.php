<?php
/**
 * Created by PhpStorm.
 * Date: 30-Aug-17
 * Time: 3:48 PM
 */

Class UserController extends BaseController
{
    private $articleService;
    private $userService;

    /**
     * ArticleController constructor.
     * @param $db - database
     */
    public function __construct($db)
    {
        $this->userService = new UserService();
        $this->articleService = new ArticleService();
        return parent::__construct();
    }

    public function login()
    {
        $this->view->assign('title', 'login');
        return $this->view->show('login.php');
    }

    public function submitLogin($data)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = $data['username'];
            $password = md5($data['password']);
            $check = $this->userService->checkExist(array('username' => $username, 'password' => $password));
            if (count($check) == 0) {
                echo 'Your Username or Password is invalid';
                $this->login();
            } else {
                $_SESSION['login_user'][$check['id']] = $username;
                if (isset($_SESSION['id_user1']) && $_SESSION['role'][$_SESSION['id_user1']] != $check['role']) {
                    $_SESSION['id_user2'] = $check['id'];
                    $_SESSION['role'][$check['id']] = $check['role'];
                } else {
                    $_SESSION['id_user1'] = $check['id'];
                    $_SESSION['role'][$check['id']] = $check['role'];
                }
                header("Location: http://localhost/DB/article-add-delete-update/{$check['id']}");
            }
        }
    }

    /**
     * @param $data - Url's parameters
     * Add and edit function
     */
    public function register($data, $keepData = false)
    {
        $this->view->assign('title', 'register-user');
        if ($keepData) {
            $this->userService->loadFromArray($data);
            $user = $this->userService->toArray();
            $this->view->assign('user', $user);
        }
        return $this->view->show('registerUser.php');
    }

    /**
     * @param $data - URL's parameters
     */
    public function createAccount($data)
    {
        if (!$this->userService->save($data)) {
            $data['password'] = '';
            $this->register($data, true);
        } else {
            header('Location: http://localhost/DB/login.php');
        }
    }

    public function logout($data)
    {
        unset($_SESSION['login_user'][$data['id_user']]);
        if (count($_SESSION['login_user']) == 1) {
            session_destroy();
            header("Location: http://localhost/DB/login");
        } else {
            header("Location: http://localhost/DB/login");
        }
    }

    public static function isAdmin()
    {
        if (isset($_REQUEST['id_user'])) {
            if (isset($_SESSION['id_user2']) && isset($_SESSION['login_user'][$_SESSION['id_user2']]) && $_SESSION['role'][$_REQUEST['id_user']] == 'admin') {
                return true;
            }
            if (isset($_SESSION['id_user1']) && isset($_SESSION['login_user'][$_SESSION['id_user1']]) && $_SESSION['role'][$_REQUEST['id_user']] == 'admin') {
                return true;
            }
        }
        return false;
    }

    public static function isUser()
    {
        if (isset($_REQUEST['id_user'])) {
            if (isset($_SESSION['id_user1']) && isset($_SESSION['login_user'][$_SESSION['id_user1']]) && $_SESSION['role'][$_REQUEST['id_user']] == 'user') {
                return true;
            }
            if (isset($_SESSION['id_user2']) && isset($_SESSION['login_user'][$_SESSION['id_user2']]) && $_SESSION['role'][$_REQUEST['id_user']] == 'user') {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($functionName)
    {
        if ($this->isAdmin()) {
            return true;
        }
        if ($this->isUser()) {
            return true;
        }
        switch ($functionName) {
            case 'login' :
                return true;
            case 'submitLogin' :
                return true;
            case 'register' :
                return true;
            case 'createAccount' :
                return true;
            case 'logout' :
                return true;
        }

        return false;
    }


}