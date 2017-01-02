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
        'email'           => 'required|email|strbetween(6,30)',
        'status'          => 'required|num',
    ];

    protected $editTeacherDataSchema = [
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

    public function defaultSchoolAction()
    {
        $this->_data['users'] = Models\UserModel::get(
            'SELECT * FROM app_users WHERE id != ' . $this->session->u->id . ' AND schoolId = ' . $this->session->u->schoolId
        );
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
                $user = new Models\UserModel;
                $user->ucname = $this->filterString($_POST['ucname']);
                $user->cryptPwd($_POST['ucpwd']);
                $user->joined = $_POST['joined'];
                $user->privilege = 1;
                $user->status = 1;
                if($user->save()) {
                    $userProfile = new Models\ProfileModel;
                    $userProfile->userid = $user->id;
                    $userProfile->firstname = $this->filterString($_POST['firstName']);
                    $userProfile->email = $this->filterEmail($_POST['email']);
                    $userProfile->save();
                    $this->messenger->add(
                        'message',
                        $this->lang->get('user|common', 'user_add_success')
                    );
                    $this->routeTo('/user');
                }
            }
        }
        
        if(!empty($this->_errors)) {
            $this->extractErrors($this->_errors);
        }
        
        $this->_render();
    }

    public function addSuperVisorAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('user|add');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/user/defaultschool');
                }
                $user = new Models\SupervisorModel();
                $user->ucname = $this->filterString($_POST['ucname']);
                $user->cryptPwd($_POST['ucpwd']);
                $user->joined = $_POST['joined'];
                $user->privilege = 3;
                $user->schoolId = $this->session->u->schoolId;
                $user->status = 1;
                if($user->save()) {
                    $userProfile = new Models\ProfileModel;
                    $userProfile->userid = $user->id;
                    $userProfile->firstname = $this->filterString($_POST['firstName']);
                    $userProfile->email = $this->filterEmail($_POST['email']);
                    $userProfile->save();
                    $this->messenger->add(
                        'message',
                        $this->lang->get('user|common', 'user_add_success')
                    );
                    $this->routeTo('/user/defaultschool');
                }
            }
        }

        if(!empty($this->_errors)) {
            $this->extractErrors($this->_errors);
        }

        $this->_render();
    }

    public function addTeacherAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('user|add');

        $school = Models\SchoolModel::getByPK($this->session->u->schoolId);
        $this->_data['classes'] = Models\ClassModel::getClassesFor($school);

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/user');
                }
                $user = new Models\TeacherModel();
                $user->ucname = $this->filterString($_POST['ucname']);
                $user->cryptPwd($_POST['ucpwd']);
                $user->joined = $_POST['joined'];
                $user->privilege = 4;
                $user->schoolId = $this->session->u->schoolId;
                $user->status = 1;
                if($user->save()) {
                    if(isset($_POST['classId'])) {
                        $classes = $this->filterStringArray($_POST['classId']);
                        foreach ($classes as $class) {
                            $cu = new Models\UserClassModel();
                            $cu->userId = $user->id;
                            $cu->classId = $class;
                            $cu->save();
                        }
                    }
                    $userProfile = new Models\ProfileModel;
                    $userProfile->userid = $user->id;
                    $userProfile->firstname = $this->filterString($_POST['firstName']);
                    $userProfile->email = $this->filterEmail($_POST['email']);
                    $userProfile->save();
                    $this->messenger->add(
                        'message',
                        $this->lang->get('user|common', 'user_add_success')
                    );
                    $this->routeTo('/user/defaultschool');
                }
            }
        }

        if(!empty($this->_errors)) {
            $this->extractErrors($this->_errors);
        }

        $this->_render();
    }

    public function addParentAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('user|add');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/user/defaultschool');
                }
                $user = new Models\ParentModel();
                $user->ucname = $this->filterString($_POST['ucname']);
                $user->cryptPwd($_POST['ucpwd']);
                $user->joined = $_POST['joined'];
                $user->privilege = 5;
                $user->schoolId = $this->session->u->schoolId;
                $user->status = 1;
                if($user->save()) {
                    $userProfile = new Models\ProfileModel;
                    $userProfile->userid = $user->id;
                    $userProfile->firstname = $this->filterString($_POST['firstName']);
                    $userProfile->email = $this->filterEmail($_POST['email']);
                    $userProfile->save();
                    $this->messenger->add(
                        'message',
                        $this->lang->get('user|common', 'user_add_success')
                    );
                    $this->routeTo('/user/defaultschool');
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
            if($this->isValidRequest($this->editDataSchema) && $this->validateUserData()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/user');
                }
                $emp->ucname = $this->filterString($_POST['ucname']);
                $emp->status = $this->filterInt($_POST['status']);
                if($emp->save()) {
                    $profile->firstname = $this->filterString($_POST['firstName']);
                    $profile->email = $this->filterEmail($_POST['email']);
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

    public function editSupervisorAction()
    {
        $id = $this->_getParam(0, 'int');
        $emp = Models\UserModel::getByPK($id);
        if($emp === false) {
            $this->routeTo('/user/defaultschool');
        }

        $this->_data['emp'] = $emp;
        $this->_data['profile'] = $profile = Models\ProfileModel::getByPK($emp->id);

        $this->lang->load('common|template');
        $this->lang->load('user|add');
        $this->lang->load('user|edit');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest($this->editTeacherDataSchema) && $this->validateUserData()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/user/defaultschool');
                }
                $emp->status = $this->filterInt($_POST['status']);
                if($emp->save()) {
                    $profile->firstname = $this->filterString($_POST['firstName']);
                    $profile->save();
                    $this->messenger->add(
                        'message',
                        $this->lang->get('user|common', 'user_edit_success')
                    );
                    $this->routeTo('/user/defaultschool');
                }
            }
        }

        $this->_render();
    }

    public function editTeacherAction()
    {
        $id = $this->_getParam(0, 'int');
        $emp = Models\UserModel::getByPK($id);
        if($emp === false) {
            $this->routeTo('/user/defaultschool');
        }

        $this->_data['emp'] = $emp;
        $this->_data['profile'] = $profile = Models\ProfileModel::getByPK($emp->id);
        $this->_data['prevClasses'] = $prevClasses = Models\UserClassModel::getAssocArray(
            'SELECT classId FROM app_users_classes WHERE userId = ' . $emp->id,
            [], true
        );
        $school = Models\SchoolModel::getByPK($this->session->u->schoolId);
        $this->_data['classes'] = Models\ClassModel::getClassesFor($school);

        $this->lang->load('common|template');
        $this->lang->load('user|add');
        $this->lang->load('user|edit');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest($this->editTeacherDataSchema)) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/user/defaultschool');
                }
                $emp->status = $this->filterInt($_POST['status']);
                if($emp->save()) {
                    if(isset($_POST['classId'])) {
                        $prevClasses = Models\UserClassModel::getBy('userId', $emp->id, Models\UserClassModel::DATA_TYPE_INT);
                        if(false !== $prevClasses) {
                            foreach ($prevClasses as $prevClass) {
                                $prevClass->delete();
                            }
                        }
                        $classes = $this->filterStringArray($_POST['classId']);
                        foreach ($classes as $class) {
                            $cu = new Models\UserClassModel();
                            $cu->userId = $emp->id;
                            $cu->classId = $class;
                            $cu->save();
                        }
                    }
                    $profile->firstname = $this->filterString($_POST['firstName']);
                    $profile->save();
                    $this->messenger->add(
                        'message',
                        $this->lang->get('user|common', 'user_edit_success')
                    );
                    $this->routeTo('/user/defaultschool');
                }
            }
        }

        $this->_render();
    }

    public function editParentAction()
    {
        $id = $this->_getParam(0, 'int');
        $emp = Models\UserModel::getByPK($id);
        if($emp === false) {
            $this->routeTo('/user/defaultschool');
        }

        $this->_data['emp'] = $emp;
        $this->_data['profile'] = $profile = Models\ProfileModel::getByPK($emp->id);

        $this->lang->load('common|template');
        $this->lang->load('user|add');
        $this->lang->load('user|edit');

        if(isset($_POST['submit'])) {
            if($this->isValidRequest($this->editTeacherDataSchema) && $this->validateUserData()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/user/defaultschool');
                }
                $emp->status = $this->filterInt($_POST['status']);
                if($emp->save()) {
                    $profile->firstname = $this->filterString($_POST['firstName']);
                    $profile->save();
                    $this->messenger->add(
                        'message',
                        $this->lang->get('user|common', 'user_edit_success')
                    );
                    $this->routeTo('/user/defaultschool');
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

    public function deleteSupervisorAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/user/defaultschool');
        }
        $id = $this->_getParam(0, 'int');
        $emp = Models\UserModel::getByPK($id);
        if($emp === false || $emp->id === $this->session->u->id) {
            $this->routeTo('/user/defaultschool');
        }
        $profile = Models\ProfileModel::getByPK($emp->id);
        if($profile->delete() && $emp->delete()) {
            $this->messenger->add(
                'message',
                $this->lang->get('user|common', 'user_delete_success')
            );
            $this->routeTo('/user/defaultschool');
        }
    }

    public function deleteParentAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/user/defaultschool');
        }
        $id = $this->_getParam(0, 'int');
        $emp = Models\UserModel::getByPK($id);
        if($emp === false || $emp->id === $this->session->u->id) {
            $this->routeTo('/user/defaultschool');
        }
        $profile = Models\ProfileModel::getByPK($emp->id);
        if($profile->delete() && $emp->delete()) {
            $this->messenger->add(
                'message',
                $this->lang->get('user|common', 'user_delete_success')
            );
            $this->routeTo('/user/defaultschool');
        }
    }

    public function deleteTeacherAction()
    {
        if(!$this->requestHasValidToken($_GET['token'])) {
            $this->routeTo('/user/defaultschool');
        }
        $id = $this->_getParam(0, 'int');
        $emp = Models\UserModel::getByPK($id);
        if($emp === false || $emp->id === $this->session->u->id) {
            $this->routeTo('/user/defaultschool');
        }
        $profile = Models\ProfileModel::getByPK($emp->id);
        $classes = Models\UserClassModel::getBy('userId', $emp->id, Models\UserClassModel::DATA_TYPE_INT);
        if(false !== $classes) {
            foreach ($classes as $class) {
                $class->delete();
            }
        }
        if(@$profile->delete() && $emp->delete()) {
            $this->messenger->add(
                'message',
                $this->lang->get('user|common', 'user_delete_success')
            );
            $this->routeTo('/user/defaultschool');
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

    public function viewSchoolMemberAction()
    {

        $id = $this->_getParam(0, 'int');
        $employee = Models\ProfileModel::getByPK($id);

        $this->lang->load('common|template');
        $this->lang->load('user|profile');

        $this->_data['employee'] = $employee;
        $this->_data['classes'] = Models\UserClassModel::getBy('userId', $employee->id, Models\UserClassModel::DATA_TYPE_INT);
        $this->_data['getClass'] = function($classId)
        {
            return Models\ClassModel::getByPK($classId);
        };

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
            $this->routeTo('/user');
        }
    }

    public function passwordAction()
    {

        $employee = Models\UserModel::getByPK($this->session->u->id);

        $this->lang->load('common|template');
        $this->lang->load('user|password');

        if(isset($_POST['submit'])) {
            if($this->validateResetPassword()) {
                if(!$this->requestHasValidToken($_POST['token'])) {
                    $this->routeTo('/user');
                }
                $employee->cryptPwd($_POST['ucpwd']);
                if($employee->save()) {
                    $this->session->message = array($this->lang->get('user|common', 'password_changed_success'), APP_SUCCESS);
                    $this->routeTo('/');
                }
            }
        }

        if(!empty($this->_errors)) {
            $this->extractErrors($this->_errors);
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

    public function canAddUserAction()
    {
        $id = $this->_getParam(0, 'int');
        $emp = Models\UserModel::getByPK($id);
        if($emp === false) {
            $this->routeTo('/user');
        }
        $emp->canAddUser = 1;
        if($emp->save()) {
            $this->messenger->add(
                'message',
                $this->lang->get('user|common', 'can_add_success')
            );
            $this->routeTo('/user/defaultschool');
        }
    }

    public function cannotAddUserAction()
    {
        $id = $this->_getParam(0, 'int');
        $emp = Models\UserModel::getByPK($id);
        if($emp === false) {
            $this->routeTo('/user');
        }
        $emp->canAddUser = 0;
        if($emp->save()) {
            $this->messenger->add(
                'message',
                $this->lang->get('user|common', 'can_not_add_success')
            );
            $this->routeTo('/user/defaultschool');
        }
    }

    public function validateUserData()
    {
        $noErrors = true;
        if(Models\UserModel::isEmpExists($this->filterString($_POST['ucname']))) {
            $this->messenger->add(
                'error_ucname_exists',
                $this->lang->get('user|error', 'error_ucname_exists'),
                Core\Messenger::STATUS_ERROR
            );
            $noErrors = false;
        }
        if(Models\UserModel::isEmailExists($this->filterEmail($_POST['email']))) {
            $this->messenger->add(
                'error_email_exists',
                $this->lang->get('user|error', 'error_email_exists'),
                Core\Messenger::STATUS_ERROR
            );
            $noErrors = false;
        }
        return $noErrors;
    }
}