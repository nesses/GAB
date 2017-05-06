<?php

/* 
 * @
 */

class PresentBuddies extends Smarty {
    private $offset = 5;
    public function __construct() {
        parent::__construct();
    }
    public function init() {
        $this->assign('buddies',$buddies);
    }
    public function setBuddies($buddies) {
        
        
        $this->assign('buddies',$buddies);
        
    }
    public function setPage($page,$pages) {
        
        $this->assign('pages',$pages);
        $this->assign('page',$page+1);
        $this->assign('prvpage',$page-1);
        $this->assign('nxtpage',$page+1);
    
        
    }
    public function getOffset() {
        return $this->offset;
    }
}