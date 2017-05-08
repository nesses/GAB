<?php
require_once 'ModuleController.php';
require_once 'modules/employees/views/ListView.php';   

class EmployeesController extends ModuleController {
    private $sessionController;
    
    
    
    public function __construct($sessionController) {
        $this->setDefaultView($this->default_view);
        $sessionController->registerModuleActions($this->actions);
        $this->sessionController = $sessionController;
        $this->usersTable = new UserTable();
        parent::__construct($sessionController);
    }
    
}