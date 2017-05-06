<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'lib/user.table.db.php';
require_once 'modules/login/LoginActionController.php';
require_once 'modules/login/LoginViewController.php';
class Login {
    private $sessionController;
    private $actionController;
    private $viewController;

    public function __construct($sessionController,$debug) {//$view,$action) { 
        $this->sessionController = $sessionController;
        
        $this->actionController = new LoginActionController($sessionController,$debug);
        $this->viewController = new LoginViewController($sessionController,$debug);
    }
    


}





?>