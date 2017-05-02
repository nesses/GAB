<?php
require_once 'lib/table.db.php';
class PlungerclockTable {

    private $db;
    
    private $table = "plungerclock";
	
    private $colNames   = ARRAY("id" ,
                                "user_id",
                                "timestamp");
  
    public function __construct() {
        $this->db = new DbTable($this->table,$this->colNames);
    }
    public function getAll() {
        $this->db->initTable();
        $tdata = $this->db->asArray();
        return $tdata;
    }   
}
?>