<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models as Models;
use Lilly\Core as Core;

class ProductsController extends AbstractController
{
    use Core\Validator;
    use Core\Filter;
    use Core\Helper;

    protected $dataSchema = [
        'name'  => 'required|alphanumeric|strbetween(3,50)',
        'categoryId'  => 'required|num',
        'unit'  => 'required|alpha',
        'price'  => 'required|float'
    ];

    public function defaultAction()
    {
        $this->_data['products'] = Models\ProductModel::getAll();
        $this->lang->load('common|template');
        $this->lang->load('products|default');
        $this->lang->load('products|label');

        $this->injectDataTable();
        $this->_render();
    }

    public function addAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('products|add');
        $this->lang->load('products|label');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/products');
                }
                $product = new Models\ProductModel();
                $product->name = $this->filterString($_POST['name']);
                $product->categoryId = $this->filterInt($_POST['categoryId']);
                $product->price = $this->filterFloat($_POST['price']);
                $product->unit = $this->filterInt($_POST['unit']);
                $product->created = date('Y-m-d');
                if($product->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('products|common', 'add_success')
                    );
                    $this->routeTo('/products');
                };
            }
        }

        $this->_render();
    }

    public function editAction()
    {
        $id = $this->_getParam(0, 'int');
        $product = Models\ProductModel::getByPK($id);
        if($product === false) {
            $this->routeTo('/products');
        }

        $this->_data['product'] = $product;

        $this->lang->load('common|template');
        $this->lang->load('products|edit');
        $this->lang->load('products|label');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/products');
                }
                $product->name = $this->filterString($_POST['name']);
                $product->price = $this->filterFloat($_POST['price']);
                $product->unit = $this->filterInt($_POST['unit']);
                $product->created = date('Y-m-d');
                if($product->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('products|common', 'edit_success')
                    );
                    $this->routeTo('/products');
                }
            }
        }

        $this->_render();
    }

    public function deleteAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/products');
        }
        $id = $this->_getParam(0, 'int');
        $product = Models\ProductModel::getByPK($id);
        if($product === false) {
            $this->routeTo('/products');
        }
//        if($client->hasTransactions()) {
//            $this->session->message = array($this->lang->get('products|common', 'has_transactions'), APP_INFO);
//            $this->routeTo('/products');
//        }
        if($product->delete()){
            $this->messenger->add(
                'message',
                $this->lang->get('products|common', 'delete_success')
            );
        } else {
            $this->messenger->add(
                'message',
                $this->lang->get('products|common', 'delete_error'),
                Core\Messenger::STATUS_ERROR
            );
        }
        $this->routeTo('/products');
    }
}
