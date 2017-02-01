<?php

// 1 for Development | 2 for Production
define('PROJECT_SCOPE', 1);

// Database Credentials
defined('DATABASE_HOST_NAME')       ? null : define ('DATABASE_HOST_NAME', 'localhost');
defined('DATABASE_USER_NAME')       ? null : define ('DATABASE_USER_NAME', 'root');
defined('DATABASE_PASSWORD')        ? null : define ('DATABASE_PASSWORD', 'rebo');
defined('DATABASE_DB_NAME')         ? null : define ('DATABASE_DB_NAME', 'store');
defined('DATABASE_PORT_NUMBER')     ? null : define ('DATABASE_PORT_NUMBER', 3306);
defined('DATABASE_CONN_DRIVER')     ? null : define ('DATABASE_CONN_DRIVER', 1);

// Paths
define('APP_PATH', dirname(realpath(__FILE__)));
define('TEMPLATE_PATH', APP_PATH . DS . 'template');
define('MODELS_PATH', APP_PATH . DS . 'models');
define('VIEWS_PATH', APP_PATH . DS . 'views');
define('CONTROLLERS_PATH', APP_PATH . DS . 'controllers');
define('LANGUAGE_PATH', APP_PATH . DS . 'language');
define('CORE_PATH', APP_PATH . DS . 'core');
define('CORE_FORM_PATH', CORE_PATH . DS . 'form');
define('CORE_TEMPLATE_PATH', CORE_PATH . DS . 'template');


// Web Directories
define('JS', '/js/');
define('IMG', '/img/');
define('CSS', '/css/');

// Storage Directories
define('MAIN_STORAGE_FOLDER', APP_PATH . DS . '..' . DS . 'public' . DS . '_uploads');
define('IMAGE_STORAGE_FOLDER', MAIN_STORAGE_FOLDER . DS . 'images' . DS);
define('DOCS_STORAGE_FOLDER', MAIN_STORAGE_FOLDER . DS . 'documents' . DS);

// Default App Values
define('APP_TITLE', 'المستودع الالكتروني');

// Session Data
define('SESSION_NAME', '_STORE_SESS_ID');
define('SESSION_LIFE_TIME', 0);
define('SESSION_SAVE_PATH', APP_PATH . DS . '..' . DS . 'sessions');

// Sault Key 
define('APP_SAULT', 'D3VG@T3.C0W-S@it.2016111');

// Default application Language 
define('DEFAULT_LANGUAGE', 'ar');

// Other constants 
define('SETUP_OFFER_PREFIX', 'SF-');
define('MTN_OFFER_PREFIX', 'MF-');
define('SETUP_CONTRACT_PREFIX', 'SC-');
define('MTN_CONTRACT_PREFIX', 'MC-');
define('APP_HEADER_TITLE', 'المستودع الالكتروني');

// App Information Messages
define('APP_ERROR', 1);
define('APP_INFO', 2);
define('APP_WARNING', 3);
define('APP_SUCCESS', 4);

// Email Credentials
define('EMAIL_USER', 'myehiasandbox@gmail.com');
define('EMAIL_PASS', 'rebo1531982');
define('EMAIL_HOST', 'smtp.gmail.com');
define('EMAIL_PORT', 465);

// define an autoloader function
function autoload ($className)
{
    $namespacePrefix = 'Lilly';
    $class = str_replace($namespacePrefix, '', $className);
    $class = str_replace('\\', '/', $class);
    $classFile = APP_PATH . strtolower($class) . '.php';
    if(file_exists($classFile)) {
        require $classFile;
    }
}

spl_autoload_register('autoload');

if (PROJECT_SCOPE === 1) {
    ini_set('display_errors', 1);
} else {
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', APP_PATH . DS . 'error.log');
}
error_reporting(E_ALL);
mb_internal_encoding('utf8');