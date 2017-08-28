<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models as Models;
use Lilly\Core as Core;

class ExpenseslistController extends AbstractController
{
    use Core\Validator;
    use Core\Filter;
    use Core\Helper;

    protected $dataSchema = [

    ];

    public function defaultAction()
    {
        $this->_data['list'] = Models\ExpenseModel::getAll();

        $this->lang->load('common|template');
        $this->lang->load('expenseslist|default');
        $this->lang->load('expenseslist|label');

        $this->injectDataTable();
        $this->_render();
    }

    public function addAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('expenseslist|add');
        $this->lang->load('expenseslist|label');

        $this->_data['categories'] = Models\ExpenseCategoryModel::getAll();

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/expenseslist');
                }
                $expense = new Models\ExpenseModel();
                $expense->categoryId = isset($_POST['categoryId']) && !empty($_POST['categoryId']) ? $this->filterInt($_POST['categoryId']) : null;
                if($expense->categoryId !== null) $category = Models\ExpenseCategoryModel::getByPK($expense->categoryId);
                if(isset($category) && false === $category) {
                    $this->routeTo('/expenseslist');
                }
                $expense->description = $this->filterString($_POST['description']);
                $expense->payment = isset($category) ? $category->fixedPayment : $this->filterInt($_POST['payment']);
                $expense->userId = $this->session->u->id;
                $expense->created = date('Y-m-d H:i:s');
                if($expense->save()) {
                    $outComeVoucher = new Models\OutComeVoucherModel();
                    $outComeVoucher->expenseId = $expense->id;
                    $outComeVoucher->issuedBy = $this->session->u->id;
                    $outComeVoucher->payment = $expense->payment;
                    $outComeVoucher->description = $expense->description;
                    $outComeVoucher->created = $expense->created;
                    $outComeVoucher->save();
                    $this->messenger->add(
                        'message',
                        $this->lang->get('expenseslist|common', 'add_success')
                    );
                    $this->routeTo('/expenseslist');
                };
            }
        }

        $this->_render();
    }

    public function editAction()
    {
        $id = $this->_getParam(0, 'int');
        $expense = Models\ExpenseModel::getByPK($id);
        if($expense === false) {
            $this->routeTo('/expenseslist');
        }

        $this->_data['expense'] = $expense;

        $this->lang->load('common|template');
        $this->lang->load('expenseslist|edit');
        $this->lang->load('expenseslist|label');

        $this->_data['categories'] = Models\ExpenseCategoryModel::getAll();

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/expenseslist');
                }
                $expense->categoryId = isset($_POST['categoryId']) && !empty($_POST['categoryId']) ? $this->filterInt($_POST['categoryId']) : null;
                if($expense->categoryId !== null) $category = Models\ExpenseCategoryModel::getByPK($expense->categoryId);
                if(isset($category) && false === $category) {
                    $this->routeTo('/expenseslist');
                }
                $expense->description = $this->filterString($_POST['description']);
                $expense->payment = isset($category) ? $category->fixedPayment : $this->filterInt($_POST['payment']);
                $expense->userId = $this->session->u->id;
                $expense->created = date('Y-m-d H:i:s');
                if($expense->save()) {
                    $outComeVoucher = Models\OutComeVoucherModel::getBy('expenseId', $expense->id, Models\OutComeVoucherModel::DATA_TYPE_INT)->current();
                    $outComeVoucher->payment = $expense->payment;
                    $outComeVoucher->description = $expense->description;
                    $outComeVoucher->save();
                    $this->messenger->add(
                        'message',
                        $this->lang->get('expenseslist|common', 'edit_success')
                    );
                    $this->routeTo('/expenseslist');
                }
            }
        }

        $this->_render();
    }

    public function deleteAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/expenseslist');
        }
        $id = $this->_getParam(0, 'int');
        $expense = Models\ExpenseModel::getByPK($id);
        if($expense === false) {
            $this->routeBack('/expenseslist');
        }
        $voucher = Models\OutComeVoucherModel::getBy('expenseId', $expense->id, Models\OutComeVoucherModel::DATA_TYPE_INT)->current();
        if($voucher->delete() && $expense->delete()){
            $this->messenger->add(
                'message',
                $this->lang->get('expenseslist|common', 'delete_success')
            );
        } else {
            $this->messenger->add(
                'message',
                $this->lang->get('expenseslist|common', 'delete_error'),
                Core\Messenger::STATUS_ERROR
            );
        }
        $this->routeBack('/expenseslist');
    }
}
