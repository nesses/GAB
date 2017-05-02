<?php

require_once 'lib/user.table.db.php';
require_once 'lib/modules.table.db.php';

class ModuleMother extends Smarty {
    
    private $userTable;

    public function __construct($actions,$open_mod=false) {
        parent::__construct();
        
        if($_SESSION['action'] && !in_array($_SESSION['action'],$actions)) {
            $_SESSION['action'] = NULL;
            $this->assign('error','No such action '.$_SESSION['action']);
            $this->display('templates/error.tpl');
            die;
            
        } elseif ($_SESSION['action'] && !$_POST) {
            $_SESSION['action'] = NULL;
            $this->assign('error','No such action :: '.$actions);
            $this->display('templates/error.tpl');
            
        } else {
            if(!$open_mod) {
                $this->userTable = new UserTable();
                if($this->isAuthenticated() == 1 ) {
                    $this->updateLastSeen();
                } else {
                    $this->assign('error',"Keine Berechtigung :: Nicht angemeldet");
                    $this->display('templates/error.tpl');
                    die;
                }

            }
        }
    }
    public function isAuthenticated() {
        if($_SESSION['user']['userstatus_id'] == 1)
            return 1;
        return 0;
    }
    private function updateLastSeen() {
        $datestr = $this->userTable->updateLastSeen($_SESSION['user']['username']);
        $_SESSION['user']['lastseen'] = $datestr;
    }
}

?>