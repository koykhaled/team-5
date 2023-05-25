<?php

namespace app\Controllers;

abstract class BaseController
{


    public function render($view, array $data = [])
    {
        extract($data);
        require_once __DIR__ .  "/$view";
    }

    public function redirect($page = "")
    {
        header("location:" . BASE_PATH . $page);
    }
}