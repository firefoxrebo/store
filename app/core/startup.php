<?php
namespace Lilly\Core;
use Lilly\Models;

/**
 * This calss is used to call all startup methods 
 * that could retreive required data to startup
 */

final class Startup
{
    private $data = array();
    
    public function __construct() {

        global $session;

        if(isset($session->logged)) {
            $reflection = new \ReflectionClass(__CLASS__);
            $methods = $reflection->getMethods(\ReflectionMethod::IS_PRIVATE);

            if(!empty($methods)) {
                foreach ($methods as $method) {
                    call_user_func(array($this, $method->name));
                }
            }
        }
    }
    
    private function getTotalMail()
    {
        global $session;

        if(array_key_exists('u', $_SESSION)) {
            $userId = $session->u->id;
            $total = Models\MailModel::getOne('SELECT count(*) as total FROM app_mail WHERE seen = 0 AND receiverId = ' . $userId);
            $this->mailTotal = ($total !== false) ? $total->total : 0;
        }
    }
    
    private function getTotalNotifications()
    {
        global $session;

        if(array_key_exists('u', $_SESSION)) {
            $userId = $session->u->id;
            $total = Models\NotificationModel::get('SELECT * FROM app_notifications WHERE seen = 0 AND empId = ' . $userId . ' ORDER BY id DESC');
            $this->notificationsTotal = ($total !== false) ? $total : false;
        }
    }

    public function __get($key)
    {
        if(array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            trigger_error('No key ' . $key . ' found in startup data array', E_USER_NOTICE);
        }
    }
    
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }
}