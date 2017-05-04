<?php

/*** 
 * @author Matthias Grotjohann
 */
require_once 'modules/module.mother.php';
class plungerclock  {
    
    private $actions = ['stamp'];
    
    private $fieldVisibility = ["id"                =>   1,
                                "users_id"           =>  1,
                                "timestamp"         =>   1];
    
    private $pclockTable;
    
    private $usersTable;
    
    public function __construct($view,$action) {
        parent::__construct($this->actions);
        
        $this->pclockTable = new PlungerclockTable();
        $this->usersTable = new UserTable();
        
        $this->executeAction($action);
        
        $stamps = $this->pclockTable->getAllByUserId($_SESSION['user']['id']);
        $usr_wrk_stat = $this->isUserWorking();
        
        
        $users = $this->usersTable->getUsersByGroupId($_SESSION['user']['groups_id']);
        
        $this->assign('myself',$this->usersTable->getUserByUsername($_SESSION['user']['username']));
        $this->assign('users',$users);
        $this->assign('user_work_stat',$usr_wrk_stat);
        
        
        $this->display('templates/modules/plungerclock.tpl');
    }
    private function executeAction($action) {
        if($action != null && $action != '') {
            if(method_exists($this,"$action")) {
                $this->$action();
                return 1;
            } else 
                return 0;
        }
        
        return 1;
    }
    public function stamp() {
        if(isset($_POST['stamp'])) {
            $last_stamp_id = $this->pclockTable->getLastStatusByUserId($_SESSION['user']['id']);
            
            //toggle stamp because you can not come to work twice
            if($last_stamp_id == 0)
                $stamp_id = '1'; 
            elseif($last_stamp_id == 1)
                $stamp_id = '0';
            
            $this->pclockTable->insertStamp($_SESSION['user']['id'],$stamp_id);  
            echo '<script type="text/javascript">window.location="index.php?module=plungerclock"</script>';
        
        }
        
    }
    public function isUserWorking() {
        return $this->pclockTable->getLastStatusByUserId($_SESSION['user']['id']);
    }
    
    
}
    