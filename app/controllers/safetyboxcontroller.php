<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models\CategoryModel;
use Lilly\Models\ProductModel;


class SafetyBoxController extends AbstractController
{
    public function defaultAction ()
    {
        $this->lang->load('safetybox|default');
        $this->lang->load('common|template');

        $this->_render();
    }
}