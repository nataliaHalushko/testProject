<?php


namespace App\Controllers;


class Controller
{

    protected string $rootViewsPath = '../views/';

    /**
     * @param string $viewPath
     * @param array|null $data
     */
    protected function getView(string $viewPath, ?array $data = [])
    {

        include($this->rootViewsPath . $viewPath);
    }
}