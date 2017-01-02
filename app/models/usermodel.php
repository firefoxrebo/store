<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;
use Lilly\Core\ACL as ACL;

class UserModel extends AbstractModel
{

    public $id;

    public $ucname;

    public $ucpwd;
    
    public $joined;
    
    public $privilege;
    
    public $status;

    public $lastlogin;

    public $canAddUser;

    public $permissions = array();

    protected static $tableName = 'app_users';

    protected static $tableSchema = array(
        'ucname'            => self::DATA_TYPE_STR,
        'ucpwd'             => self::DATA_TYPE_INT,
        'joined'            => self::DATA_TYPE_DATE,
        'privilege'         => self::DATA_TYPE_INT,
        'status'            => self::DATA_TYPE_INT,
        'lastlogin'         => self::DATA_TYPE_DATE,
        'canAddUser'        => self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'id';

    public function cryptPwd($password)
    {
        // Generate a random unique 22 alphanumeric characters
        $iv = substr(bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_RANDOM)), 0, 22);
        // Generate the bluefish salt, Use the $2y$ for security fix from PHP >= 5.3.7
        // otherwise use the $2a$ prefix for backward compatibility
        $sault = '$2y$10$' . $iv;
        // Hash the password
        $this->ucpwd = crypt($password, $sault);
    }
    
    public static function isEmpExists($ucname)
    {
        $query = 'SELECT * FROM ' . self::$tableName . ' WHERE ucname = "' . $ucname . '"';
        $foundUser = self::get($query);
        if($foundUser !== false) {
            return true;
        }
        return false;
    }

    public static function isEmailExists($email)
    {
        $query = 'SELECT * FROM app_users_profile WHERE email = "' . $email . '"';
        $foundUser = ProfileModel::get($query);
        if($foundUser !== false) {
            return true;
        }
        return false;
    }
    
    public static function authenticate($username, $password)
    {
        $query = 'SELECT * FROM ' . self::$tableName . ' WHERE ucname= :ucname';
        $foundUser = self::get($query, array('ucname' => array(self::DATA_TYPE_STR, $username)));
        if($foundUser !== false) {
            $hashedPassword = crypt($password, $foundUser->ucpwd);
            if($hashedPassword === $foundUser->ucpwd) {
                if($foundUser->status == 2) {
                    return 2;
                } else {
                    $_SESSION['logged'] = 1;
                    $ruleObj = ACL\Role::roleFactory($foundUser->privilege);
                    $foundUser->permissions = $ruleObj->getRoles();
                    $_SESSION['u'] = serialize($foundUser);
                    return 1;
                }
            }
        }
        return false;
    }
    
    public static function listUsers($currentUserId)
    {
        return self::get('SELECT au.*, (SELECT name FROM app_schools WHERE app_schools.id = au.schoolId) schoolName FROM ' . self::$tableName . ' as au WHERE au.id != ' . $currentUserId);
    }
    
    public function getPrivilege($dictionary)
    {
        $privilege = '';
        switch ($this->privilege) {
            case 1:
                $privilege = $dictionary['text_privilege_manager'];
                break;
            case 2:
                $privilege = $dictionary['text_privilege_school_manager'];
                break;
            case 3:
                $privilege = $dictionary['text_privilege_school_supervisor'];
                break;
            case 4:
                $privilege = $dictionary['text_privilege_school_teacher'];
                break;
            case 5:
                $privilege = $dictionary['text_privilege_parent'];
                break;
            case 6:
                $privilege = $dictionary['text_privilege_demo'];
                break;
        }
        return $privilege;
    }
    
    public function getStatus($dictionary)
    {
        $status = '';
        switch ($this->status) {
            case 1:
                $status = $dictionary['text_status_enabled'];
                break;
            case 2:
                $status = $dictionary['text_status_disabled'];
                break;
        }
        return $status;
    }

    public function getProfile()
    {
        return ProfileModel::get('SELECT * FROM app_users_profile WHERE userid = ' . $this->id)->current();
    }
    
    public function __sleep() {
        return array(
            'id',
            'ucname',
            'ucpwd',
            'joined',
            'privilege',
            'status',
            'lastlogin',
            'permissions',
            'schoolId'
        );
    }

    public static function getUserByUCName($ucname)
    {
        $sql = 'SELECT * FROM ' . self::$tableName . " WHERE ucname = '" . $ucname . "'";
        $user = self::get($sql);
        return false !== $user ? $user->current() : false;
    }
}