<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models\ClientModel;
use Lilly\Models\SupplierModel;

class IndexController extends AbstractController
{
    public function defaultAction ()
    {
        $this->lang->load('index|default');
        $this->lang->load('common|template');

        $this->_data['suppliers'] = SupplierModel::count();
        $this->_data['clients'] = ClientModel::count();

        $this->_template->injectFooterResource('chart', JS . 'chart.min.js', 'main');
        $this->_render();
    }
}