<?php
class Response{
    private $status;
    private $data;
    private $message;
    
    public function __construct($status, $data, $message = '') {
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;
    }
    
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }
    
    public function getMessage() {
        return $this->message;
    }
    
    public function setMessage($message) {
        $this->message = $message;
    }
}
?>