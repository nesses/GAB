<?php

/* 
 * @author Matthias Grotjohann
 */
class GabError extends Smarty {
    
    public function __construct() {
        parent::__construct();   
    }
    public function setType($type) {
        $this->assign('type',$type);
    }
    public function setMsg($msg) {
        $this->assign('msg',$msg);
    }
    public function show() {
        $this->display('templates/error.tpl');
    }
    
}

