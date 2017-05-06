<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'lib/user.table.db.php';
require_once 'modules/login/LoginActionController.php';
require_once 'modules/login/LoginViewController.php';
class Login {
    private $sessionController;
    private $rightsController;   
    private $smarty;
    private $actionController;
    private $viewController;

    public function __construct($sessionController,$rightsController,$debug) {//$view,$action) { 
        $this->sessionController = $sessionController;
        $this->rightsController = $rightsController;
        
        $this->smarty = new Smarty();
        $this->actionController = new LoginActionController($sessionController,$debug);
        //$this->smarty->assign('error',$this->actionController->getError());
        $this->viewController = new LoginViewController($sessionController,$this->smarty,$debug);
    }
    


}





?>