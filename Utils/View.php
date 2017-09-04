<?php
/**
 * Created by PhpStorm.
 * Date: 18-Aug-17
 * Time: 12:32 PM
 */

Class View
{
    protected $parameters = [];

    public function __get($key)
    {
        return $this->parameters[$key];
    }

    public function assign($key, $value)
    {
        return $this->parameters[$key] = $value;
    }

    public function show($template)
    {
        include_once(BASE_URL . 'View/' . $template);
    }

    public function showBack($template) {
        header(BASE_URL . 'View/' .$template);
    }

    public function getShow($template)
    {
        ob_start();
        include(BASE_URL . 'View/' . $template);
        return ob_get_clean();
    }
}