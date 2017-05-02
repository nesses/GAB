<?php
require_once 'lib/table.db.php';
class RightsTable {

    private $db;
    
    private $table = "rights";
	
    private $colNames   = ARRAY("id" ,
                                "title",
                                "description");
  
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