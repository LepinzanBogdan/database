<?php
/**
 * Created by PhpStorm.
 * Date: 17-Aug-17
 * Time: 4:45 PM
 */

Class BaseController
{

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

}