<?php
require_once 'inc/conf.inc.php';
require_once 'lib/user.table.db.php';
require_once 'modules/module.mother.php';

class Login extends ModuleMother {
   
    private $userTable;
	
    private $gropsTable;

    private $action = ['doLogin','doLogout'];
    public function __construct($view,$action) {
        parent::__construct($this->action,$open_mod = true);
        
        if($action != null && $action != '') {
            try {
                $this->$action();
					
            } catch (Throwable $e) {
                $this->assign('error','Action defined but not in file :: '.$action);
            }
 	}
	$this->display('templates/modules/login.tpl');
    }
    public function doLogin() {
	$this->userTable = new UserTable();
        //does the user exists? 
        //If yes put userinformations in $userdata
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
                
                    echo '<script type="text/javascript">window.location="index.php?module=employees&view=listAll"</script>';
                }
                
            } else {
                $this->assign('error', 'Passwort falsch');
            }
        } else 
            //if username is not in table users
            $this->assign ('error', 'Benutzername nicht gefunden');
	}
    public function doLogout() {
        $this->userTable = new UserTable();
        $this->userTable->updateUserStatusId($_SESSION['user']['username'],2);
        session_unset();
        echo '<script type="text/javascript">window.location="index.php?module=login"</script>';
    }


}





?>
