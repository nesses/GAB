<?php

/*** 
 * @author Matthias Grotjohann
 */
require_once 'modules/plungerclock/PlungerclockActionController.php';
require_once 'modules/plungerclock/PlungerclockViewController.php';

class plungerclock  {
    
    private $smarty;
    private $actionController;
    private $viewController;
    
    private $fieldVisibility = ["id"                =>   1,
                                "users_id"          =>   1,
                                "timestamp"         =>   1];
    
    private $pclockTable;
    
    private $usersTable;
    
    public function __construct($view,$action) {
        $this->actionController  = new PlungerclockActionController($action, $this->actions);
        $this->viewController = new PlungerclockViewController($view);
        
        $this->pclockTable = new PlungerclockTable();
        $this->usersTable = new UserTable();
        
        
        $stamps = $this->pclockTable->getAllByUserId($_SESSION['user']['id']);
        $usr_wrk_stat = $this->isUserWorking();
        
        
        $users = $this->usersTable->getUsersByGroupId($_SESSION['user']['groups_id']);
        
        $this->assign('myself',$this->usersTable->getUserByUsername($_SESSION['user']['username']));
        $this->assign('users',$users);
        $this->assign('user_work_stat',$usr_wrk_stat);
        
        
        $this->display('templates/modules/plungerclock.tpl');
    }
    public function isUserWorking() {
        return $this->pclockTable->getLastStatusByUserId($_SESSION['user']['id']);
    }
    
    
}
    