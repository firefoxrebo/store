<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class CategoryModel extends AbstractModel
{

    public $id;

    public $name;

    public $created;

    protected static $tableName = 'app_products_categories';

    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'name' => self::DATA_TYPE_STR,
        'created' => self::DATA_TYPE_DATE
    );

    public function hasRelatedProducts()
    {
        $transactions = self::query('SELECT * FROM app_money_in WHERE volunteerId = ' . $this->id,
            array(),
            '\LMS\Models\MoneyInModel'
        );
        return false !== $transactions ? true : false;
    }
}
