<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'lib/table.db.php';
class PlungerclockTable {

    private $db;
    
    private $table = "plungerclock";
	
    private $colNames   = ARRAY("id" ,
                                "users_id",
                                "timestamp",
                                "status_id");
  
    public function __construct() {
        $this->db = new DbTable($this->table,$this->colNames);
    }
    public function getAll() {
        $this->db->initTable();
        $tdata = $this->db->asArray();
        return $tdata;
    }
    public function getStamps($userid,$date='',$status_id='') {
        if($date <> '')
            $where = " and timestamp > '$date' and timestamp < '".date("Y-m-d", strtotime("$date") + (3600 * 24))."'";
        
        if($status_id <> '')
            $where .= " and status_id = '$status_id' ";
        //echo $where;
        $this->db->initTable('timestamp',"users_id = '$userid'".$where);
        $tdata = $this->db->asArray();
        return $tdata;
    }
    public function insertStamp($userid,$status_id) {
        $date = date('Y-m-d H:i:s',time());
        
        $this->db->insertRow(['users_id' => $userid,
                              'timestamp'=> $date,
                              'status_id'=> $status_id]);
    }
    public function getLastStatusByUserId($userid,$date = '') {
        
        if($date)
            $where = " and timestamp > '$date' and timestamp < '".date("Y-m-d", strtotime("$date") + (3600 * 24))."'";
        $this->db->initTable('status_id',"users_id = '$userid'".$where,'timestamp desc','0,1');
        $tdata = $this->db->asArray();
        return $tdata[0]['status_id'];
    }
    

}
?>