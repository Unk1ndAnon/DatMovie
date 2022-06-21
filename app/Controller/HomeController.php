<?php

namespace app\Controller;

use app\lib\config\Config;
use app\Model\HomeModel;

class HomeController
{
    private $homeModel;

    public function __construct()
    {
        $this->homeModel = new HomeModel();
    }

    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('home.html');

        $data = array(
            'destaques' => HomeModel::destaques(),
            'filmes_populares' => HomeModel::filmes_populares(1),
            'series_populares' => HomeModel::series_populares(1),
            'title' => Config::getPrefix() . 'Home'
        );

        echo $twig->render($template, $data);;
    }

}
