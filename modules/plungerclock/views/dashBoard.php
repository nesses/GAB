<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'modules/plungerclock/views/PresentBuddies.php';
require_once 'modules/plungerclock/views/WorktimeInfo.php';
class dashBoard  {
    
    public $presentBuddies;
    public $worktimeInfo;
    
    public function __construct() {
        $this->presentBuddies = new PresentBuddies();
        $this->worktimeInfo = new WorktimeInfo();
        
    }
    public function PresentBuddies() {
        return $this->presentBuddies;
    }
    public function WorktimeInfo() {
        return $this->worktimeInfo;
    }
    public function display() {
        $this->presentBuddies->display('templates/items/PresentBuddies.tpl');
        $this->worktimeInfo->display('templates/items/WorktimeInfo.tpl');
    }
    
    
}