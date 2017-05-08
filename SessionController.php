<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'lib/modules.table.db.php';
require_once 'RightsController.php';
class SessionController extends RightsController {
    
    private $errors;
    
    private $module;
    
    private $user;
    
    
    public function __construct() {
        parent::__construct();
        $this->init();
        print_r($_SESSION);
    }
    public function init() {
        session_start();
        
        $this->fetchModule();
        
        $this->fetchUser();
        
    }
    
    private function fetchModule() {
        if(isset($_GET['module'])) {
            $_SESSION['module'] = $_GET['module'];
        } else 
            $_SESSION['module'] = 'login';
        $this->module = $_SESSION['module'];
    }
    
    public function fetchUser() {
        $this->user = $_SESSION['user'];
    }
    public function getRightsController() {
        return $this->rightsController;
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