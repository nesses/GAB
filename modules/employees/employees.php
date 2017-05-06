<?php

require_once 'modules/employees/EmployeesActionController.php';
require_once 'modules/employees/EmployeesViewController.php';

class employees {
    
    private $sessionController;
    private $actionController;
    private $viewController;

    public function __construct($sessionController,$debug) {        
        $this->sessionController=$sessionController;
        
        $this->actionController  = new EmployeesActionController($sessionController, $debug);
        $this->viewController = new EmployeesViewController($sessionController,$debug);
  
    }
}
?>