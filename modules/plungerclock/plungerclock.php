<?php
/*** 
 * @author Matthias Grotjohann
 */
require_once 'modules/plungerclock/PlungerclockActionController.php';
require_once 'modules/plungerclock/PlungerclockViewController.php';

class plungerclock  {
    
    private $smarty;
    private $actionController;
    private $viewController;
    
    private $fieldVisibility = ["id"                =>   1,
                                "users_id"          =>   1,
                                "timestamp"         =>   1];
    

    
    public function __construct($view,$action) {
        $this->actionController  = new PlungerclockActionController($action, $this->actions);
        $this->smarty = new Smarty();
        $this->viewController = new PlungerclockViewController($this->smarty,$view);
        
       
        
        
    }
    public function show() {
        $this->smarty->display('templates/modules/plungerclock.tpl');
    }
    
    
}
    
