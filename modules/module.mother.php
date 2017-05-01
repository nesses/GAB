<?php
require_once 'lib/user.table.db.php';
class ModuleMother extends Smarty {

    private $userTable;

    public function __construct() {
        parent::__construct();
        $this->userTable = new UserTable();
        if($this->isAuthenticated() == 1 ) {
            $this->updateLastSeen();
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