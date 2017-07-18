<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models as Models;
use Lilly\Core as Core;

class PurchasesController extends AbstractController
{
    use Core\Validator;
    use Core\Filter;
    use Core\Helper;

    protected $dataSchema = [
        'supplierId'        => 'required|num',
        'paymentType'       => 'required|num'
    ];

    public function defaultAction()
    {
        $this->_data['invoices'] = Models\SupplierInvoiceModel::getAll();
        $this->lang->load('common|template');
        $this->lang->load('purchases|default');
        $this->lang->load('purchases|label');

        $this->injectDataTable();
        $this->_render();
    }

    public function addAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('purchases|add');
        $this->lang->load('purchases|label');

        $this->_data['suppliers'] = Models\SupplierModel::getAll();
        $this->_data['products'] = Models\ProductModel::getAll();

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/purchases');
                }
                $invoice = new Models\SupplierInvoiceModel();
                $invoice->supplierId = $this->filterInt($_POST['supplierId']);
                $invoice->paymentType = $this->filterInt($_POST['paymentType']);
                $invoice->approved = 0;
                $invoice->createdBy = $this->session->u->id;
                $invoice->paid = 0;
                $invoice->created = date('Y-m-d H:i:s');

                $productsIds = $this->filterStringArray($_POST['productv']);
                $productsPrices = $this->filterStringArray($_POST['productp']);
                $productsQuantities = $this->filterStringArray($_POST['productq']);

                if($invoice->save()) {
                    for ( $i = 0, $ii = count($productsIds); $i < $ii; $i++ ) {
                        $details = new Models\SupplierInvoiceDetailsModel();
                        $details->invoiceId = $invoice->id;
                        $details->productId = $productsIds[$i];
                        $details->quantity = $productsQuantities[$i];
                        $details->price = $productsPrices[$i];
                        $details->save();
                    }
                    $this->messenger->add(
                        'message',
                        $this->lang->get('purchases|common', 'add_success')
                    );
                    $this->routeTo('/purchases');
                };
            }
        }

        $this->_render();
    }

    public function editAction()
    {
        $id = $this->_getParam(0, 'int');
        $invoice = Models\SupplierInvoiceModel::getByPK($id);
        if($invoice === false) {
            $this->routeTo('/purchases');
        }

        $this->_data['invoice'] = $invoice;
        $details = $this->_data['details'] = Models\SupplierInvoiceDetailsModel::getByInvoiceId($invoice);

        $this->lang->load('common|template');
        $this->lang->load('purchases|edit');
        $this->lang->load('purchases|label');

        $this->_data['suppliers'] = Models\SupplierModel::getAll();

        $products = Models\ProductModel::getAll();
        foreach ($products as &$product) {
            foreach ($details as $detail) {
                if($detail->productId == @$product->id) {
                    $product = false;
                }
            }
        }

        $productsIterator = iterator_to_array($products);
        $newProducts = [];
        foreach ($productsIterator as $item) {
            if(false !== $item) {
                $newProducts[] = $item;
            }
        }

        $products = $newProducts;
        $this->_data['products'] = $products;

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/purchases');
                }
                $invoice->supplierId = $this->filterInt($_POST['supplierId']);
                $invoice->paymentType = $this->filterInt($_POST['paymentType']);

                $productsIds = $this->filterStringArray($_POST['productv']);
                $productsPrices = $this->filterStringArray($_POST['productp']);
                $productsQuantities = $this->filterStringArray($_POST['productq']);

                if($invoice->save()) {

                    foreach ($details as $detail) {
                        $detail->delete();
                    }

                    for ( $i = 0, $ii = count($productsIds); $i < $ii; $i++ ) {
                        $details = new Models\SupplierInvoiceDetailsModel();
                        $details->invoiceId = $invoice->id;
                        $details->productId = $productsIds[$i];
                        $details->quantity = $productsQuantities[$i];
                        $details->price = $productsPrices[$i];
                        $details->save();
                    }

                    $this->messenger->add(
                        'message',
                        $this->lang->get('purchases|common', 'edit_success')
                    );
                    $this->routeTo('/purchases');
                }
            }
        }

        $this->_render();
    }

    public function deleteAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/purchases');
        }
        $id = $this->_getParam(0, 'int');
        $invoice = Models\SupplierInvoiceModel::getByPK($id);
        if($invoice === false) {
            $this->routeTo('/purchases');
        }
        $details = Models\SupplierInvoiceDetailsModel::getByInvoiceId($invoice);
        foreach ($details as $detail) {
            $detail->delete();
        }
        if($invoice->delete()){
            $this->messenger->add(
                'message',
                $this->lang->get('purchases|common', 'delete_success')
            );
        } else {
            $this->messenger->add(
                'message',
                $this->lang->get('purchases|common', 'delete_error'),
                Core\Messenger::STATUS_ERROR
            );
        }
        $this->routeTo('/purchases');
    }
}
