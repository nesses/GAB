<?php
require_once 'ModuleController.php';
require_once 'modules/employees/views/ListView.php';   

class EmployeesController extends ModuleController {
    private $sessionController;
    public function __construct($sessionController) {
        $this->sessionController = $sessionController;
        parent::__construct($sessionController);
    }
    public function getCurrentModule() {
        return $this->sessionController->getModule();
    }
    
}