<?php
/* 
 * @author Matthias Grotjohann
 */
require_once 'ViewController.php';
require_once 'modules/employees/views/ListView.php';
class EmployeesViewController extends ViewController {
    
    private $views = ['listView','editView'];
    
    public function __construct($sessionController) {
            
        $this->usersTable = new UserTable();
        
        parent::__construct($sessionController,$this->views,$this->params);
        
    }
    public function listView() {
        $listView = new ListView();
        $users = $this->usersTable->getAll();
        $listView->assign('users',$users);
        
        
        $listView->display("templates/items/ListView.tpl");
    }
    public function editView() {
        echo "editView";
    }
}
