<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'lib/modules.table.db.php';
require_once 'RightsController.php';
class SessionController extends RightsController {
    
    private $errors;
    
    private $module;
    private $view;
    private $action;
    private $user;
    
    
    
    public function __construct($debug = false) {
        parent::__construct();
        $this->init();
        print_r($_SESSION);
        
        
    }
    public function init() {
        session_start();
        
        $this->fetchModule();
        
        $this->fetchView();
        
        $this->fetchAction();
        
        $this->fetchUser();
        
        
        
        
    }
    public function fetchParams($params) {
        foreach ($params as $key => $paramkey) {
            if(isset($_GET[$paramkey])) {
                $_SESSION[$this->getModule()][$paramkey] = $_GET[$paramkey];
            }
        }
    }
    private function fetchModule() {
        if(isset($_GET['module'])) {
            $_SESSION['module'] = $_GET['module'];
        } else 
            $_SESSION['module'] = 'login';
        $this->module = $_SESSION['module'];
    }
    private function fetchView() {
        if(isset($_GET['view']))
            $_SESSION['view'] = $_GET['view'];
        else
            $_SESSION['view'] = '';
        $this->view = $_SESSION['view'];
    }
    private function fetchAction() {
        if(isset($_GET['action'])) 
            $_SESSION['action'] = $_GET['action'];
        else 
            $_SESSION['action'] = '';
        $this->action = $_SESSION['action'];
    }
    public function fetchUser() {
        $this->user = $_SESSION['user'];
    }
    public function getRightsController() {
        return $this->rightsController;
    }
    public function hasPOST() {
        if($_POST)
              return true;
        return false;
    }
    public function getUser() {
        return $this->user;
    }
    public function setUser($user) {
          $_SESSION['user'] = $user;
          $this->user = $user;
    }
    public function getModule() {
        return $this->module;
    }
    public function getAction() {
        return $this->action;
    }
    public function getView() {
        return $this->view;
    }
    public function setView($view) {
        $this->view = $view;
        $_SESSION['view'] = $view;
    }
    public function setError($errormsg) {
        $_SESSION['error'][$this->module][0] = $errormsg;
        //$this->redirect();
    }
    public function getError() {
        $err = $_SESSION['error'][$this->module][0];
        return $err;    
    }
    public function clearError() {
        $_SESSION['error'][$this->module]=null;
    }
    public function getParams() {
        return $_SESSION[$this->module];
    }
    public function setParam($name,$data) {
        $_SESSION[$this->module][$name] = $data;
    }
    public function redirect($module = null) {
          if(!$module)
                $module = $this->module;
                
          echo '<script type="text/javascript">window.location="index.php?module='.$module.'"</script>';
    }
    public function destroy() {
          session_unset();
    }
    
}   

?>