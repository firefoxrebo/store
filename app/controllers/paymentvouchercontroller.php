<?php
namespace Lilly\Controllers;
use Lilly\Core\Filter;
use Lilly\Core\Helper;
use Lilly\Core\MVC\AbstractController;
use Lilly\Core\MVC\AbstractModel;
use Lilly\Core\Validator;
use Lilly\Models\SupplierInvoiceModel;
use Lilly\Models\SupplierInvoicePaymentVoucherModel;


class PaymentVoucherController extends AbstractController
{
    use Filter;
    use Validator;
    use Helper;

    public function defaultAction ()
    {
        $this->lang->load('paymentvoucher|default');
        $this->lang->load('paymentvoucher|label');
        $this->lang->load('common|template');

        $id = $this->_getParam(0, 'int');
        $invoice = SupplierInvoiceModel::getByPK($id);
        if(false !== $id && false !== $invoice) {
            $this->_data['vouchers'] = SupplierInvoicePaymentVoucherModel::getForInvoice($invoice);
        } else {
            $this->_data['vouchers'] = SupplierInvoicePaymentVoucherModel::getAll();
        }

        $this->injectDataTable();
        $this->_render();
    }

    public function addAction ()
    {
        $id = $this->_getParam(0, 'int');
        $invoice = SupplierInvoiceModel::getByPK($id);

        if(false === $invoice)
        {
            $this->routeTo('/paymentvoucher');
        }

        if(SupplierInvoicePaymentVoucherModel::invoiceIsSettled($invoice)) {
            $this->routeTo('/purchases');
        }

        $this->lang->load('paymentvoucher|add');
        $this->lang->load('paymentvoucher|label');
        $this->lang->load('common|template');

        $this->lang->feed('title', [$invoice->id]);
        $this->lang->feed('text_header', [$invoice->id]);
        $this->lang->feed('text_footer', [$invoice->id]);

        if(isset($_POST['submit'])) {
            if(true/*$this->isValidRequest()*/) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/paymentvoucher');
                }

                $voucher = new SupplierInvoicePaymentVoucherModel();
                $voucher->userId = $this->session->u->id;
                $voucher->invoiceId = $invoice->id;
                $voucher->paymentNumber = isset($_POST['payment_number']) ? $this->filterString($_POST['payment_number']) : '';
                $voucher->payment = $this->filterInt($_POST['payment']);
                $voucher->paymentType = $this->filterInt($_POST['payment_type']);
                $voucher->created = date('Y-m-d H:i:s');
                $voucher->invoiceCanAdd();
                if($voucher->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('paymentvoucher|common', 'add_success')
                    );
                    $this->routeTo('/paymentvoucher');
                };
            }
        }

        $this->_render();
    }
}