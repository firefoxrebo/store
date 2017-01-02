<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class MailModel extends AbstractModel
{

    public $id;
    public $senderId;
    public $receiverId;
    public $created;
    public $title;
    public $content;
    public $seen;

    protected static $tableName = 'app_mail';

    protected static $tableSchema = array(
        'senderId'      => self::DATA_TYPE_INT,
        'receiverId'    => self::DATA_TYPE_INT,
        'created'       => self::DATA_TYPE_DATE,
        'title'         => self::DATA_TYPE_STR,
        'content'       => self::DATA_TYPE_STR,
        'seen'          => self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'id';
}