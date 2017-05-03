<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'lib/user.table.db.php';
require_once 'modules/login/LoginActionController.php';
class Login  {
       
    private $smarty;
    private $actionController;

    public function __construct($view,$action) { 
        $this->actionController = new LoginActionController($action);
    }
    public function show() {
        $this->smarty = new Smarty();
        $this->smarty->display('templates/modules/login.tpl'); 
    }
    


}





?>
