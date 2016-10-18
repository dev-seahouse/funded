<?php
/*
 An Utility class to facilitate
 communication between objects/interfaces
 Author: Kenan
 Organization : dev-seahouse
*/

class Message {

    private $infos;
    private $errs;
    private $hidden_err; // internal errs not meant to show client
    private $data;
    private $status;

    const FAILURE = false;
    const SUCCESS = true;

    public function __construct() {
        $this->infos = array();
        $this->errs = array();
        $this->hidden_err = array();
        $this->data = array();
        $this->status = self::SUCCESS;
    }

    public function putinfo($msg) {
        array_push($this->infos, $msg);
    }

    public function putFailure($msg) {
        // as soon as an error msg is encountered, auto change error status
        // violates SRP ? sometimes need to break rule for greater good
        $this->setStatusFailure();
        array_push($this->errs, $msg);
    }

    public function putHiddenErr($msg){
        $this->setStatusFailure();
        array_push($this->hidden_err, $msg);
    }

    public function getInfoAsArray() {
        return $this->infos;
    }

    public function getErrorAsArray() {
        return $this->errs;
    }

    public function getData(){
        return $this->data;
    }

    public function putData($item){
      array_push($this->data, $item);
    }

    private function makeMsgArr() {
        $messages = array(
            "status" => $this->status,
            "info" => $this->infos,
            'err' => $this->errs,
            'data' => $this->data
        );
        return $messages;
    }

    private function setStatusFailure() {
        if ($this->status === self::SUCCESS) {
            $this->status = self::FAILURE;
        }
    }

    public function toJson() {
        $out = $this->makeMsgArr();
        return json_encode($out);
    }
}