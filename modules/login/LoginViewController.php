<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
require_once 'ViewController.php';
require_once 'modules/login/views/Login.php';
class LoginViewController extends ViewController {
    
    private $sessionController;
    
    private $views = ['main'];
    
    //private $smarty;
            
    public function __construct($sessionController,$smarty,$debug=false) {
        $this->sessionController = $sessionController;
        if($debug)
            echo "<b>[DBG]Login</b>";
        $this->smarty = $smarty;
        parent::__construct($sessionController,$this->views,$this->params,$debug);
        
        
        
    }
    public function main() {
        $login = new SmartyLogin();
        
        if($this->getError()) {
            $login->assign('msg',$this->getError());
            
            
        }
        
        $login->display('templates/modules/login.tpl'); 
    
        
    }
    
}
