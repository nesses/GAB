<?php
require_once 'lib/table.db.php';
class PlungerclockTable {

    private $db;
    
    private $table = "plungerclock";
	
    private $colNames   = ARRAY("id" ,
                                "users_id",
                                "timestamp");
  
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
    public function insertStamp($userid) {
        $date = date('Y-m-d h:i:s', time());
        echo $date;
        $this->db->insertRow(['users_id' => $userid,
                              'timestamp'=> $date]);
    }

}
?>