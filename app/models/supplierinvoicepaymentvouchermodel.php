<?php
namespace Lilly\Models;
use Lilly\Core\MVC\AbstractModel;

class SupplierInvoicePaymentVoucherModel extends AbstractModel
{

    public $id;
    public $invoiceId;
    public $paymentNumber;
    public $payment;
    public $paymentType;
    public $userId;
    public $created;
    public $file;

    protected static $tableName = 'app_suppliers_invoices_payment_vouchers';

    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'id'                => self::DATA_TYPE_INT,
        'invoiceId'         => self::DATA_TYPE_INT,
        'paymentNumber'     => self::DATA_TYPE_STR,
        'payment'           => self::DATA_TYPE_INT,
        'paymentType'       => self::DATA_TYPE_STR,
        'userId'            => self::DATA_TYPE_INT,
        'created'           => self::DATA_TYPE_STR,
        'file'              => self::DATA_TYPE_STR
    );

    public function invoiceCanAdd($oldPayment = 0)
    {
        $previousPayments = self::get(
            "
            SELECT IFNULL(SUM(payment),0) previousPayments, 
            (SELECT SUM(price * quantity) FROM app_suppliers_invoices_details WHERE app_suppliers_invoices_details.invoiceId = {$this->invoiceId}) invoiceTotal
             FROM " . self::$tableName . " WHERE invoiceId = {$this->invoiceId} Having invoiceTotal >= (previousPayments - {$oldPayment} + {$this->payment})"
        );
        return $previousPayments === false ? false : true;
    }

    public static function invoiceIsSettled(SupplierInvoiceModel $invoiceModel)
    {
        $invoiceTotal = $invoiceModel->getInvoiceTotal();
        $totalPayments = self::get('
            SELECT SUM(payment) totalPayments FROM ' . self::$tableName . ' WHERE invoiceId = ' . $invoiceModel->id . '
        ');
        return (int) $totalPayments->current()->totalPayments === $invoiceTotal;
    }

    public static function getAll()
    {
        return self::get(
        'SELECT *, (SELECT created FROM app_suppliers_invoices WHERE app_suppliers_invoices.id = ' . self::$tableName . '.invoiceId) icreated, getSupplierName(' . self::$tableName . '.invoiceId) supplier 
              FROM ' . self::$tableName
        );
    }

    public static function getForInvoice(SupplierInvoiceModel $invoice)
    {
        return self::get(
            'SELECT *, (SELECT created FROM app_suppliers_invoices WHERE app_suppliers_invoices.id = ' . self::$tableName . '.invoiceId) icreated, getSupplierName(' . self::$tableName . '.invoiceId) supplier 
              FROM ' . self::$tableName . ' WHERE invoiceId = ' . $invoice->id
        );
    }
}
