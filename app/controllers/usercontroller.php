<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models as Models;
use Lilly\Core as Core;

class UserController extends AbstractController
{
    use Core\Validator;
    use Core\Filter;
    use Core\Helper;

    private $_errors = array();

    protected $dataSchema = [
        'ucname'          => 'required|alphanumeric|strbetween(3,30)',
        'ucpwd'           => 'required|alphanumeric|gte(6)|equals(ucpwdc)',
        'firstName'       => 'required|alpha|strbetween(3,30)',
        'email'           => 'required|email|strbetween(6,30)',
        'joined'          => 'required|date',
    ];

    protected $editDataSchema = [
        'firstName'       => 'required|alpha|strbetween(3,30)',
        'status'          => 'required|num',
    ];

    public function defaultAction()
    {
        $this->_data['users'] = Models\UserModel::listUsers($this->session->u->id);
        $this->lang->load('common|template');
        $this->lang->load('user|default');
        $this->injectDataTable();
        $this->_render();
    }

    public function addAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('user|add');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/user');
                }
                $error = false;
                if(Models\UserModel::isEmailExists($this->filterEmail($_POST['email']))) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('user|common', 'email_already_exists'),
                        Core\Messenger::STATUS_ERROR
                    );
                    $error = true;
                }

                if(Models\UserModel::isEmpExists($this->filterEmail($_POST['ucname']))) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('user|common', 'username_already_exists'),
                        Core\Messenger::STATUS_ERROR
                    );
                    $error = true;
                }
                $user = new Models\UserModel;
                $user->ucname = $this->filterString($_POST['ucname']);
                $user->cryptPwd($_POST['ucpwd']);
                $user->joined = $this->filterString($_POST['joined']);
                $user->privilege = $this->filterInt($_POST['privilege']);
                $user->status = 1;
                if($error !== true) {
                    if($user->save()) {
                        $userProfile = new Models\ProfileModel;
                        $userProfile->userid = $user->id;
                        $userProfile->firstname = $this->filterString($_POST['firstName']);
                        $userProfile->email = $this->filterEmail($_POST['email']);
                        $userProfile->lastname = $this->filterString($_POST['lastName']);
                        $userProfile->dob = $this->filterString($_POST['dob']);
                        $userProfile->address = $this->filterString($_POST['address']);
                        $userProfile->phone = $this->filterString($_POST['phone']);
                        $userProfile->save();
                        $this->messenger->add(
                            'message',
                            $this->lang->get('user|common', 'user_add_success')
                        );
                        $this->routeTo('/user');
                    }
                }
            }
        }

        if(!empty($this->_errors)) {
            $this->extractErrors($this->_errors);
        }

        $this->_render();
    }

    public function editAction()
    {
        $id = $this->_getParam(0, 'int');
        $emp = Models\UserModel::getByPK($id);
        if($emp === false) {
            $this->routeTo('/user');
        }

        $this->_data['emp'] = $emp;
        $this->_data['profile'] = $profile = Models\ProfileModel::getByPK($emp->id);

        $this->lang->load('common|template');
        $this->lang->load('user|add');
        $this->lang->load('user|edit');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest($this->editDataSchema)) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/user');
                }
                $emp->privilege = $this->filterInt($_POST['privilege']);
                $emp->status = $this->filterInt($_POST['status']);
                if($emp->save()) {
                    $profile->firstname = $this->filterString($_POST['firstName']);
                    $profile->lastname = $this->filterString($_POST['lastName']);
                    $profile->dob = $this->filterString($_POST['dob']);
                    $profile->address = $this->filterString($_POST['address']);
                    $profile->phone = $this->filterString($_POST['phone']);
                    $profile->save();
                    $this->messenger->add(
                        'message',
                        $this->lang->get('user|common', 'user_edit_success')
                    );
                    $this->routeTo('/user');
                }
            }
        }

        $this->_render();
    }

    public function deleteAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/user');
        }
        $id = $this->_getParam(0, 'int');
        $emp = Models\UserModel::getByPK($id);
        if($emp === false || $emp->id === $this->session->u->id) {
            $this->routeTo('/user');
        }
        $profile = Models\ProfileModel::getByPK($emp->id);
        if($profile->delete() && $emp->delete()) {
            $this->messenger->add(
                'message',
                $this->lang->get('user|common', 'user_delete_success')
            );
            $this->routeTo('/user');
        }
    }

    public function viewAction()
    {
        $id = $this->_getParam(0, 'int');
        $employee = Models\ProfileModel::getByPK($id);

        $this->lang->load('common|template');
        $this->lang->load('user|profile');

        $this->_data['employee'] = $employee;

        $this->_render();
    }

    public function resetPasswordAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/user');
        }
        $id = $this->_getParam(0, 'int');
        $employee = Models\UserModel::getByPK($id);

        if($employee === false || $employee->id === $this->session->u->id) {
            $this->routeTo('/user');
        }

        $employee->cryptPwd('123456789');
        if($employee->save()) {
            $this->messenger->add(
                'message',
                $this->lang->get('user|common', 'password_reset_success')
            );
            $this->routeTo(($this->session->u->privilege == Core\ACL\Role::SCHOOL_MANAGER_ROLE) ? '/user/defaultschool' : '/user');
        }
    }

    public function passwordAction()
    {

        $employee = Models\UserModel::getByPK($this->session->u->id);

        $this->lang->load('common|template');
        $this->lang->load('user|password');

        if(isset($_POST['submit'])) {
            if($this->filterString($_POST['ucpwd']) === $this->filterString($_POST['ucpwdc'])) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/');
                }
                $employee->cryptPwd($_POST['ucpwd']);
                if($employee->save()) {
                    $this->messenger->add(
                        'message',
                        $this->lang->get('user|common', 'password_changed_success')
                    );
                    $this->routeTo('/');
                }
            } else {
                $this->messenger->add(
                    'message',
                    $this->lang->get('user|common', 'error_ucpwd'),
                    Core\Messenger::STATUS_ERROR
                );
            }
        }

        $this->_render();
    }

    public function profileAction()
    {
        $empId = $this->session->u->id;
        $employee = $this->session->u->getProfile();

        $this->lang->load('common|template');
        $this->lang->load('user|profile');

        $this->_data['employee'] = $employee;

        if(isset($_POST['submit'])) {
            if(!$this->requestHasValidToken($_POST['token'])) {
                $this->routeTo('/user');
            }
            $employee->firstname = $this->filterString($_POST['firstName']);
            $employee->lastname = $this->filterString($_POST['lastName']);
            if ($_POST['dob'] != '') $employee->dob = $_POST['dob'];
            $employee->email = $this->filterEmail($_POST['email']);
            $employee->address = $this->filterString($_POST['address']);
            $employee->phone = $this->filterString($_POST['phone']);
            if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $profileImage = new Core\File\ImageHandler($_FILES['image']);
                if($employee->image != '' && file_exists(IMAGE_STORAGE_FOLDER . $employee->image)) {
                    unlink(IMAGE_STORAGE_FOLDER . $employee->image);
                }
                $employee->image = $profileImage->getFileName();
                $profileImage->prepare(
                    array(
                        'width' => 100,
                        'height' => 100
                    )
                )->saveIt();
            }
            if($employee->save()) {
                $this->messenger->add(
                    'message',
                    $this->lang->get('user|common', 'profile_edit_success')
                );
                $this->routeTo('/');
            }
        }

        $this->_render();
    }
}