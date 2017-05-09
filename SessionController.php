<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'lib/modules.table.db.php';
require_once 'RightsController.php';
class SessionController extends RightsController {
    
    private $error;
    
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
        } elseif($_SESSION['module'] == '')
            $_SESSION['module'] = 'login';    
        
        $this->module = $_SESSION['module'];
    }
    
    public function fetchUser() {
        $this->user = $_SESSION['user'];
    }
    public function getRightsController() {
        return $this->rightsController;
    }
    public function hasUser() {
        if($this->user)
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
    public function setModule() {
        $_SESSION['module'] = $module;
        $this->module = $module;
    }
    public function getModule() {
        return $this->module;
    }
    public function setError($errormsg) {
        $_SESSION['error'][$this->module][0] = $errormsg;
    }
    public function getError() {
        $err = $_SESSION['error'][$this->module][0];
        return $err;    
    }
    public function clearError() {
        $_SESSION['error'][$this->module]=null;
    }
    
    public function redirect($module = null,$view= null) {
          if(!$view && !$module) {
              echo '<script type="text/javascript">window.location="index.php"</script>';
            } else {
              if(!$module)
                    $module = $this->module;
              if($view)
                  $module .= "&view=".$view;
              echo '<script type="text/javascript">window.location="index.php?module='.$module.'"</script>';
            }
    }
    public function destroy() {
          session_unset();
    }
    
}   

?>