<?php
/* 
 * @author Matthias Grotjohann
 */
require_once 'lib/user.table.db.php';
require_once 'lib/modules.table.db.php';
class RightsController {    
    
    private $modulesTable;
    private $userTable;
    
    public function __construct() {
        $this->userTable = new UserTable();
        $this->modulesTable = new ModulesTable();
    }
    public function isLoggedIn() {
          if(!$this->getUser()) {
                return false;     
          } else 
                return true;
    }
    public function amIROOT() {
        $rights = $this->userTable->getRightsId($this->getUser()['id']);
        if($rights == 1)
            return true;
        else return false;
    }
    public function amIAllowed() {
        if($this->isOpenModule())
            return true;
        else {
            if($this->getModule() == 'plungerclock' && $this->isLoggedIn())
                return true;
            if($this->getModule() == 'employees' && $this->isLoggedIn())
                return true;
            
        }
        
    }
    public function isOpenModule() {
          
        $mod_info = $this->modulesTable->getModuleInfo($this->getModule());
        
        if($mod_info['type_id'] == 1)
            return true;
        
    }
    public function getError() {
        return $this->error;
    }
    /*
    public function updateLastSeen($username) {
        $datestr = $this->userTable->updateLastSeen($username);
        $_SESSION['user']['lastseen'] = $datestr;
    }
    */
}