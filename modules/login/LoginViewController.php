<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
require_once 'ViewController.php';

class LoginViewController extends ViewController{
    
    
    private $views = ['main'];
    private $smarty;
            
    public function __construct($sessionController,$smarty,$debug=false) {
        if($debug)
            echo "<b>[DBG]Login</b>";
        $this->smarty = $smarty;
        parent::__construct($sessionController,$this->views,$debug);
        
        
        
    }
    public function main() {
        
        $this->smarty->display('templates/modules/login.tpl'); 
    
        
    }
    
}
