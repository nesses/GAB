<?php
require_once 'lib/table.db.php';
class ModulesTable extends DbTable {
	
    private $table = "modules";
	
    private $colNames   =  ["id",
                            "title",
                            "name",
                            "description",
                            "type_id"];
    
    
    public function __construct() {
        parent::__construct($this->table,$this->colNames);
    }
    
    public function getTitles() {
        $this->initTable(["title","name"]);
        return $this->asArray();
    }

    
}
?>

