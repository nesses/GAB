<?php

require_once 'modules/employees/EmployeesController.php';
class employees {
    
    private $controller;
    
    private $error;
   
    
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
    
    private $actions        = ['ListView' => []];
    private $params         = ['ListView' => ['page','offset','orderby']];


    private $views          = ['ListView'];
    
    private $values;
    
    public function __construct($sessionController) {        
        $this->controller = new EmployeesController($sessionController);
        $this->controller->registerModuleActions($this->actions);
        $this->controller->registerModuleParameters($this->params);
        $this->controller->init($this->views[0]);
        $this->values = $this->controller->fetchViewParams();
        print_r($this->values);
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
    public function ListView() {
        $userTable = new UserTable();
        $listView = new ListView($this->fieldVisibility,$this->fieldTitles);
        $listView->setModule($this->controller->getCurrentModule());
       
        //get offset from url($_GET need to be registered in
        //employee.php)
        $offset=$this->values['offset'];
        if(!$offset) {
            $offset = $listView->getOffset(); 
        }
        $page=$this->values['page'];
        $listView->setPage($page);
       
        $listView->setOffset($offset);
      
        $orderby=$this->values['orderby'];
        
        $index = $page-1;
        if($index < 0)
            $index = 0;
        $index = "".$index*$offset."";
        
        $size = $userTable->countAll();
        $pageCount = ceil($size/$offset);
        
        $listView->setPageCount($pageCount);
        
        
        $content = $userTable->getAllJoined($index,$offset,$orderby);
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