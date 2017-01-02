<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;

class IndexController extends AbstractController
{
    public function defaultAction ()
    {
        $this->lang->load('index|default');
        $this->lang->load('common|template');
        $this->_render();
    }
}