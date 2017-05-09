<?php
/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
require_once 'RightsController.php';
require_once "lib/smarty-3.1.30/libs/Smarty.class.php";
require_once "inc/logger.php";

class GAB  {
    private $debug = false;
    
    private $smarty;
    private $sessionController;
    private $rightsController;
    
    private $module;
    
    
    public function __construct($debug=false) {
        //GABLogger::debug(__FUNCTION__);
        $this->debug = $debug;
        $this->sessionController = new SessionController($debug);
        $this->module = $this->sessionController->getModule();
        $this->rightsController = new RightsController($this->sessionController,$debug);
        
        
        //$log::debug("test");
    }
    public function HORIDO() {
        
        $this->showNavigation($this->module);
        
        //is user logged in
        if($this->sessionController->isLoggedIn() || $this->sessionController->isOpenModule()) {
              if($this->testModuleFile($this->sessionController->getModule())) {
                  require_once 'modules/'.$this->module.'/'.$this->module.'.php';
                  if(class_exists($this->module)) {
                      $gab_module = new $this->module($this->sessionController,$this->rightsController,$this->smarty,$this->debug);
                      //$this->smarty->assign('msg',$gab_module->getError());
                      //$gab_module->show();
                  } else
                      $this->smarty->assign('msg',$this->module.'::Module File eixsts but Class is not there');
              } else {
                  $this->smarty->assign('msg','No such module :: '.$this->module);
              }
          } else 
                echo "Not logged in";
            $this->smarty->display('templates/error.tpl');
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