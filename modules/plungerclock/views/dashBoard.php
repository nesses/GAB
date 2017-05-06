<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'modules/plungerclock/views/PresentBuddies.php';
class dashBoard  {
    
    public $presentBuddies;
    
    public function __construct() {
        $this->presentBuddies = new PresentBuddies();
        
        
        
        //$stamps = $this->pclockTable->getAllByUserId($this->sessionController->getUser()['id']);
        
    }
    public function initPresentBuddies($buddies,$page,$pages) {
        $this->presentBuddies->assign('buddies',$buddies);
        $this->presentBuddies->assign('prvpage',$page-1);
        $this->presentBuddies->assign('pages',$pages);
        $this->presentBuddies->assign('page',$page+1);    
        $this->presentBuddies->assign('nxtpage',$page+1);
    }
    public function display($param) {
        $this->presentBuddies->display($param);
    }
    public function getPresentBuddies() {
        return $this->presentBuddies;
    }
    
}