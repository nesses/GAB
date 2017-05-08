<?php
require_once 'ModuleController.php';
require_once 'modules/login/views/Login.php';   
class LoginController extends ModuleController {
    public $sessionController;
    
    
    
    
    
    public function __construct($sessionController) {
        $this->sessionController = $sessionController;
        parent::__construct($sessionController);
    }
    
    public function hasAction() {
        if($this->getActionCommand())
            return true;
    }
    public function hasPOST() {
        if($this->sessionController->hasPOST())
            return true;
    }
    public function setSessionUser($user) {
        $this->sessionController->setUser($user);
    }
    public function getSessionUser() {
        return $this->sessionController->getUser();
    }
    
    
}