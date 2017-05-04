<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'lib/user.table.db.php';
require_once 'modules/login/LoginActionController.php';
require_once 'modules/login/LoginViewController.php';
class Login  {
       
    private $smarty;
    private $actionController;
    private $viewController;

    public function __construct($view,$action) { 
        $this->actionController = new LoginActionController($action);
        $this->smarty = new Smarty();
        
        $this->viewController = new LoginViewController($view);
    }
    public function show() {
        
        $this->smarty->display('templates/modules/login.tpl'); 
    }
    


}





?>
