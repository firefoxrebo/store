<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class SupplierInvoiceModel extends AbstractModel
{

    public $id;
    public $supplierId;
    public $createdBy;
    public $created;
    public $addedToStore;
    public $addedToStoreBy;
    public $paymentType;
    public $supplierType;

    protected static $tableName = 'app_suppliers_invoices';

    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'supplierId' => self::DATA_TYPE_INT,
        'createdBy' => self::DATA_TYPE_INT,
        'created' => self::DATA_TYPE_DATE,
        'addedToStore' => self::DATA_TYPE_INT,
        'addedToStoreBy' => self::DATA_TYPE_INT,
        'paymentType' => self::DATA_TYPE_INT,
        'supplierType' => self::DATA_TYPE_INT
    );

    public static function getAll()
    {
        $invoices = self::get(
            'SELECT asi.*,  
            (SELECT SUM(price * quantity) FROM app_suppliers_invoices_details WHERE invoiceId = asi.id) total,
            (SELECT COUNT(*) FROM app_suppliers_invoices_details WHERE invoiceId = asi.id) ptotal,
            (SELECT SUM(payment) FROM app_suppliers_invoices_payment_vouchers WHERE app_suppliers_invoices_payment_vouchers.invoiceid = asi.id) totalPaid,
            IF(asi.supplierType = 1, (SELECT name FROM app_suppliers WHERE app_suppliers.id = asi.supplierId), (SELECT name FROM app_clients WHERE app_clients.id = asi.supplierId)) supplier
            FROM ' . self::$tableName . ' asi'
        );
        return $invoices;
    }

    public function getInvoiceTotal()
    {
        return (int) self::get('SELECT SUM(price * quantity) total FROM app_suppliers_invoices_details WHERE invoiceId = ' . $this->id)->current()->total;
    }
}
