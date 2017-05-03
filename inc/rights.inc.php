<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'lib/user.table.db.php';
class Rights {
    
    private $userTable;
    
    public function __construct() {
        $this->userTable = new UserTable();
        
    }
    public function isAuthenticated($userstatus) {
        if($userstatus == 1)
            return 1;
        return 0;
    }
    public function updateLastSeen($username) {
        $datestr = $this->userTable->updateLastSeen($username);
        $_SESSION['user']['lastseen'] = $datestr;
    }
}