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
    
    private $module;
    
    
    public function __construct($debug=false) {
        $this->debug = $debug;
        $this->sessionController = new SessionController($this->restricted,$debug);
        $this->module = $this->sessionController->getModule();
        $this->action = $this->sessionController->getAction();
        $this->view   = $this->sessionController->getView();
        
        if($debug)
            echo "<b>[[[DEBUG]]]</b><br><b>- [GAB] -</b><br>Module: $this->module<br>View: $this->view<br>Action: $this->action";
        //$this->sessionController->init();
        
    }
    public function HORIDO() {
        
        $this->showNavigation($this->module);
        if($this->testModuleFile($this->sessionController->getModule())) {
            require_once 'modules/'.$this->module.'/'.$this->module.'.php';
            if(class_exists($this->module)) {
                $gab_module = new $this->module($this->sessionController,$this->smarty,$this->debug);
                $gab_module->show();
            } else
                $this->smarty->assign('error',$this->module.'::Module File eixsts but Class is not there');
        } else {
            $this->smarty->assign('error','No such module :: '.$this->module);
        }

        $this->smarty->display('templates/footer.tpl');
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
