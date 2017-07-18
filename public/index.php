<?php
namespace Lilly;

use Lilly\Core as Core;
use Lilly\Core\Template as Template;
use Lilly\Core\Security as Security;
use Lilly\Core\ACL as ACL;
use Lilly\Core\HTTP\HTTPRequest;

if(!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

require '..' . DS . 'app' . DS . 'config.php';

ob_start();

// Start session 
$session = new Core\SessionManager();
$session->start();
//session_start();

// Open Database Connection and get an instance of Database
$db = Core\Database\DatabaseHandler::factory();

// Create a new template object
require '..' . DS . 'app' . DS . 'templateconfig.php';
$template = new Template\Template($tempBlocks);

// Create a CSRFHandler instance
$csrf = Security\CSRFSecHandler::getInstance();
$csrf->setupToken();

// Create the Registry object
$reg = Core\Registry::getInstance();

// Create the language object to distribute it over the template parts
$lang = new Core\Language;

// Create a startup object to fetch 
// some required data for the application to startup
$startup = new Core\Startup;

// Create an HTTP Request Object to get access to the request parts
$request = HTTPRequest::getInstance();

// Create a Messenger Object to collect messages across the application
$messenger = Core\Messenger::getInstance();

// Create an authentication instance
// Placing the authentication here is must 
// to guarantee the application will not take 
// any action if the user has a denied rule.
$auth = ACL\Authentication::getInstance();
$auth->checkAuthentication();
if(@is_array($session->u->permissions)) {
    $auth->canAccess($session->u->permissions);
}

// Register the database object 
$reg->db = $db;

// Register the session object
$reg->session = $session;

// Register the language object
$reg->lang = $lang;

// Register the startup data
$reg->startup = $startup;

// Register the request object
$reg->request = $request;

// Register the messenger object
$reg->messenger = $messenger;

$front = new Core\FrontController($reg, $template);
$front->dispatch();