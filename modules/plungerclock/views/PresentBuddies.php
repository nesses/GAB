<?php

/* 
 * @
 */

class PresentBuddies extends Smarty {
    public function __construct() {
        parent::__construct();
   
    }
    public function init($buddies,$page,$pages) {
        $this->assign('buddies',$buddies);
        $this->assign('prvpage',$page-1);
        $this->assign('pages',$pages);
        $this->assign('page',$page+1);    
        $this->assign('nxtpage',$page+1);
    }
}