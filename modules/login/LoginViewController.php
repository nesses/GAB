<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
require_once 'ViewController.php';

class LoginViewController extends ViewController{
    
    private $sessionController;
    
    private $views = ['main'];
    private $params = ['main'];
    private $smarty;
            
    public function __construct($sessionController,$smarty,$debug=false) {
        $this->sessionController = $sessionController;
        if($debug)
            echo "<b>[DBG]Login</b>";
        $this->smarty = $smarty;
        parent::__construct($sessionController,$this->views,$this->params,$debug);
        
        
        
    }
    public function main() {
        if($this->getError()) {
            $this->smarty->assign('msg',$this->getError());
            
            
        }
        
        $this->smarty->display('templates/modules/login.tpl'); 
    
        
    }
    
}
