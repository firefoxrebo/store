<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class ExpenseCategoryModel extends AbstractModel
{

    public $id;
    public $name;
    public $fixedPayment;

    protected static $tableName = 'app_expenses_categories';

    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'name'              => self::DATA_TYPE_STR,
        'fixedPayment'      => self::DATA_TYPE_DECIMAL,
    );

    public function hasRelatedExpensesList ()
    {
        return self::get('SELECT * FROM app_expenses_transactions WHERE categoryId = ' . $this->id);
    }
}
