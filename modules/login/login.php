<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'modules/login/LoginController.php';
require_once 'modules/module.php';
class Login extends Module {
    
    
    private $controller;
    
    private $views    = ['main'];
      
    private $actions  = ['main' => ['doLogin','doLogout']];
    
    private $params   = ['main' =>[]];
    
    public $default_view = 'main';
    
    public function __construct($sessionController) {
        $this->setViews($this->views);
        $this->setActions($this->actions);
        $this->setParams($this->params);
        $this->setDefaultValues($this->default_values);
        $this->controller = new LoginController($sessionController);
        parent::__construct($this->controller);
    }
    public function main() {
        $login = new SmartyLogin();
        $err = $this->getError();
        if($err)
            $login->enableAlert ('danger', $err);

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
    
    public function doLogout() {
        $this->userTable = new UserTable();
        $this->userTable->updateUserStatusId($this->controller->getSessionUser()['username'],2);
        $this->controller->destroySession();
        $this->controller->redirect('login','main');
    }
    


}





?>