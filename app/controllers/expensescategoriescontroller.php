<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models as Models;
use Lilly\Core as Core;

class ExpensesCategoriesController extends AbstractController
{
    use Core\Validator;
    use Core\Filter;
    use Core\Helper;

    protected $dataSchema = [
        'name'              => 'required|alphanumeric|strbetween(3,50)'
    ];

    public function defaultAction()
    {
        $this->_data['categories'] = Models\ExpenseCategoryModel::getAll();
        $this->lang->load('common|template');
        $this->lang->load('expensescategories|default');
        $this->lang->load('expensescategories|label');

        $this->injectDataTable();
        $this->_render();
    }

    public function addAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('expensescategories|add');
        $this->lang->load('expensescategories|label');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/expensescategories');
                }
                $category = new Models\ExpenseCategoryModel();
                $category->name = $this->filterString($_POST['name']);
                $category->fixedPayment = $this->filterFloat($_POST['fixedPayment']);
                if($category->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('expensescategories|common', 'add_success')
                    );
                    $this->routeTo('/expensescategories');
                };
            }
        }

        $this->_render();
    }

    public function editAction()
    {
        $id = $this->_getParam(0, 'int');
        $category = Models\ExpenseCategoryModel::getByPK($id);
        if($category === false) {
            $this->routeTo('/expensescategories');
        }

        $this->_data['category'] = $category;

        $this->lang->load('common|template');
        $this->lang->load('expensescategories|edit');
        $this->lang->load('expensescategories|label');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/expensescategories');
                }
                $category->name = $this->filterString($_POST['name']);
                $category->fixedPayment = $this->filterFloat($_POST['fixedPayment']);
                if($category->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('expensescategories|common', 'edit_success')
                    );
                    $this->routeTo('/expensescategories');
                }
            }
        }

        $this->_render();
    }

    public function deleteAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/expensescategories');
        }
        $id = $this->_getParam(0, 'int');
        $category = Models\ExpenseCategoryModel::getByPK($id);
        if($category === false || $category->hasRelatedExpensesList() !== false) {
            $this->routeTo('/expensescategories');
        }
        if($category->delete()){
            $this->messenger->add(
                'message',
                $this->lang->get('expensescategories|common', 'delete_success')
            );
        } else {
            $this->messenger->add(
                'message',
                $this->lang->get('expensescategories|common', 'delete_error'),
                Core\Messenger::STATUS_ERROR
            );
        }
        $this->routeTo('/expensescategories');
    }
}
