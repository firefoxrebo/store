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
        'supplierId'        => 'required|alphanumeric',
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

        $this->_data['suppliers'] = Models\SupplierModel::get(
            'SELECT id, name, 1 as type from app_suppliers UNION SELECT id, name, 2 as type from app_clients WHERE isSupplier = 1'
        );

        $this->_data['products'] = Models\ProductModel::getAll();

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/purchases');
                }
                $invoice = new Models\SupplierInvoiceModel();

                $suppliersData = json_decode($_POST['supplierId']);
                $invoice->supplierId = $this->filterInt($suppliersData->id);
                $invoice->supplierType = $this->filterInt($suppliersData->type);
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

        $this->_data['suppliers'] = Models\SupplierModel::get(
            'SELECT id, name, 1 as type from app_suppliers UNION SELECT id, name, 2 as type from app_clients WHERE isSupplier = 1'
        );

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

                $suppliersData = json_decode($_POST['supplierId']);
                $invoice->supplierId = $this->filterInt($suppliersData->id);
                $invoice->supplierType = $this->filterInt($suppliersData->type);
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

    public function viewAction()
    {
        $id = $this->_getParam(0, 'int');

        $invoice = Models\SupplierInvoiceModel::getOne(
            'SELECT *, IF(supplierType = 1, (SELECT name FROM app_suppliers WHERE app_suppliers.id = app_suppliers_invoices.supplierId), (SELECT name FROM app_clients WHERE app_clients.id = app_suppliers_invoices.supplierId)) supplier 
                  FROM app_suppliers_invoices
                  WHERE id = ' . $id
        );

        if($invoice === false) {
            $this->routeTo('/purchases');
        }

        $this->_data['invoice'] = $invoice;
        $this->_data['details'] = Models\SupplierInvoiceDetailsModel::getByInvoiceId($invoice);

        $this->lang->load('common|template');
        $this->lang->load('purchases|view');
        $this->lang->load('purchases|label');


        $this->_render();
    }
}
