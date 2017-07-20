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

    public function showValue($fieldName, $object = null, $defaultValue = false)
    {
        return isset($_POST[$fieldName]) ? $_POST[$fieldName] : ($object === null ? ($defaultValue === false ? '' : $defaultValue) : $object->$fieldName);
    }

    public function radioCheckedIf($fieldName, $value, $object = null)
    {
        return ((isset($_POST[$fieldName]) && $_POST[$fieldName] == $value) || ($object !== null && $object->$fieldName == $value)) ? 'checked' : '';
    }

    public function selectedIf($fieldName, $value, $object = null)
    {
        return ((isset($_POST[$fieldName]) && $_POST[$fieldName] == $value) || ($object !== null && $object->$fieldName == $value)) ? 'selected' : '';
    }

    public function boxMultipleCheckedIf($fieldName, $value, $object = null)
    {
        return ((isset($_POST[$fieldName]) && is_array($_POST[$fieldName]) && in_array($value, $_POST[$fieldName])) || ($object !== null && is_array($object->$fieldName) && in_array($value, $object->$fieldName))) ? 'checked' : '';
    }

    public function boxCheckedIf($fieldName, $value, $object = null)
    {
        return (isset($_POST[$fieldName]) == $value || ($object !== null && $value == $object->$fieldName)) ? 'checked' : '';
    }
}