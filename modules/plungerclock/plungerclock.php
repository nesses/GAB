<?php
/*** 
 * @author Matthias Grotjohann
 */
require_once 'modules/plungerclock/PlungerclockActionController.php';
require_once 'modules/plungerclock/PlungerclockViewController.php';

class plungerclock  {
    
    private $sessionController;
    private $rightsController;   
    private $smarty;
    private $actionController;
    private $viewController;

    
    private $fieldVisibility = ["id"                =>   1,
                                "users_id"          =>   1,
                                "timestamp"         =>   1];
    


    public function __construct($sessionController,$rightsController,$smarty,$debug) {        
        $this->sessionController=$sessionController;
        $this->rightsController=$rightsController;
        $this->smarty = $smarty;
        $this->actionController  = new PlungerclockActionController($sessionController,$debug);
        $this->viewController = new PlungerclockViewController($sessionController,$smarty,$debug);
        
       
        
        
    }
    public function show() {
        $this->smarty->display('templates/modules/plungerclock.tpl');
    }
    
    
}
    
