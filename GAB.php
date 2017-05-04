<?php
/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
require_once "lib/smarty-3.1.30/libs/Smarty.class.php";

class GAB  {
    private $debug = false;

    //everyone can see this
    private $restricted = true;
    private $smarty;
    private $sessionController;
    
    
    public function __construct($debug=false) {
        $this->sessionController = new SessionController($this->restricted,$debug);
        $this->sessionController->init();
        
    }
    public function HORIDO() {
        $module = $this->sessionController->getModule();
        $action = $this->sessionController->getAction();
        $view   = $this->sessionController->getView();
        
        $this->showNavigation($module);
        if($this->testModuleFile($this->sessionController->getModule())) {
            require_once 'modules/'.$module.'/'.$module.'.php';
            if(class_exists($module)) {
                $gab_module = new $module($view,$action);
                $gab_module->show();
            } else
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
        $user = $this->sessionController->getUser();
        
        $this->smarty = new Smarty();
        $this->smarty->assign('modTitles',$modTitles);
        $this->smarty->assign('module',$module);
        $this->smarty->assign('user',$user);
        
        $this->smarty->display('templates/navigation.tpl');
    }
}
