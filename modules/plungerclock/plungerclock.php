<?php

/*** 
 * @author Matthias Grotjohann
 */
require_once 'modules/module.mother.php';
require_once 'lib/plungerclock.table.db.php';   
class plungerclock extends ModuleMother {
    
    private $actions = ['stamp'];
    
    private $fieldVisibility = ["id"                =>   1,
                                "users_id"           =>  1,
                                "timestamp"         =>   1];
    
    private $pclockTable;
    
    private $usersTable;
    
    public function __construct($view,$action) {
        parent::__construct($this->actions);
        $this->pclockTable = new PlungerclockTable();
        $stamps = $this->pclockTable->getAllByUserId($_SESSION['user']['id']);
        $this->usersTable = new UserTable();
        $users = $this->usersTable->getUsersByGroupId($_SESSION['user']['groups_id']);
        
        print_r($users);
        $this->executeAction($action);
        
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
        
        $this->pclockTable->insertStamp($_SESSION['user']['id']);
        $_SESSION['action'] = null;
        echo '<script type="text/javascript">window.location="index.php?module=plungerclock"</script>';
        
    }
    
    
}
    