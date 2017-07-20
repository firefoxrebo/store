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
    public $supplierType;

    protected static $tableName = 'app_suppliers_invoices';

    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'supplierId' => self::DATA_TYPE_INT,
        'createdBy' => self::DATA_TYPE_INT,
        'created' => self::DATA_TYPE_DATE,
        'approved' => self::DATA_TYPE_INT,
        'approvedBy' => self::DATA_TYPE_INT,
        'paid' => self::DATA_TYPE_BOOL,
        'paymentType' => self::DATA_TYPE_INT,
        'supplierType' => self::DATA_TYPE_INT
    );

    public static function getAll()
    {
        $invoices = self::get(
            'SELECT asi.*,  
            (SELECT SUM(price * quantity) FROM app_suppliers_invoices_details WHERE invoiceId = asi.id) total,
            (SELECT COUNT(*) FROM app_suppliers_invoices_details WHERE invoiceId = asi.id) ptotal,
            IF(asi.supplierType = 1, (SELECT name FROM app_suppliers WHERE app_suppliers.id = asi.supplierId), (SELECT name FROM app_clients WHERE app_clients.id = asi.supplierId)) supplier
            FROM ' . self::$tableName . ' asi'
        );
        return $invoices;
    }
}
