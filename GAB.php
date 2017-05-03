<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
require_once "lib/smarty-3.1.30/libs/Smarty.class.php";

class GAB  {
    private $restricted = true;
    private $smarty;
    private $sessionController;
    
    
    public function __construct() {
        $this->sessionController = new SessionController($actions, $this->restricted);
    }
    public function HORIDO() {
        $module = $this->sessionController->getModule();
        $this->showNavigation($module);
        if($this->testModuleFile($this->sessionController->getModule())) {
            require_once 'modules/'.$module.'/'.$module.'.php';
            if(class_exists($module))
                $gab_module = new $module($view,$action);
            else
                $this->smarty->assign('error',$module.'::Module File eixsts but Class is not there');
        } else {
            $this->smarty->assign('error','No such module :: '.$module);
        }

        $this->smarty->display('templates/footer.tpl');
    }
    private function testModuleFile($module) {
        return is_file('modules/'.$module.'/'.$module.'.php');
    }
    private function loadModule($moduletitle) {
        if($this->testModuleFile($moduletitle)) {
            
            return true;
        } else
            return false;
            
    }
    private function showNavigation($module) {
        $dbModules = new ModulesTable();
        $modTitles = $dbModules->getTitles('keyval');
        
        $this->smarty = new Smarty();
        $this->smarty->assign('modTitles',$modTitles);
        $this->smarty->assign('module',$module);
        $this->smarty->display('templates/navigation.tpl');
    }
}
