<?php
/*
 * @author Matthias Grotjohann
 */
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
    
    private $links      =  ['rights_id' => ['rights' => 'title'],
                            'groups'    => ['groups' => 'title'],
                            'creator_id'=> ['users'  => 'username'],
                            'alterer_id'=> ['users'  => 'username']];
    
    
    public function __construct() {
        $this->db = new DbTable($this->table,$this->colNames);
    }
    public function getUserByUsername($username) {
        
        $this->db->initTable($this->colNames, ['username',$username]);
        $tdata = $this->db->asArray();
        return $tdata;
    }
    public function getRightsId($userid) {
        
        $this->db->initTable('rights_id',['id',$userid]);
        $tdata = $this->db->asArray();
        return $tdata[0]['rights_id'];
    }
    public function getAll($index='',$offset="",$orderby='') {
        $this->db->initTable('*','',$orderby,"$index,$offset");
        $tdata = $this->db->asArray();
        return $tdata;
    }
    public function getAllJoined($index='',$offset="",$orderby='') {
        $sql = "select 
                    a.id,a.surname,a.name,a.username,a.password,a.lastseen,a.created,a.altered,a.userstatus_id,
                    b.title as groups_id,
                    c.title as rights_id,
                    d.username as creator_id,
                    e.username as alterer_id,
                    a.userstatus_id as userstatus_id 
                from      users  a 
                left join groups b on a.groups_id = b.id 
                left join rights c on a.rights_id = c.id 
                left join users  d on a.creator_id = d.id 
                left join users  e on a.alterer_id = e.id ";
        if($orderby <> '')
            $sql .= "order by ".$orderby;
        
        if($index <> '' && $offset <> '')
            $sql .= " limit $index,$offset";
        //echo $sql;
        $this->db->query($sql);
        $tdata = $this->db->asArray();
        //print_r($tdata);
        return $tdata;
    }
    public function countAll() {
        $this->db->initTable('count(id)');
        $tdata = $this->db->asArray();
        return $tdata[0]['count(id)'];
    }
    public function updateUserstatusId($username,$int) {
        $this->db->updateTable(['userstatus_id' => $int],['username',$username]);
    }
    public function updateLastSeen($username) {
        $date = new DateTime("now");
        $this->db->updateTable(['lastseen' => $date->format('Y-m-d H:i:s')],['username',$username]);
        return $date->format('Y-m-d H:i:s');
    }
    public function addUser($data) {
        $this->db->insertRow($data);
    }
    public function byGroupId($groups_id,$index,$offset) {
        $this->db->initTable(['id','name','surname'],['groups_id',$groups_id],'userstatus_id',"$index,$offset");
        $tdata = $this->db->asArray();
        return $tdata; 
    }
    public function countGroupId($groups_id) {
        $this->db->initTable(['id'],['groups_id',$groups_id]);
        $tdata = $this->db->asArray();
        
        return sizeof($tdata) ;
    }


    
}
?>
