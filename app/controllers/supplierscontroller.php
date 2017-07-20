<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models as Models;
use Lilly\Core as Core;

class SuppliersController extends AbstractController
{
    use Core\Validator;
    use Core\Filter;
    use Core\Helper;

    protected $dataSchema = [
        'name'              => 'required|alphanumeric|strbetween(3,50)',
        'city'              => 'required|alphanumeric',
        'mobile'            => 'required|num|intbetween(10,15)',
        'email'             => 'email|strbetween(6,50)',
        'address'           => 'required|alphanumeric|strbetween(5,100)',
        'subscribed'        => 'required|date',
    ];

    public function defaultAction()
    {
        $this->_data['clients'] = Models\SupplierModel::getAll();
        $this->lang->load('common|template');
        $this->lang->load('suppliers|common');
        $this->lang->load('suppliers|default');
        $this->lang->load('suppliers|label');

        $this->injectDataTable();
        $this->_render();
    }

    public function addAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('suppliers|add');
        $this->lang->load('suppliers|label');

        $this->_data['cities'] = $this->lang->get('suppliers|cities');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/suppliers');
                }
                $supplier = new Models\SupplierModel();
                $supplier->name = $this->filterString($_POST['name']);
                $supplier->city = $this->filterInt($_POST['city']);
                $supplier->mobile = $this->filterString($_POST['mobile']);
                $supplier->subscribed = $_POST['subscribed'];
                $supplier->email = $this->filterEmail($_POST['email']);
                $supplier->address = $this->filterString($_POST['address']);
                $supplier->isClient = (isset($_POST['isClient'])) ? 1 : 0;
                if($supplier->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('suppliers|common', 'add_success')
                    );
                    $this->routeTo('/suppliers');
                };
            }
        }

        $this->_render();
    }

    public function editAction()
    {
        $id = $this->_getParam(0, 'int');
        $supplier = Models\SupplierModel::getByPK($id);
        if($supplier === false) {
            $this->routeTo('/suppliers');
        }

        $this->_data['cities'] = $this->lang->get('suppliers|cities');

        $this->_data['client'] = $supplier;

        $this->lang->load('common|template');
        $this->lang->load('suppliers|edit');
        $this->lang->load('suppliers|label');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/suppliers');
                }
                $supplier->name = $this->filterString($_POST['name']);
                $supplier->city = $this->filterInt($_POST['city']);
                $supplier->mobile = $this->filterString($_POST['mobile']);
                $supplier->subscribed = $_POST['subscribed'];
                $supplier->email = $this->filterEmail($_POST['email']);
                $supplier->address = $this->filterString($_POST['address']);
                $supplier->isClient = (isset($_POST['isClient'])) ? 1 : 0;
                if($supplier->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('suppliers|common', 'edit_success')
                    );
                    $this->routeTo('/suppliers');
                }
            }
        }

        $this->_render();
    }

    public function deleteAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/suppliers');
        }
        $id = $this->_getParam(0, 'int');
        $supplier = Models\SupplierModel::getByPK($id);
        if($supplier === false) {
            $this->routeTo('/suppliers');
        }

        if($supplier->delete()){
            $this->messenger->add(
                'message',
                $this->lang->get('suppliers|common', 'delete_success')
            );
        } else {
            $this->messenger->add(
                'message',
                $this->lang->get('suppliers|common', 'delete_error'),
                Core\Messenger::STATUS_ERROR
            );
        }
        $this->routeTo('/suppliers');
    }

    public function viewAction()
    {
        $id = $this->_getParam(0, 'int');
        $supplier = Models\SupplierModel::getByPK($id);
        if($supplier === false) {
            $this->routeTo('/suppliers');
        }

        $this->_data['cities'] = $this->lang->get('suppliers|cities');

        $this->_data['client'] = $supplier;

        $this->lang->load('common|template');
        $this->lang->load('suppliers|view');
        $this->lang->load('suppliers|label');

        $this->_render();
    }
}
