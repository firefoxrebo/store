<?php
namespace Lilly\Core\MVC;
use Lilly\Core as Core;
use Lilly\Core\Template as Template;

/**
 * Abstract Controller
 * @author fox
 *
 */
abstract class AbstractController
{

    /**
     * Controller Name
     *
     * @var string
     */
    protected $_controller;

    /**
     * Acion Name
     *
     * @var string
     */
    protected $_action;

    /**
     * Regisry object reference
     *
     * @var \Lilly\Core\Registry
     */
    protected $_registry;

    /**
     * Data array used to keep track of
     * all data passed to the view
     *
     * @var array
     */
    protected $_data = array();

    /**
     * URL extracted parameters
     * which could be used for
     * any action
     *
     * @var array
     */
    protected $_params = array();
    
    /**
     * A template instance
     * @var \Lilly\Core\Template\Template
     */
    protected $_template;
    
    /**
     * Controller name setter
     *
     * @param string $controller            
     */
    public function setController ($controller)
    {
        $this->_controller = strtolower($controller);
    }

    /**
     * Acion Name setter
     *
     * @param string $action            
     */
    public function setAction ($action)
    {
        $this->_action = strtolower($action);
    }

    /**
     * Parameters array setter
     *
     * @param array $params            
     */
    public function setParams (array $params)
    {
        $this->_params = $params;
    }

    /**
     * Registry object setter
     *
     * @param \Lilly\Core\Registry $registry
     */
    public function setRegistry (Core\Registry $registry)
    {
        $this->_registry = $registry;
    }
    
    /**
     * Set the template property to a Template instance
     * @param \Lilly\Core\Template\Template $template
     */
    public function setTemplate(Template\Template $template)
    {
        $this->_template = $template;
    }
    

    /**
     * Global setter is used to
     * set any new dynamic attribute
     * in the registry object
     *
     * @param string $key            
     * @param mixed $value            
     */
    public function __set ($key, $value)
    {
        $this->_registry->$key = $value;
    }

    /**
     * Global getter is used to
     * get a given value by key
     * from the registry object
     *
     * @param string $key            
     */
    public function __get ($key)
    {
        return $this->_registry->$key;
    }

    /**
     * Used to get a stored parameter back in a given type
     *
     * @param int $key            
     * @param string $type            
     * @example _getParam(1, 'int');
     * @return mixed
     */
    protected function _getParam ($key, $type)
    {
        if (array_key_exists($key, $this->_params)) {
            $type = strtolower($type);
            $value = '';
            switch ($type) {
                case 'int':
                    $value = filter_var($this->_params[$key],
                            FILTER_SANITIZE_NUMBER_INT);
                    break;
                case 'float':
                    $value = filter_var($this->_params[$key],
                            FILTER_SANITIZE_NUMBER_FLOAT);
                    break;
                case 'string':
                    $value = filter_var($this->_params[$key],
                            FILTER_SANITIZE_FULL_SPECIAL_CHARS, 
                            FILTER_FLAG_NO_ENCODE_QUOTES);
                    break;
            }
            return $value;
        } else {
            return false;
        }
    }
    
    protected function injectCKEditor()
    {
        $this->_template->injectHeaderResource('ckeditor', 'js', 
                JS . 'vendor/ckeditor/ckeditor.js', 'modernizr');
        $this->_template->injectHeaderResource('ckfinder', 'js', 
                JS . 'vendor/ckeditor/ckfinder.js', 'ckeditor');
    }

    protected function injectDataTable()
    {
        $dataTableFile = ($_SESSION['lang'] == 'ar') ? 'jquery.datatables.rtl.js' : 'jquery.datatables.js';
        $this->_template->injectFooterResource('datatables',
            JS . $dataTableFile , 'menu');
    }

    /**
     * Renders the appropriate view
     * based on the defined controller
     * and action.
     * It users the controller
     * name as a folder name and the action
     * as a reference to the view file name
     */
    protected function _render ()
    {
        $viewFile = VIEWS_PATH . DS . $this->_controller . DS . $this->_action .
                 '.view.php';
        $this->_template->setData($this->_data);
        $this->_template->setLang($this->lang->getDictionary());
        $this->_template->setView($viewFile);
        $this->_template->setRegistry($this->_registry);
        $this->_template->drawTemplate();
    }

    /**
     * Used to render the not found view
     * in case of a non existed view
     */
    public function notfound ()
    {
        $viewFile = VIEWS_PATH . DS . 'notfound' . DS . 'default.view.php';
        $this->_template->setData($this->_data);
        $this->_template->setLang($this->lang->getDictionary());
        $this->_template->setView($viewFile);
        $this->_template->setRegistry($this->_registry);
        $this->_template->drawTemplate();
    }
    
    protected function extractErrors(array $errors)
    {
        foreach ($errors as $key => $value) {
            $this->_data[$key] = $value;
        }
    }

    protected function requestHasValidToken ( $token )
    {
        return $token === $this->session->CSRFToken ? true : false;
    }

    protected function isValidRequest($schema = [])
    {
        if(empty($schema))
            $schema = $this->dataSchema;
        $hasErrors = false;
        foreach ($schema as $field => $roles) {
            $fieldValue = $_POST[$field];
            $fieldRoles = explode('|', $roles);
            foreach ($fieldRoles as $role) {
                if(!$this->validate($role, $fieldValue)) {
                    $hasErrors = true;
                    if(preg_match('/strbetween/', $role))
                        $role = 'strbetween';
                    if(preg_match('/intbetween/', $role))
                        $role = 'intbetween';
                    if(preg_match('/lt/', $role))
                        $role = 'lt';
                    if(preg_match('/gt/', $role))
                        $role = 'gt';
                    if(preg_match('/lte/', $role))
                        $role = 'lte';
                    if(preg_match('/gte/', $role))
                        $role = 'gte';
                    if(preg_match('/equals/', $role))
                        $role = 'equals';
                    $this->messenger->add(
                        'text_error_' . $field . '_' . $role,
                        $this->lang->get('validation|error', 'text_error_' . $role),
                        Core\Messenger::STATUS_ERROR
                    );
                }
            }
        }
        return $hasErrors === false ? true : false;
    }

}