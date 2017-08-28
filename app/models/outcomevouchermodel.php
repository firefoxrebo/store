<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class OutComeVoucherModel extends AbstractModel
{

    public $id;
    public $expenseId;
    public $payment;
    public $issuedBy;
    public $issuedTo;
    public $description;
    public $file;
    public $created;

    protected static $tableName = 'app_outcome_vouchers';

    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'expenseId'         => self::DATA_TYPE_INT,
        'payment'           => self::DATA_TYPE_INT,
        'issuedBy'          => self::DATA_TYPE_INT,
        'issuedTo'          => self::DATA_TYPE_INT,
        'description'       => self::DATA_TYPE_STR,
        'file'              => self::DATA_TYPE_STR,
        'created'           => self::DATA_TYPE_DATE,
    );
}
