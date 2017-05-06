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
    
    public function setStatus($status) {
        $this->assign("status",$status);
    }
    public function setToday($today) {
        $this->assign('today',$today);
    }
    public function setStamps($comming,$going) {
        $this->assign('commingstamps',$comming);
        $this->assign('goingstamps',$going);
        $this->assign('stampscount',sizeof($comming));
        foreach($comming as $nr => $stamp) {
            if($going[$nr]['timestamp']) {
                $secs_between = strtotime($going[$nr]['timestamp'])-strtotime($stamp['timestamp']);
                $today_secs += $secs_between;
                $times[$nr] = date('H:i:s',strtotime("1970/1/1")+$secs_between);
            
            }
        }
        if(sizeof($comming) > sizeof($going)) {
            $today_secs += strtotime(date('H:i:s'))-strtotime($comming[sizeof($comming)-1]['timestamp']);
            $this->assign("status",1);
        }
        $this->assign('summary',date('H:i:s',strtotime("1970/1/1")+$today_secs));
        //$summary_time = date('H:i:s',strtotime("1970/1/1")+$today_secs);
    }
    //public function setTimeSummary($time) {
      //  $this->assign('summary',$time);
    //}
    public function disableStampButton() {
        $this->assign('stampButton','disabled');
    }
    public function enableForgetInfo() {
        $this->assign('forgetInfo','enabled');
    }
}
