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

    private $pclockTable;
    
    public function __construct($sessionController,$debug) {        
        $this->sessionController=$sessionController;
        $this->rightsController=$rightsController;
        
        $this->pclockTable= new PlungerclockTable();
        $this->actionController  = new PlungerclockActionController($sessionController, $this->pclockTable,$debug);
        $this->viewController = new PlungerclockViewController($sessionController,$this->pclockTable,$debug);
  
    }
    
    
}
    
