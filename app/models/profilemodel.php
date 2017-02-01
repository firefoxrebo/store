<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class ProfileModel extends AbstractModel
{
    
    public $id;
    public $userid;
    public $email;
    public $firstname;
    public $lastname;
    public $dob;
    public $address;
    public $phone;
    public $image;
    
    public static $tableName = 'app_users_profile';
    
    protected static $tableSchema = array(
        'userid' => self::DATA_TYPE_INT,
        'email' => self::DATA_TYPE_STR,
        'firstname' => self::DATA_TYPE_STR,
        'lastname' => self::DATA_TYPE_STR,
        'dob' => self::DATA_TYPE_DATE,
        'address' => self::DATA_TYPE_STR,
        'phone' => self::DATA_TYPE_STR,
        'image' => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'id';

    /**
     * @param $empId
     *
     * @return ProfileModel $profile
     */
    public static function loadProfile($empId)
    {
        return self::getOne('SELECT * FROM ' . self::$tableName . ' WHERE userid = ' . $empId);
    }
}