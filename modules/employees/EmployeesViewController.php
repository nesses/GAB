<?php
/* 
 * @author Matthias Grotjohann
 */
require_once 'ViewController.php';
require_once 'modules/employees/views/ListView.php';
class EmployeesViewController extends ViewController {
    
    private $sessionController;
    
    private $views = ['listView','editView'];
    private $params = ['listView' => ['page','offset','orderby']];
    public function __construct($sessionController) {
        
        $this->sessionController = $sessionController;
        $this->usersTable = new UserTable();
        
        parent::__construct($sessionController,$this->views,$this->params);
    }
    public function listView() {
        $offset=$this->sessionController->getParams()['offset'];
        $page=$this->sessionController->getParams()['page'];
        $orderby=$this->sessionController->getParams()['orderby'];
        //print_r($this->sessionController->getParams()['employees']);
        if(!$offset) {
            $offset = 5;
            $this->sessionController->setParam('offset',$offset);
        }
        if(!$page) {
            $page = 0;
            $this->sessionController->setParam('page',$page);
        }
        $listView = new ListView();
        $users = $this->usersTable->getAll($page*$offset,$offset,$orderby);
        $size = $this->usersTable->countAll();
        
        $listView->assign('module',$this->sessionController->getModule());
        $listView->assign('view',$this->sessionController->getView());
        $listView->assign('offset',$offset);
        $listView->assign('size',$size);
        $listView->assign('users',$users);
        
        
        $listView->display("templates/items/ListView.tpl");
    }
    public function editView() {
        echo "editView";
    }
}
