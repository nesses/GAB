<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SmartyLogin extends Smarty {
    
    private $alert;
    
    public function __construct() {
        parent::__construct();
    }
    public function enableAlert($type,$message) {
        $this->alert = new Alert();
        $this->alert->setType($type);
        $this->alert->setMessage($message);
        $this->alert->show();
    }
    public function show() {
        
        //$this->display('templates/modules/login.tpl');
    }
}