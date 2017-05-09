<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'modules/login/LoginController.php';
class Login {
    
    private $error;
    
    private $controller;
    
    private $views    = ['main'];
      
    private $actions  = ['main' => ['doLogin','doLogout']];
    
    public $default_view = 'main';
    
    public function __construct($sessionController) { 
        GABLogger::debug(__CLASS__);
        $this->controller = new LoginController($sessionController);
        $this->controller->registerModuleActions($this->actions);
        $this->controller->init($this->views[0]);
        if(!$this->controller->getError()) {
            $a_command=$this->controller->getActionCommand();
            if($a_command)
                $this->$a_command();
            
            
        } else 
           echo $this->controller->getError();
        if(!$this->controller->getError()) {
            $v_command = $this->controller->getView();
            $this->$v_command();
        }
    }
    public function main() {
        $login = new SmartyLogin();
        
        //if($this->getError()) {
        //    $login->assign('msg',$this->getError());
            
            
        //}
        
        $login->show();
       
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
                    $this->controller->setSessionUser($userdata[0]);
                    $this->controller->redirect('employees','ListView');
                }  
            } else {
                echo 'Passwort falsch';
            }
        } else 
            //if username is not in table users
            echo 'Benutzername nicht gefunden';

    }
    private function setError($error) {
        $this->error = $error;
    }
    public function getError() {
        return $this->error;
    }
    public function doLogout() {
        $this->userTable = new UserTable();
        $this->userTable->updateUserStatusId($this->controller->getSessionUser()['username'],2);
        $this->controller->destroySession();
        $this->controller->redirect('login','main');
    }
    


}





?>