<?php
/* 
 * @author Matthias Grotjohann
 */
require_once 'lib/user.table.db.php';
class RightsController {
    private $sessionController;
    private $userTable;
    
    public function __construct($sessionController,$debug = false) {
        $this->sessionController = $sessionController;
        $this->userTable = new UserTable();
        
        
    }
    public function isAuthenticated($userstatus) {
        
        if($userstatus == 1)
            return 1;
        return 0;
    }
    public function isModuleAllowed() {
          if($this->rights->isAuthenticated($_SESSION['user']['userstatus_id']) == 1) {
            $this->user   = $_SESSION['user'];
            if($_SESSION['user']['username'])
            $this->rights->updateLastSeen($_SESSION['user']['username']);
           }
    }
    public function isLoggedIn() {
          if(!$this->sessionController->getUser()) {
                echo "rightsController not logged in";
                die();
          } else 
                return true:
    }
    /*
    public function updateLastSeen($username) {
        $datestr = $this->userTable->updateLastSeen($username);
        $_SESSION['user']['lastseen'] = $datestr;
    }
    */
}