<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class SupplierInvoiceDetailsModel extends AbstractModel
{

    public $id;
    public $invoiceId;
    public $productId;
    public $quantity;
    public $price;

    protected static $tableName = 'app_suppliers_invoices_details';

    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'invoiceId' => self::DATA_TYPE_INT,
        'productId' => self::DATA_TYPE_INT,
        'quantity' => self::DATA_TYPE_INT,
        'price' => self::DATA_TYPE_STR
    );

    public static function getByInvoiceId(SupplierInvoiceModel $invoice)
    {
        $details = self::get(
            'SELECT *, 
            (SELECT name FROM app_products WHERE app_products.id = productId) name  
            FROM ' . self::$tableName . ' WHERE invoiceId = ' . $invoice->id
        );
        return $details;
    }
}
