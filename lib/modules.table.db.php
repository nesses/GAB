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
    
    public function getTitles($mode = 'normal') {
        
        $this->db->initTable(["title","name"]);
        if($mode == 'normal')
            $ret = $this->db->asArray();
	elseif($mode == 'keyval') {
            foreach($this->db->asArray() as $idx => $valArr) {
                
                $ret[$valArr['name']] = $valArr['title'];
            }
	}
        
	return $ret;
    }

    
}
?>

