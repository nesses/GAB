<?php

/* 
 * @author Matthias Grotjohann
 */

require_once 'lib/table.db.php';
class EmployeesTable {
    private $db;
    
    private $table = "employees";
    
    private $colNames = ['id', 
                         'user_id', 
                         'name', 
                         'surname' ,
                         'group_id',
                         'tel' ,
                         'mobile',
                         'mail' ,
                         'street',
                         'zip' ,
                         'city',
                         'workaction_id',
                         'speechcoursedays',
                         'workaction_beginn',
                         'workaction_end',
                         'timeaddon_end',
                         'created',
                         'creator_id',
                         'birthday',
                         'jobcenterid',
                         'handicaped',
                         'pillflat',
                         'bank_id',
                         'bic',
                         'iban',
                         'accountowner',
                         'nationality_id',
                         'anrede_id'];
    
    public function __construct() {
        $this->db = new DbTable($this->table,$this->colNames);
    }
    public function getAllJoined($index='',$offset="",$orderby='') {
        $sql = "SELECT a.id,a.name,a.surname,
        	   a.tel,a.mobile,
                   a.mail,a.street,
                   a.zip,a.city,a.speechcoursedays,
                   a.workaction_beginn,a.workaction_end,
                   a.timeaddon_end,a.birthday,
                   a.jobcenterid,a.handicaped,a.pillflat,
                   a.bank_id,a.bic,a.iban,a.accountowner,
                   b.title as group_id,
                   c.username as user_id,
		   d.title as workaction_id
                FROM employees a 
                    left join rights b on b.id = a.group_id 
                    left join users c on c.id = a.user_id
                    left join groups d on d.id = a.workaction_id";
        
        if($orderby <> '')
            $sql .= " order by ".$orderby;
        
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

}