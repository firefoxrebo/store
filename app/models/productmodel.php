<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class ProductModel extends AbstractModel
{

    public $id;
    public $categoryId;
    public $name;
    public $unit;
    public $price;
    public $created;

    protected static $tableName = 'app_products';

    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'categoryId' => self::DATA_TYPE_INT,
        'name' => self::DATA_TYPE_STR,
        'unit' => self::DATA_TYPE_INT,
        'price' => self::DATA_TYPE_STR,
        'created' => self::DATA_TYPE_DATE
    );

    public function hasRelatedTransactions()
    {

    }
}
