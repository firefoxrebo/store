<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models\CategoryModel;
use Lilly\Models\ProductModel;


class StoreController extends AbstractController
{
    public function defaultAction ()
    {
        $this->lang->load('store|default');
        $this->lang->load('common|template');

        $this->_data['categories'] = CategoryModel::count();
        $this->_data['products'] = ProductModel::count();

        $this->_template->injectFooterResource('chart', JS . 'chart.min.js', 'main');
        $this->_render();
    }
}