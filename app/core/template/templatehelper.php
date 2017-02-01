<?php
namespace Lilly\Core\Template;

trait TemplateHelper
{
    public function highlightMenu($controller)
    {
        $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        @list($cont) = explode('/', $url, 2);
        if(!isset($cont) || empty($cont)) {
            $cont = 'index';
        }

        if(is_array($controller) && in_array(strtolower($cont), $controller)) {
            return true;
        } else if(strtolower($cont) === $controller) {
            return true;
        }
        return false;
    }
    
    public function enableMenu($userPrivilege, array $allowed) {
        if(in_array($userPrivilege, $allowed)) {
            return true;
        }
    }
    
    public function switchTo($type)
    {
        switch ($type) {
            case APP_ERROR:
                return 'error';
                break;
            case APP_INFO:
                return 'info';
                break;
            case APP_WARNING:
                return 'warning';
                break;
            case APP_SUCCESS:
                return 'success';
                break;
        }
    }
}