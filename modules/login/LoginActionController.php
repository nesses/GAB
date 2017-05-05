<?php

/* 
 * @author Matthias Grotjohann
 */
require 'ActionController.php';
require_once 'lib/user.table.db.php';
class LoginActionController extends ActionController {
    private $sessionController;
    
    private $actions = ['doLogin','doLogout'];
    
    private $error;
    
    public function __construct($sessionController,$debug) {
        if($debug)
            echo "<br><b>[DBG]LoginActionController</b>";
        $this->sessionController = $sessionController;
        parent::__construct($sessionController,$this->actions);
    
        
    }
    public function doLogin() {
	$this->userTable = new UserTable();
        
        $userdata = $this->userTable->getUserByUsername($_POST['username']);
	if($userdata) {
            if($userdata[0]['password'] == md5($_POST['password'])) {
                $_SESSION['user'] = $userdata[0];
                //if user logs in first time redirect
                //  to update self
                //else show Main 
                if($_SESSION['user']['userstatus_id'] == 4)
                    echo '<script type="text/javascript">window.location="index.php?module=employees&view=listAll"</script>';
                else {
                    $this->userTable->updateUserStatusId($userdata[0]['username'],1);
                    $this->userTable->updateLastSeen($userdata[0]['username']);
                    //update session after successful login
                    $userdata = $this->userTable->getUserByUsername($_POST['username']);
                    $_SESSION['user'] = $userdata[0];
                
                    echo '<script type="text/javascript">window.location="index.php?module=plungerclock"</script>';
                }
                
            } else {
                
                $this->error='Passwort falsch';
            }
        } else 
            //if username is not in table users
            $this->error = 'Benutzername nicht gefunden';
    }
    public function getError() {
        return $this->error;
    }
    public function doLogout() {
        $this->userTable = new UserTable();
        $this->userTable->updateUserStatusId($_SESSION['user']['username'],2);
        session_unset();
        
        echo '<script type="text/javascript">window.location="index.php?module=login"</script>';
    }
    
}

