<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models as Models;
use Lilly\Core as Core;

class ClientsController extends AbstractController
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
        $this->_data['clients'] = Models\ClientModel::getAll();
        $this->lang->load('common|template');
        $this->lang->load('clients|common');
        $this->lang->load('clients|default');
        $this->lang->load('clients|label');

        $this->injectDataTable();
        $this->_render();
    }

    public function addAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('clients|add');
        $this->lang->load('clients|label');

        $this->_data['cities'] = $this->lang->get('clients|cities');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/clients');
                }
                $client = new Models\ClientModel();
                $client->name = $this->filterString($_POST['name']);
                $client->city = $this->filterInt($_POST['city']);
                $client->mobile = $this->filterString($_POST['mobile']);
                $client->subscribed = $_POST['subscribed'];
                $client->email = $this->filterEmail($_POST['email']);
                $client->address = $this->filterString($_POST['address']);
                $client->isSupplier = (isset($_POST['isSupplier'])) ? 1 : 0;
                if($client->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('clients|common', 'add_success')
                    );
                    $this->routeTo('/clients');
                };
            }
        }

        $this->_render();
    }

    public function editAction()
    {
        $id = $this->_getParam(0, 'int');
        $client = Models\ClientModel::getByPK($id);
        if($client === false) {
            $this->routeTo('/clients');
        }

        $this->_data['cities'] = $this->lang->get('clients|cities');

        $this->_data['client'] = $client;

        $this->lang->load('common|template');
        $this->lang->load('clients|edit');
        $this->lang->load('clients|label');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/clients');
                }
                $client->name = $this->filterString($_POST['name']);
                $client->city = $this->filterInt($_POST['city']);
                $client->mobile = $this->filterString($_POST['mobile']);
                $client->subscribed = $_POST['subscribed'];
                $client->email = $this->filterEmail($_POST['email']);
                $client->address = $this->filterString($_POST['address']);
                $client->isSupplier = (isset($_POST['isSupplier'])) ? 1 : 0;
                if($client->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('clients|common', 'edit_success')
                    );
                    $this->routeTo('/clients');
                }
            }
        }

        $this->_render();
    }

    public function deleteAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/clients');
        }
        $id = $this->_getParam(0, 'int');
        $client = Models\ClientModel::getByPK($id);
        if($client === false) {
            $this->routeTo('/clients');
        }
//        if($client->hasTransactions()) {
//            $this->session->message = array($this->lang->get('clients|common', 'has_transactions'), APP_INFO);
//            $this->routeTo('/clients');
//        }
        if($client->delete()){
            $this->messenger->add(
                'message',
                $this->lang->get('clients|common', 'delete_success')
            );
        } else {
            $this->messenger->add(
                'message',
                $this->lang->get('clients|common', 'delete_error'),
                Core\Messenger::STATUS_ERROR
            );
        }
        $this->routeTo('/clients');
    }

    public function viewAction()
    {
        $id = $this->_getParam(0, 'int');
        $client = Models\ClientModel::getByPK($id);
        if($client === false) {
            $this->routeTo('/clients');
        }

        $this->_data['cities'] = $this->lang->get('clients|cities');

        $this->_data['client'] = $client;

        $this->lang->load('common|template');
        $this->lang->load('clients|view');
        $this->lang->load('clients|label');

        $this->_render();
    }
}
