<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'ViewController.php';
class PlungerclockViewController extends ViewController {
    private $sessionController;
    
    private $smarty;
    
    private $views = ['dashBoard'];
            
    public function __construct($sessionController,$smarty,$debug=false) {
        
        $this->sessionController = $sessionController;
        if($debug)
            echo "<b>[DBG]Plungerclock</b>";
        $this->smarty = $smarty;
        parent::__construct($sessionController,$this->views,$debug);
        
        
    }
    public function getView() {
        return $this->view;
    }
    public function dashBoard() {
        $this->pclockTable = new PlungerclockTable();
        $this->usersTable = new UserTable();
        
        echo $this->getUser();
        $stamps = $this->pclockTable->getAllByUserId($this->getUser()['id']);
        $usr_wrk_stat = $this->isUserWorking();
        
        
        $users = $this->usersTable->getUsersByGroupId($_SESSION['user']['groups_id']);
        
        $this->assign('myself',$this->usersTable->getUserByUsername($_SESSION['user']['username']));
        
    }
}
