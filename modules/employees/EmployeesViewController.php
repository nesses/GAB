<?php
/* 
 * @author Matthias Grotjohann
 */
require_once 'ViewController.php';

class EmployeesViewController extends ViewController {
    
    private $views = ['listView','editView'];
    
    public function __construct($sessionController,$debug=false) {
            
        //$this->sessionController = $sessionController;
        $this->usersTable = new UserTable();
        
        if($debug)
            echo "<b>[DBG]Employees</b>";
        parent::__construct($sessionController,$this->views,$this->params,$debug);
        
    }
    public function listView() {
        echo "listView";
    }
    public function editView() {
        echo "editView";
    }
}
