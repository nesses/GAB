<?php
/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
require_once 'RightsController.php';
require_once 'modules/system/Navigation.php';
require_once "lib/smarty-3.1.30/libs/Smarty.class.php";
require_once "inc/logger.php";

class GAB  {
    private $debug = false;
    
    private $navigation;
    private $sessionController;
    private $rightsController;
    
    private $module;
    
    
    public function __construct($debug=false) {
        //GABLogger::debug(__FUNCTION__);
        $this->debug = $debug;
        $this->sessionController = new SessionController($debug);
        $this->module = $this->sessionController->getModule();
        
    }
    public function HORIDO() {
        
        $this->showNavigation($this->module);
        
        //is user logged in
        if($this->sessionController->isLoggedIn() || $this->sessionController->isOpenModule()) {
              if($this->testModuleFile($this->sessionController->getModule())) {
                  require_once 'modules/'.$this->module.'/'.$this->module.'.php';
                  if(class_exists($this->module)) {
                      $gab_module = new $this->module($this->sessionController);
                      
                  } //else
                      //$this->smarty->assign('msg',$this->module.'::Module File eixsts but Class is not there');
              } else {
                  $this->navigation->enableAlert('danger','No such module :: '.$this->module);
                  
              }
          } else 
                $this->navigation->enableAlert('danger',"Zutritt verweigert!!! Nicht angemeldet");
            $this->navigation->display('templates/footer.tpl');
            
            print_r($_SESSION);
    }
    private function testModuleFile($module) {
        return is_file('modules/'.$module.'/'.$module.'.php');
    }
    private function showNavigation($module) {
        $dbModules = new ModulesTable();
        $modTitles = $dbModules->getTitles('keyval');
        $user = $this->sessionController->getUser();
        
        $this->navigation = new Navigation();
        $this->navigation->setItems($modTitles);
        $this->navigation->setActiveItem($module);
        if($user)
            $this->navigation->enableLogin (true);
        
       $this->navigation->show();
    }
}