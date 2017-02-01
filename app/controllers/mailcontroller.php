<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;

use Lilly\Models as Models;
use Lilly\Core as Core;

class MailController extends AbstractController
{
    use Core\Validator;
    use Core\Filter;
    use Core\Helper;

    public function defaultAction()
    {
        $mailSQL = 'SELECT am.*, au.ucname as sender FROM app_mail as am ';
        $mailSQL .= 'LEFT JOIN app_users as au ON am.senderId = au.id ';
        $mailSQL .= 'WHERE am.receiverId = ' . $this->session->u->id . ' ';
        $mailSQL .= 'ORDER BY am.created DESC';
        $this->_data['mail'] = Models\MailModel::get($mailSQL);

        $this->lang->load('common|template');
        $this->lang->load('mail|common');
        $this->lang->load('mail|default');

        $this->injectDataTable();

        $this->_render();
    }

    public function sentAction()
    {
        $mailSQL = 'SELECT am.*, au.ucname as receiver FROM app_mail as am ';
        $mailSQL .= 'LEFT JOIN app_users as au ON am.receiverId = au.id ';
        $mailSQL .= 'WHERE am.senderId = ' . $this->session->u->id . ' ';
        $mailSQL .= 'ORDER BY am.created DESC';
        $this->_data['mail'] = Models\MailModel::get($mailSQL);

        $this->lang->load('common|template');
        $this->lang->load('mail|common');
        $this->lang->load('mail|sent');

        $this->injectDataTable();
        $this->_render();
    }

    public function newAction()
    {

        $this->_data['allowedUsers'] = Models\UserModel::listUsers($this->session->u->id);

        if(isset($_POST['submit']) && isset($_POST['content'])) {

            if(!$this->requestHasValidToken($_POST['token'])) {
                $this->routeTo('/mail');
            }

            $receiversList = $_POST['receiverId'];

            if(empty($receiversList)) {
                $this->routeTo('/mail');
            }

            $content = $this->filterString($_POST['content']);
            $title = $this->filterString($_POST['title']);
            $mail = null;

            foreach($receiversList as $receiver) {
                $mail = new Models\MailModel;
                $mail->senderId = $this->session->u->id;
                $receiverObj = Models\UserModel::getByPK($this->filterString($receiver));
                if($receiverObj === false)  {
                    $failedMail = new Models\MailModel();
                    $failedMail->senderId = $this->session->u->id;
                    $failedMail->receiverId = $this->session->u->id;
                    $failedMail->created = date('Y-m-d H:i:s');
                    $failedMail->content = $this->lang->get('mail|messages', 'receiver_not_found_message', array($receiver));
                    $failedMail->title = $this->lang->get('mail|messages', 'receiver_not_found_title');
                    $failedMail->seen = 0;
                    $failedMail->save();
                    continue;
                }
                $mail->receiverId = $receiverObj->id;
                $mail->created = date('Y-m-d H:i:s');
                $mail->content = $content;
                $mail->title = $title;
                $mail->seen = 0;
                $mail->save();
            }

            $this->messenger->add('message', $this->lang->get('mail|common', 'mail_sent_success'));
            $this->routeTo('/mail');
        }

        $this->lang->load('common|template');
        $this->lang->load('mail|common');
        $this->lang->load('mail|new');

        $this->_render();
    }

    public function viewAction()
    {
        $id = $this->_getParam(0, 'int');
        $mail = Models\MailModel::getByPK($id);

        if($mail === false || $mail->receiverId != $this->session->u->id) {
            $this->routeTo('/mail');
        }

        if($mail->seen == 0) {
            $mail->seen = 1;
            $mail->save();
            $this->routeTo('/mail/view/'.$mail->id);
        }

        $this->_data['mail'] = $mail;
        $this->_data['sender'] = Models\UserModel::getByPK($mail->senderId);

        $this->lang->load('common|template');
        $this->lang->load('mail|common');
        $this->lang->load('mail|view');

        $this->_render();
    }

    public function forwardAction()
    {
        $id = $this->_getParam(0, 'int');
        $mail = Models\MailModel::getByPK($id);

        if($mail === false || $mail->receiverId != $this->session->u->id) {
            $this->routeTo('/mail');
        }

        $this->_data['mtitle'] = $mail->title;
        $this->_data['content'] = $mail->content;


        $this->_data['allowedUsers'] = Models\UserModel::listUsers($this->session->u->id);

        if(isset($_POST['submit']) && isset($_POST['content'])) {

            if(!$this->requestHasValidToken($_POST['token'])) {
                $this->routeTo('/mail');
            }

            $receiversList = $_POST['receiverId'];

            if(empty($receiversList)) {
                $this->routeTo('/mail');
            }

            $content = $this->filterString($_POST['content']);
            $title = $this->filterString($_POST['title']);
            $mail = null;

            foreach($receiversList as $receiver) {
                $mail = new Models\MailModel;
                $mail->senderId = $this->session->u->id;
                $receiverObj = Models\UserModel::getByPK($this->filterString($receiver));
                if($receiverObj === false)  {
                    $failedMail = new Models\MailModel();
                    $failedMail->senderId = $this->session->u->id;
                    $failedMail->receiverId = $this->session->u->id;
                    $failedMail->created = date('Y-m-d H:i:s');
                    $failedMail->content = $this->lang->get('mail|messages', 'receiver_not_found_message', array($receiver));
                    $failedMail->title = $this->lang->get('mail|messages', 'receiver_not_found_title');
                    $failedMail->seen = 0;
                    $failedMail->save();
                    continue;
                }
                $mail->receiverId = $receiverObj->id;
                $mail->created = date('Y-m-d H:i:s');
                $mail->content = $content;
                $mail->title = $title;
                $mail->seen = 0;
                $mail->save();
            }

            $this->messenger->add('message', $this->lang->get('mail|common', 'mail_sent_success'));
            $this->routeTo('/mail');
        }

        $this->lang->load('common|template');
        $this->lang->load('mail|common');
        $this->lang->load('mail|forward');

        $this->_render();
    }

    public function replyAction()
    {
        $id = $this->_getParam(0, 'int');
        $mail = Models\MailModel::getByPK($id);

        if($mail === false || $mail->receiverId != $this->session->u->id) {
            $this->routeTo('/mail');
        }

        $this->_data['mail'] = $mail;

        if(isset($_POST['submit']) && isset($_POST['content'])) {
            if(!$this->requestHasValidToken($_POST['token'])) {
                $this->routeTo('/mail');
            }
            $newmail = new Models\MailModel();
            $newmail->senderId = $this->session->u->id;
            $newmail->receiverId = $mail->senderId;
            $newmail->created = date('Y-m-d H:i:s');
            $newmail->content = $this->filterString($_POST['content']);
            $newmail->title = $this->filterString($_POST['title']);
            $newmail->seen = 0;
            $newmail->save();

            $this->messenger->add('message', $this->lang->get('mail|common', 'mail_sent_success'));
            $this->routeTo('/mail');
        }

        $this->lang->load('common|template');
        $this->lang->load('mail|common');
        $this->lang->load('mail|reply');

        $this->_render();
    }

    public function deleteAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/mail');
        }
        $id = $this->_getParam(0, 'int');
        $mail = Models\MailModel::getByPK($id);

        if($mail === false || $mail->receiverId != $this->session->u->id) {
            $this->routeTo('/mail');
        }

        if($mail->delete()) {
            $this->messenger->add('message', $this->lang->get('mail|messages', 'mail_delete_success'));
        } else {
            $this->messenger->add('message', $this->lang->get('mail|messages', 'mail_delete_failed'), Core\Messenger::STATUS_ERROR);
        }
        $this->routeTo('/mail');
    }
}