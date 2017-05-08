<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SmartyLogin extends Smarty {
    
    private $error;
    
    public function __construct() {
        parent::__construct();
    }
    public function setError($txt) {
        $this->error = $txt;
    }
    public function show() {
        if($this->error)
            $this->assign('error',$this->error);
        $this->display('templates/modules/login.tpl');
    }
}