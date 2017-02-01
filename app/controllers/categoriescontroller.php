<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models as Models;
use Lilly\Core as Core;

class CategoriesController extends AbstractController
{
    use Core\Validator;
    use Core\Filter;
    use Core\Helper;

    protected $dataSchema = [
        'name'              => 'required|alphanumeric|strbetween(3,50)'
    ];

    public function defaultAction()
    {
        $this->_data['categories'] = Models\CategoryModel::getAll();
        $this->lang->load('common|template');
        $this->lang->load('categories|default');
        $this->lang->load('categories|label');

        $this->injectDataTable();
        $this->_render();
    }

    public function addAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('categories|add');
        $this->lang->load('categories|label');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/categories');
                }
                $category = new Models\CategoryModel();
                $category->name = $this->filterString($_POST['name']);
                $category->created = date('Y-m-d');
                if($category->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('categories|common', 'add_success')
                    );
                    $this->routeTo('/categories');
                };
            }
        }

        $this->_render();
    }

    public function editAction()
    {
        $id = $this->_getParam(0, 'int');
        $category = Models\CategoryModel::getByPK($id);
        if($category === false) {
            $this->routeTo('/categories');
        }

        $this->_data['category'] = $category;

        $this->lang->load('common|template');
        $this->lang->load('categories|edit');
        $this->lang->load('categories|label');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/categories');
                }
                $category->name = $this->filterString($_POST['name']);
                if($category->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('categories|common', 'edit_success')
                    );
                    $this->routeTo('/categories');
                }
            }
        }

        $this->_render();
    }

    public function deleteAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/categories');
        }
        $id = $this->_getParam(0, 'int');
        $category = Models\CategoryModel::getByPK($id);
        if($category === false) {
            $this->routeTo('/categories');
        }
//        if($client->hasTransactions()) {
//            $this->session->message = array($this->lang->get('categories|common', 'has_transactions'), APP_INFO);
//            $this->routeTo('/categories');
//        }
        if($category->delete()){
            $this->messenger->add(
                'message',
                $this->lang->get('categories|common', 'delete_success')
            );
        } else {
            $this->messenger->add(
                'message',
                $this->lang->get('categories|common', 'delete_error'),
                Core\Messenger::STATUS_ERROR
            );
        }
        $this->routeTo('/categories');
    }
}
