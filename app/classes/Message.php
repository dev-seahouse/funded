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
    private $code;

    const FAILURE = false;
    const SUCCESS = true;
    const LOGIN_REQUIRED = 1;
    const INVALID_INPUT = 2;
    const DEFAULT_VALUE = 0;

    public function __construct() {
        $this->infos = array();
        $this->errs = array();
        $this->hidden_err = array();
        $this->data = array();
        $this->status = self::SUCCESS;
        $this->code = self::DEFAULT_VALUE;
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

    public function setCode($codeValue) {
        $this->code = $codeValue;
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

    public function putData($key, $value){
      $this->data[$key] = $value;
    }

    private function makeMsgArr() {
        $messages = array(
            "status" => $this->status,
            "info" => $this->infos,
            'err' => $this->errs,
            'data' => $this->data,
            'code' => $this->code
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