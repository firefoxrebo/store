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
        $this->_data['notifications'] = Models\MailModel::get($sql);

        $this->lang->load('common|template');
        $this->lang->load('notification|common');
        $this->lang->load('notification|default');

        $this->injectDataTable();
        $this->_render();
    }

    public function viewAction()
    {
        $id = $this->_getParam(0, 'int');
        $notification = Models\NotificationModel::getByPK($id);

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