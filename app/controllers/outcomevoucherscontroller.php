<?php
namespace Lilly\Controllers;
use Lilly\Core\File\ImageHandler;
use Lilly\Core\Filter;
use Lilly\Core\Helper;
use Lilly\Core\Messenger;
use Lilly\Core\MVC\AbstractController;
use Lilly\Core\Validator;
use Lilly\Models\OutComeVoucherModel;
use Lilly\Models\SupplierInvoiceModel;
use Lilly\Models\SupplierInvoicePaymentVoucherModel;


class OutComeVouchersController extends AbstractController
{
    use Filter;
    use Validator;
    use Helper;

    public function defaultAction ()
    {
        $this->lang->load('outcomevouchers|default');
        $this->lang->load('outcomevouchers|label');
        $this->lang->load('common|template');

        $this->_data['vouchers'] = OutComeVoucherModel::getAll();

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

        $this->lang->load('outcomevouchers|add');
        $this->lang->load('outcomevouchers|label');
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
                if($voucher->invoiceCanAdd()) {
                    if($voucher->save()) {
                        $this->messenger->add(
                            'message',
                            $this->lang->get('outcomevouchers|common', 'add_success')
                        );
                        $this->routeTo('/paymentvoucher');
                    } else {
                        $this->messenger->add(
                            'message',
                            $this->lang->get('outcomevouchers|common', 'add_error'),
                            Messenger::STATUS_ERROR
                        );
                    }
                } else {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('outcomevouchers|common', 'over_payment'),
                        Messenger::STATUS_ERROR
                    );
                }
            }
        }

        $this->_render();
    }

    public function editAction ()
    {
        $id = $this->_getParam(0, 'int');
        $voucher = SupplierInvoicePaymentVoucherModel::getByPK($id);

        if(false === $voucher)
        {
            $this->routeTo('/paymentvoucher');
        }

        $this->_data['voucher'] = $voucher;

        $invoice = SupplierInvoiceModel::getByPK($voucher->invoiceId);

        $this->lang->load('outcomevouchers|add');
        $this->lang->load('outcomevouchers|label');
        $this->lang->load('common|template');

        $this->lang->feed('title', [$invoice->id]);
        $this->lang->feed('text_header', [$invoice->id]);
        $this->lang->feed('text_footer', [$invoice->id]);

        if(isset($_POST['submit'])) {
            if(true/*$this->isValidRequest()*/) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/paymentvoucher');
                }

                $oldPayment = $voucher->payment;
                $voucher->paymentNumber = isset($_POST['payment_number']) ? $this->filterString($_POST['payment_number']) : '';
                $voucher->payment = $this->filterInt($_POST['payment']);
                $voucher->paymentType = $this->filterInt($_POST['payment_type']);

                if($voucher->invoiceCanAdd($oldPayment)) {
                    if($voucher->save()) {
                        $this->messenger->add(
                            'message',
                            $this->lang->get('outcomevouchers|common', 'edit_success')
                        );
                        $this->routeTo('/paymentvoucher');
                    } else {
                        $this->messenger->add(
                            'message',
                            $this->lang->get('outcomevouchers|common', 'edit_error'),
                            Messenger::STATUS_ERROR
                        );
                    }
                } else {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('outcomevouchers|common', 'over_payment'),
                        Messenger::STATUS_ERROR
                    );
                }
            }
        }

        $this->_render();
    }

    public function deleteAction ()
    {
        $id = $this->_getParam(0, 'int');
        $voucher = SupplierInvoicePaymentVoucherModel::getByPK($id);

        if(false === $voucher)
        {
            $this->routeBack('/paymentvoucher');
        }

        if(!$this->requestHasValidToken($_POST['token']) && $voucher->delete()) {
            $this->messenger->add(
                'message',
                $this->lang->get('outcomevouchers|common', 'delete_success')
            );
            $this->routeBack('/paymentvoucher');
        } else {
            $this->messenger->add(
                'message',
                $this->lang->get('outcomevouchers|common', 'delete_error'),
                Messenger::STATUS_ERROR
            );
        }
    }

    public function attachCopyAction ()
    {
        $id = $this->_getParam(0, 'int');
        $voucher = SupplierInvoicePaymentVoucherModel::getByPK($id);

        if(false === $voucher)
        {
            $this->routeTo('/paymentvoucher');
        }

        $this->_data['voucher'] = $voucher;

        $invoice = SupplierInvoiceModel::getByPK($voucher->invoiceId);

        $this->lang->load('outcomevouchers|attachcopy');
        $this->lang->load('outcomevouchers|label');
        $this->lang->load('common|template');

        $this->lang->feed('title', [$invoice->id]);
        $this->lang->feed('text_header', [$invoice->id]);
        $this->lang->feed('text_footer', [$invoice->id]);

        if(isset($_POST['submit'])) {
            if(true/*$this->isValidRequest()*/) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/paymentvoucher');
                }

                if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                    $image = new ImageHandler($_FILES['image']);
                    if($voucher->file != '' && file_exists(IMAGE_STORAGE_FOLDER . $voucher->file)) {
                        unlink(IMAGE_STORAGE_FOLDER . $voucher->file);
                    }
                    $voucher->file = $image->getFileName();
                    $image->prepare(array())->saveIt();
                }

                if($voucher->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('outcomevouchers|common', 'attach_success')
                    );
                } else {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('outcomevouchers|common', 'attach_error'),
                        Messenger::STATUS_ERROR
                    );
                }
                $this->routeTo('/paymentvoucher');
            }
        }

        $this->_render();
    }
}