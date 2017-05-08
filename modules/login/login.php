<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'modules/login/LoginController.php';
class Login {
    
    private $controller;
    
    private $views    = ['main'];
      
    private $actions  = ['main' => ['doLogin','doLogout']];
    
    
    
    public function __construct($sessionController) { 
        $sessionController->registerModuleActions($this->actions);
        $this->controller = new LoginController($sessionController);
    }
    


}





?>