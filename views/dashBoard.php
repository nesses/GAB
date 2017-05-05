<?php

/* 
 * @author Matthias Grotjohann
 */

class dashBoard extends Smarty {
    
    public function __construct() {
        parent::__construct();
        require_once 'lib/plungerclock.table.db.php';
        $this->pclockTable = new PlungerclockTable();
        $this->usersTable = new UserTable();
        $stamps = $this->pclockTable->getAllByUserId($this->sessionController->getUser()['id']);
        $users = $this->usersTable->getUsersByGroupId($_SESSION['user']['groups_id'],0,4);
        
    }
    public function assignValues($username,$current_page,$buddys,$working_stat) {
        $this->assign('myself',$username);
        $this->assign('cur_page',$current_page);
        $this->assign('users',$buddys);
        $this->assign('cur_work_stat',$working_stat);
        
    }
    
}