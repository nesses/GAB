<?php
require_once 'lib/table.db.php';
class UserTable extends DbTable {
	
    private $userID;
	
    private $table = "users";
	
    private $colNames   =  ["id",
                            "username",
                            "password",
                            "name",
                            "surname",
                            "rights_id",
                            "groups_id",
                            "creator_id",
                            "created",
                            "alterer_id",
                            "userstatus_id"];
    
     
    
    private $colTypes =   [ 'id'            =>  'int',
                            'username'      =>  'text',
                            'password'      =>  'password',
                            'name'          =>  'text',
                            'surname'       =>  'text',
                            'groups_id'      =>  'combobox',
                            'rights_id'     =>  'combobox',
                            'creator_id'    =>  'int',
                            'created'       =>  'timestamp',
                            'alterer_id'    =>  'int',
                            'userstatus_id' =>  'int'];
    
    
    public function __construct() {
        parent::__construct($this->table,$this->colNames);
    }
    


    
}
?>

