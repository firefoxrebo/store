<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Core;

class LangController extends AbstractController
{
    use Core\Helper;
    public function defaultAction ()
    {
        if($_SESSION['lang'] == 'en') {
            $_SESSION['lang'] = 'ar';
        } else {
            $_SESSION['lang'] = 'en';
        }
        $this->routeTo($_SERVER['HTTP_REFERER']);
    }
}