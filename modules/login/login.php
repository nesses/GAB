<?php
require_once 'inc/conf.inc.php';
require_once 'lib/user.table.db.php';

class Login extends Smarty {
    
    private $userID = null;
    
    private $userTable;
	
    private $gropsTable;
	
    public function __construct($view,$action) {
        parent::__construct();
        $this->userTable = new UserTable();
        if($action != null && $action != '') {
            try {
                $this->$action();
					
            } catch (Throwable $e) {
                $this->assign('error','No such action :: '.$action);
            }
 	}
	$this->display('templates/modules/login.tpl');
    }
    public function doLogin() {
			  $userdata = $this->userTable->getUserByUsername($_POST['username']);
			  print_r($userdata);die;
            if($_SESSION['user']['userstatus_id'] == 1 ) {
                echo '<script type="text/javascript">window.location="index.php?module=employees&view=listAll"</script>';
            }
	}
    public function doLogout() {
        $this->initUser(null,$_SESSION['user']['id']);
        $this->unauthorize();
        session_unset();
        echo '<script type="text/javascript">window.location="index.php?module=login"</script>';
    }
	
    public function isAdmin() {
        if($rights[0] == 999) return true;
        return false;
    }
    public function authorize($password) {
        if($this->userTable->getMD5Password() == md5($password)) {
            
			$this->userTable->setStatus('1');
			
            $this->updateUser();
            return 1;
        } 
        $this->userTable->setStatus('0');
		return 0;
    }
    public function unauthorize() {
        $this->userTable->setStatus('0');
		 $this->updateUser();
	}
	public function initUser($username,$userID) {
        if($userID == null && $username != null) {
            if($this->userTable->loadRow('username',$username)==1) {
                $this->userID = $this->userTable->getUserID();
					return 1;
            }
        } elseif ($username == null && $userID != null) {
            if($this->userTable->loadRow('id',$userID) == 1) {
                $this->userID = $userID;
					return 1;
            }
        } else {}
        return 0;
    }
    public function updateUser() {
        if($this->userID != null) {
            $this->userTable->storeRow($this->userID);
            return true;
        } return null;
    }

}





?>