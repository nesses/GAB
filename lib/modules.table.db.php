<?php
require_once 'lib/table.db.php';
class ModulesTable {
	
    private $db;
    private $table = "modules";
	
    private $colNames   =  ["id",
                            "title",
                            "name",
                            "description",
                            "type_id"];
    
    
    public function __construct() {
    
        $this->db = new DbTable($this->table,$this->colNames);
    
    }
    
    public function getTitles() {
        $this->db->initTable(["title","name"]);
        return $this->db->asArray();
    }

    
}
?>

