<?php
/*** 
 * @author Matthias Grotjohann
 */
require_once 'modules/plungerclock/PlungerclockActionController.php';
require_once 'modules/plungerclock/PlungerclockViewController.php';
require_once 'lib/plungerclock.table.db.php';
class plungerclock  {
    
    private $sessionController;
    private $rightsController;   
    private $actionController;
    private $viewController;

    private $dashBoard;
    
    private $pclockTable;
    
    private $fieldVisibility = ["id"                =>   1,
                                "users_id"          =>   1,
                                "timestamp"         =>   1];
    


    public function __construct($sessionController,$rightsController,$debug) {        
        $this->sessionController=$sessionController;
        $this->rightsController=$rightsController;
        
        $this->pclockTable= new PlungerclockTable();
        $this->actionController  = new PlungerclockActionController($sessionController, $this->pclockTable,$debug);
        $this->viewController = new PlungerclockViewController($sessionController,$this->pclockTable,$debug);
  
    }
    
    
}
    
