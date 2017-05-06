<?php
/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
require_once 'RightsController.php';
require_once "lib/smarty-3.1.30/libs/Smarty.class.php";

class GAB  {
    private $debug = null;

    private $smarty;
    private $sessionController;
    //private $rightsController;
    
    private $module;
    
    
    public function __construct($debug=false) {
        $this->debug = $debug;
        $this->sessionController = new SessionController($debug);
        $this->module = $this->sessionController->getModule();
        $this->action = $this->sessionController->getAction();
        $this->view   = $this->sessionController->getView();
        //$this->rightsController = new RightsController($this->sessionController,$debug);
        if($debug)
            echo "<b>[[[DEBUG]]]</b><br><b>- [GAB] -</b><br>Module: $this->module<br>View: $this->view<br>Action: $this->action";
        
        
    }
    public function HORIDO() {
        require_once 'modules/system/GabError.php';
        
        $error = new GabError();
        $this->showNavigation($this->module);
        //is user logged in
        if($this->sessionController->isOpenModule() || $this->sessionController->isLoggedIn()) {
              
            if($this->testModuleFile($this->sessionController->getModule())) {
                  require_once 'modules/'.$this->module.'/'.$this->module.'.php';
                  if(class_exists($this->module)) {
                      $gab_module = new $this->module($this->sessionController,$this->debug);
                      //$gab_module->show();
                  } else {
                      $error->setMsg($this->module.'::Module File eixsts but Class is not there');
                      $error->show();
                  }
              } else {
                  $error->setMsg('No such module :: '.$this->module);
                  $error->show();
              }
          } else {
                $error->setMsg("Nicht angemeldet");
                $error->show();                
          }
    }
    private function testModuleFile($module) {
        return is_file('modules/'.$module.'/'.$module.'.php');
    }
    private function showNavigation($module) {
        $dbModules = new ModulesTable();
        $modTitles = $dbModules->getTitles('keyval');
        $user = $this->sessionController->getUser();
        
        $this->smarty = new Smarty();
        $this->smarty->assign('modTitles',$modTitles);
        $this->smarty->assign('module',$module);
        $this->smarty->assign('user',$user);
        
        $this->smarty->display('templates/navigation.tpl');
    }
}