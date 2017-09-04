<?php
/**
 * Created by PhpStorm.
 * Date: 18-Aug-17
 * Time: 4:55 PM
 */

Class Application
{
    public static $db;
    protected $request;
    protected $components = [];

    /**
     * Application constructor.
     * @param $request
     */
    public function __construct($request)
    {
        session_start();
        Application::$db = new Database(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $this->request = $request;
    }

    /**
     * Execute the function from action.
     * @return mixed
     */
    public function run()
    {

        if (isset($this->request['action'])) {
            $parseAction = explode("_", $this->request['action']);
            $className = $parseAction[0];
            $functionName = $parseAction[1];
            if (class_exists($className)) {
                if (method_exists($className, $functionName)) {
                    if (($functionName == 'deleteArticle' || $functionName == 'deleteCategory') && UserController::isUser()) {
                        echo 'No Permission';
                    } else if ($this->getComponent($className)->hasPermission($functionName)) {
                        return $this->getComponent($className)->$functionName($this->request);
                    } else {
                        die("No Permission");
                    }
                } else die("Method doesn't exist.");
            } else die("Class doesn't exist.");
        } else die("Action isn't set");
    }

    /**
     * @param $className : string -> name of the class you want
     *
     * This function receives the parameter (className) which is name of the class
     * and return the object class;
     * If not exist in array it must be added.
     *
     * @return object
     */
    public
    function getComponent($className)
    {
        if (!in_array($className, $this->components)) {
            $this->components[$className] = new $className(Application::$db);
        }
        return $this->components[$className];
    }

}