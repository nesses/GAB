<?php
/* 
 * @author Matthias Grotjohann
 */
class Error {
    private $type;
    private $message;
    
    public function setType($type) {
        $this->type = $type;
    }
    public function getType() {
        return $this->type;
    }
    public function setMsg($msg) {
        $this->message = $msg;
    }
    public function getMsg() {
        return $this->message;
    }
}

