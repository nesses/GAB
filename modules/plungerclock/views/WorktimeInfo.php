<?php

/* 
 * @author Matthias Grotjohann
 */

class WorktimeInfo extends Smarty {

    public function __construct() {
        parent::__construct();
        $this->assign('stampButton','enabled');
        $this->assign('forgetInfo','disabled');
        
    }
    public function init($status,$commingstamps,$goingstamps,$times,$summary) {
        $this->assign('status',$status);
        $this->assign('stampscount',sizeof($commingstamps));
        $this->assign('commingstamps',$commingstamps);
        $this->assign('goingstamps',$goingstamps);
        $this->assign('times',$times);
        $this->assign('summary',$summary);
        
    }
    public function disableStampButton() {
        $this->assign('stampButton','disabled');
    }
    public function enableForgetInfo() {
        $this->assign('forgetInfo','enabled');
    }
}
