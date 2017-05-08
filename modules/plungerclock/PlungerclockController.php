<?php

/* 
 * @author Matthias Grotjohann
 */

require_once 'ModuleController.php';
require_once 'modules/employees/views/ListView.php';   

class PlungerclockController extends ModuleController {
    private $sessionController;
    public function __construct($sessionController) {
        $this->sessionController = $sessionController;
        parent::__construct($sessionController);
        //$this->fetchParams();
    }
    public function getSessionUser() {
        return $this->sessionController->getUser();
    }
    
}