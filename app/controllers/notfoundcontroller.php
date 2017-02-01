<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;

class NotFoundController extends AbstractController
{
    public function defaultAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('notfound|common');
        $this->_render();
    }
}