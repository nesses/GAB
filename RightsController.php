<?php
/* 
 * @author Matthias Grotjohann
 */
require_once 'lib/user.table.db.php';
require_once 'lib/modules.table.db.php';
class RightsController {    
    private $error;
    
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
    public function getRightsError() {
        return $this->error;
    }
    //NÖÖÖÖÖÖÖÖÖÖÖÖÖÖÖÖÖÖÖÖÖÖÖÖÖÖT
    //FOR NOW THIS CHECKS ONLY THE MOD RIGHTS:::
    //Maybe rename and make new for views actions items ===!==
    public function amIAllowed($action = null) {
        
        if($this->isOpenModule()) {
            if($this->getModule() == 'login' && $this->isLoggedIn() && !$action) {
                GABLogger::debug("Debied!");
                $this->error = "BEREITS ANGEMELDET";
                return false;
            }
            GABLogger::debug("OpenMod Granted");
            return true;
        }
            
        else {
            if($this->getModule() == 'plungerclock' && $this->isLoggedIn())
                return true;
            if($this->getModule() == 'employees' && $this->isLoggedIn())
                return true;
            if($this->getModule() == 'login' && $this->isLoggedIn())
                return false;
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