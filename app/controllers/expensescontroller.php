<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models\CategoryModel;
use Lilly\Models\ProductModel;


class ExpensesController extends AbstractController
{
    public function defaultAction ()
    {
        $this->lang->load('expenses|default');
        $this->lang->load('common|template');

        $this->_template->injectFooterResource('chart', JS . 'chart.min.js', 'main');
        $this->_render();
    }
}