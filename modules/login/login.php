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
        //$this->parameters = $this->controller->fetchParams();
        if(!$this->controller->getError()) {
            if($this->controller->hasAction()) {
                $this->executeCommand();
            } 
            $this->initView ();
        } else 
            echo $this->controller->getError();
  
    }
    private function executeCommand() {
        
        $command=$this->controller->getActionCommand();
        $this->$command();
        if(!$this->getError())
            $this->controller->redirect();
    
    }
    private function initView() {
        $view = $this->controller->getView();
        $this->$view();
    }
    public function main() {
        $login = new SmartyLogin();
        echo $this->getError();

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
                $this->setError('Passwort falsch');
            }
        } else 
            //if username is not in table users
            $this->setError ('Benutzername nicht gefunden');

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