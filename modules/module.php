<?php

/* 
 * @author Matthias Grotjohann
 */
class Module {
    
    private $error;
    
    private $controller;
    private $views;
    private $actions;
    private $params;
    private $values;
    
    private $default_values;
    
    public function __construct($controller) {        
        $this->controller = $controller;
        $this->controller->registerModuleActions($this->actions);
        $this->controller->registerModuleParameters($this->params);
        $this->controller->init($this->views[0]);
        
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
        //if now values in url use default vals 
        $this->values = $this->controller->fetchViewParams();
        if(!$this->values)
            $this->values = $this->default_values[$view];
        $this->$view();
    }
    public function setActions($actions) {
        $this->actions = $actions;
    }
    public function setViews($views) {
        $this->views = $views;
    }
    public function setValues($values) {
        $this->values = $values;
    }
    public function setViewParams($viewName,$params) {
        $this->params[$viewName] = $params;
        $this->controller->registerModuleParameters($this->params);
    }
    public function setParams($params) {
        $this->params = $params;
    }
    public function setDefaultValues($default) {
        $this->default_values = $default;
    }
    public function getValues() {
        return $this->values;
    }
    public function setError($error) {
        $this->error = $error;
    }
    public function getError() {
        return $this->error;
    }
}