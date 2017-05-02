<?php
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
    public function getAllByUserId($id) {
        $this->db->initTable('*',['users_id',$id]);
        $tdata = $this->db->asArray();
        return $tdata;
    }
    public function insertStamp($userid,$status_id) {
        $date = date('Y-m-d h:i:s', time());
        
        $this->db->insertRow(['users_id' => $userid,
                              'timestamp'=> $date,
                              'status_id'=> $status_id]);
    }
    public function getLastStatusByUserId($userid) {
        $this->db->initTable('status_id',['users_id',$userid],'timestamp desc','0,1');
        $tdata = $this->db->asArray();
        
        return $tdata[0]['status_id'];
    }
    

}
?>