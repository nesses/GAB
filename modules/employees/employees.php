<?php

require_once 'modules/employees/EmployeesController.php';
class employees {
    
    private $controller;
    
    private $actions = ['ListView' => ['page','offset','orderby']];
    
    private $views = ['ListView'];
    
    public function __construct($sessionController) {        
        $sessionController->registerModuleActions($this->actions);
        $this->controller = new EmployeesController($sessionController);
        
  
    }
}
?>