<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'lib/user.table.db.php';
require_once 'modules/login/LoginActionController.php';
require_once 'modules/login/LoginViewController.php';
class Login  {
    private $sessionController;
    private $rightsController;   
    private $smarty;
    private $actionController;
    private $viewController;

    public function __construct($sessionController,$rightsController,$smarty,$debug) {//$view,$action) { 
        $this->smarty = $smarty;
        $this->actionController = new LoginActionController($sessionController,$debug);
        $this->smarty->assign('error',$this->actionController->getError());
        $this->viewController = new LoginViewController($sessionController,$smarty,$debug);
    }
    


}





?>