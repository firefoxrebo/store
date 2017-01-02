<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class NotificationModel extends AbstractModel
{

    public $id;
    public $contractId;
    public $empId;
    public $title;
    public $content;
    public $created;
    public $seen;

    public static $tableName = 'app_notifications';

    protected $tableSchema
    = array(
        'contractId',
        'empId',
        'title',
        'content',
        'created',
        'seen'
    );

    public static function notify($userPrivilege, $contractId, $subject, $content, $specific = false)
    {
        if(is_array($userPrivilege)) {
            if($specific !== false) {
                $sql = 'SELECT * FROM app_users WHERE privilege = ' . array_shift($userPrivilege) . ' AND id = ' . array_shift($userPrivilege);
                if(count($userPrivilege) > 1) {
                    $sql .= (count($userPrivilege) > 0) ? (implode(' OR id = ', $userPrivilege)) : '';
                } else {
                    $sql .= array_shift($userPrivilege);
                }

            } else {
                $privilege = implode(' OR privilege = ', $userPrivilege);
                $sql = 'SELECT * FROM app_users WHERE privilege = ' . $privilege;
            }
        } else {
            $sql = 'SELECT * FROM app_users WHERE privilege = ' . $userPrivilege;
        }

        $users = EmployeeModel::query(
            $sql, array(), '\Lilly\Models\EmployeeModel'
        );

        if($users !== false) {
            $notification = null;
            foreach ($users as $user) {
                $notification = new self;
                $notification->content = $content;
                $notification->empId = $user->id;
                $notification->title = $subject;
                $notification->contractId = $contractId;
                $notification->created = date('Y-m-d');
                $notification->seen = 0;
                $notification->save();
            }
        }
        return true;
    }

    public static function notifyOne($user, $contractId, $subject, $content)
    {
        $sql = 'SELECT * FROM app_users WHERE id = ' . $user;

        $user = EmployeeModel::query(
            $sql, array(), '\Lilly\Models\EmployeeModel'
        );

        if($user !== false) {
            $user = array_shift($user);
            $notification = null;
            $notification = new self;
            $notification->content = $content;
            $notification->empId = $user->id;
            $notification->title = $subject;
            $notification->contractId = $contractId;
            $notification->created = date('Y-m-d');
            $notification->seen = 0;
            $notification->save();
        }
        return true;
    }
}