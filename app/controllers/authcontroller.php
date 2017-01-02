<?php
namespace Lilly\Controllers;
use Lilly\Core\MVC\AbstractController;
use Lilly\Models as Models;

class AuthController extends AbstractController
{
    use \Lilly\Core\Filter;
    use \Lilly\Core\Helper;
    
    public function loginAction()
    {
        if(isset($_SESSION['logged'])) {
            $this->routeTo('/');
        }
        $this->lang->load('auth|login');
        $this->_template->execludeTemplateBlock('sidebar');
        $this->_template->execludeTemplateBlock('header');
        $this->_template->execludeTemplateBlock('footer');
        if(isset($_POST['submit'])) {
            $username = $this->filterString($_POST['ucname']);
            $password = $this->filterString($_POST['ucpwd']);
            $loggingUser = Models\UserModel::authenticate($username, $password);
            if($loggingUser === 1) {
                if(isset($_SESSION['access_url'])) {
                    $this->routeTo($_SESSION['access_url']);
                } else {
                    $this->routeTo('/');
                }
            } else if($loggingUser === 2) {
                $this->_data['error_login'] = $this->lang->get('auth|error', 'error_login_disabled');
            } else {
                $this->_data['error_login'] = $this->lang->get('auth|error', 'error_login');
            }
        }
        $this->_render();
    }
    
    public function logoutAction()
    {
        $this->session->kill();
        $this->routeTo('/auth/login');
    }
    
    public function deniedAction()
    {
        $this->lang->load('common|template');
        $this->lang->load('auth|denied');
        $this->_render();
    }
}
