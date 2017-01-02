<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models as Models;
use Lilly\Core as Core;

class NotificationController extends AbstractController
{
    use Core\Validator;
    use Core\Filter;
    use Core\Helper;

    public function defaultAction()
    {
        $sql = 'SELECT * FROM app_notifications ';
        $sql .= 'WHERE empId = ' . $this->session->u->id . ' ';
        $sql .= 'ORDER BY id DESC';
        $this->_data['notifications'] = Models\MailModel::query(
            $sql, array(), '\Lilly\Models\NotificationModel'
        );

        $this->lang->load('common|template');
        $this->lang->load('notification|common');
        $this->lang->load('notification|default');

        $this->_template->injectFooterResource('datatables',
            JS . 'jquery.datatables.js', 'jqueryui');
        $this->_template->injectFooterResource('training', JS . 'training.js',
            'datatables');
        $this->_render();
    }

    public function viewAction()
    {
        $id = $this->_getParam(0, 'int');
        $notification = Models\NotificationModel::getById($id);

        if($notification === false || $notification->empId != $this->session->u->id) {
            $this->routeTo('/notification');
        }

        if($notification->seen == 0) {
            $notification->seen = 1;
            $notification->save();
            $this->routeTo('/notification/view/'.$notification->id);
        }

        $this->_data['notification'] = $notification;

        $this->lang->load('common|template');
        $this->lang->load('notification|common');
        $this->lang->load('notification|view');

        $this->_render();
    }
}