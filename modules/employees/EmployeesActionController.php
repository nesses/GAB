<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'ActionController.php';
require_once 'lib/user.table.db.php';
class EmployeesActionController extends ActionController {
    private $userTable;
    private $actions = ['save'];
    public function __construct($action) {
       
        parent::__construct($action,$this->actions);
    }
        public function save() {
        $this->userTable=new UserTable();
        
        if(isset($_POST['_action'])) {
            unset($_POST['_action']);
            unset($_POST['id']);
            $_POST['creator_id'] = $_SESSION['user']['id'];
            $_POST['alterer_id'] = $_SESSION['user']['id'];
            $_POST['password'] = md5($_POST['password']);
            $_POST['userstatus_id'] = 4;
            $date = new DateTime('now');
            $date->format('Y-m-d H:i:s');
            $_POST['created'] = $date->format('Y-m-d H:i:s');

            $this->userTable->addUser($_POST);
            $_SESSION['action'] = null;
        }
        
        echo '<script type="text/javascript">window.location="index.php?module=employees&view=listAll"</script>';
                
        
        
    }
    
}