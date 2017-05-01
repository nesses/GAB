<?php
require_once 'lib/table.db.php';
class UserTable  {
	
    private $db;
	
    private $table = "users";
	
    private $colNames   =  ["id",
                            "username",
                            "password",
                            "name",
                            "surname",
                            "lastseen",
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
                            'lastseen'      =>  'datetime',
                            'groups_id'      =>  'combobox',
                            'rights_id'     =>  'combobox',
                            'creator_id'    =>  'int',
                            'created'       =>  'timestamp',
                            'alterer_id'    =>  'int',
                            'userstatus_id' =>  'int'];
    
    
    public function __construct() {
        $this->db = new DbTable($this->table,$this->colNames);
    }
    public function getUserByUsername($username) {
        
        $this->db->initTable($this->colNames, ['username',$username]);
        $tdata = $this->db->asArray();
        return $tdata;
    }
    public function updateUserstatusId($username,$int) {
        $this->db->updateTable(['userstatus_id' => $int],['username',$username]);
    }
    public function updateLastSeen($username) {
        $date = new DateTime("now");
        $this->db->updateTable(['lastseen' => $date->format('Y-m-d H:i:s')],['username',$username]);
    
    }


    
}
?>

