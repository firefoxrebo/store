<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class SupplierModel extends AbstractModel
{

    public $id;

    public $name;

    public $city;

    public $mobile;

    public $address;

    public $email;

    public $subscribed;

    public $isClient;

    protected static $tableName = 'app_suppliers';

    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'name' => self::DATA_TYPE_STR,
        'city' => self::DATA_TYPE_STR,
        'mobile' => self::DATA_TYPE_STR,
        'address' => self::DATA_TYPE_STR,
        'email' => self::DATA_TYPE_STR,
        'subscribed' => self::DATA_TYPE_DATE,
        'isClient' => self::DATA_TYPE_BOOL
    );

    public function hasTransactions()
    {
        $transactions = self::query('SELECT * FROM app_money_in WHERE volunteerId = ' . $this->id,
            array(),
            '\LMS\Models\MoneyInModel'
        );
        return false !== $transactions ? true : false;
    }
}
