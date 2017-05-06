<?php
/*** 
 * @author Matthias Grotjohann
 */
require_once 'modules/plungerclock/PlungerclockActionController.php';
require_once 'modules/plungerclock/PlungerclockViewController.php';
require_once 'lib/plungerclock.table.db.php';
class plungerclock  {
    
    private $sessionController;
    private $actionController;
    private $viewController;

    private $pclockTable;
    
    public function __construct($sessionController) {        
        $this->pclockTable= new PlungerclockTable();
        
        $this->sessionController=$sessionController;
        $this->actionController  = new PlungerclockActionController($sessionController, $this->pclockTable);
        $this->viewController = new PlungerclockViewController($sessionController,$this->pclockTable);
  
    }
    
    
}
    
