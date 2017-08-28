<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class ExpenseModel extends AbstractModel
{

    public $id;
    public $categoryId;
    public $description;
    public $payment;
    public $created;
    public $userId;

    protected static $tableName = 'app_expenses_transactions';

    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'categoryId'        => self::DATA_TYPE_INT,
        'description'       => self::DATA_TYPE_STR,
        'payment'           => self::DATA_TYPE_DECIMAL,
        'created'           => self::DATA_TYPE_DATE,
        'userId'            => self::DATA_TYPE_INT
    );

    public static function getAll()
    {
        return self::get(
            'SELECT aet.*, aec.name FROM ' . self::$tableName . ' aet ' .
            'LEFT JOIN app_expenses_categories aec ON aec.id = aet.categoryId'
        );
    }
}
