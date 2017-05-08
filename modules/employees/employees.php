<?php

require_once 'modules/employees/EmployeesController.php';
class employees {
    
    private $controller;
    
   
   
    private $usersTable;
    private $groupsTable;
    
    private $fieldVisibility = ["id"                =>  1,
                                "username"          =>  1,
                                "password"          =>  0,
                                "name"              =>  1,
                                "surname"           =>  1,
                                "lastseen"          =>  1,
                                "rights_id"         =>  1,
                                "groups_id"         =>  1,
                                "creator_id"        =>  1,
                                "created"           =>  0,
                                "alterer_id"        =>  0,
                                "userstatus_id"     =>  1];    
    
    private $fieldTitles =  [   'id'            =>  'ID',
                                'username'      =>  'Benutzername',
                                'password'      =>  'Password',
                                'name'          =>  'Name',
                                'surname'       =>  'Vorname',
                                'lastseen'      =>  'Zuletzt',
                                'groups_id'     =>  'Gewerk',
                                'rights_id'     =>  'Rechte',
                                'creator_id'    =>  'Ersteller',
                                'created'       =>  'Erstellt',
                                'alterer_id'    =>  'Bearbeiter',
                                'userstatus_id' =>  'Status'];
    
    private $actions        = ['ListView' => ['page','offset','orderby']];
    
    private $views          = ['ListView'];
    
    private $default_view   = 'ListView';
    
    public function __construct($sessionController) {        
        $this->controller = new EmployeesController($sessionController);
        $this->controller->registerModuleActions($this->actions);
        $this->controller->init($this->views[0]);
        if(!$this->controller->getError()) {
            $command=$this->controller->getActionCommand();
        
            if(!$command)
                $command = $this->controller->getViewCommand();
            $this->$command();
        } else echo "Error gefunden !!!!!!!:::!:!::!::!::::".$this->controller->getError();
  
    }
    public function ListView() {
        $listView = new ListView($this->fieldVisibility,$this->fieldTitles);
        $listView->setModule($this->sessionController->getCurrentModule());
        
        $this->sessionController->fetchParams();
        
        //get offset from url($_GET need to be registered in
        //employee.php)
        $offset=$this->sessionController->getParams()['offset'];
        
        if(!$offset) {
            $offset = $listView->getDefaultOffset(); 
        }
        $listView->setOffset($offset);
        
        $page=$this->sessionController->getParams()['page'];
        $listView->setPage($page);
         
        $orderby=$this->sessionController->getParams()['orderby'];
        
        $index = $page-1;
        $index = "".$index*$offset."";
        
        $size = $this->usersTable->countAll();
        $pageCount = ceil($size/$offset);
        
        $listView->setPageCount($pageCount);
        
        
        
        
        
        
        
        $content = $this->usersTable->getAllJoined($index,$offset,$orderby);
        //print_r($content); 
        $listView->setContent($content);
        
        $listView->show();
    }
    public function editView() {
        echo "editView";
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
?>