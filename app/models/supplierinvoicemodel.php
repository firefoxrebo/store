<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class SupplierInvoiceModel extends AbstractModel
{

    public $id;
    public $supplierId;
    public $createdBy;
    public $created;
    public $approved;
    public $approvedBy;
    public $paid;
    public $paymentType;

    protected static $tableName = 'app_suppliers_invoices';

    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'supplierId' => self::DATA_TYPE_INT,
        'createdBy' => self::DATA_TYPE_INT,
        'created' => self::DATA_TYPE_DATE,
        'approved' => self::DATA_TYPE_INT,
        'approvedBy' => self::DATA_TYPE_INT,
        'paid' => self::DATA_TYPE_BOOL,
        'paymentType' => self::DATA_TYPE_INT
    );

    public static function getAll()
    {
        $invoices = self::get(
            'SELECT asi.*, `as`.name supplier FROM ' . self::$tableName . ' asi INNER JOIN 
            app_suppliers `as` ON `as`.id = asi.supplierId'
        );
        return $invoices;
    }
}
