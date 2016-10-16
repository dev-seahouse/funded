<?php

/*
 An Utility class to facilitate
 communication between objects/interfaces
 Author: Kenan
 Organization : dev-seahouse
*/

class Message {

    private $infos;
    private $errors;
    private $data;
    private $status;

    const FAILURE = 400;
    const SUCCESS = 200;

    public function __construct() {
        $this->infos = array();
        $this->errors = array();
        $this->data = array();
        $this->status = self::SUCCESS;
    }

    public function putinfo($msg) {
        array_push($this->infos, $msg);
    }

    public function putErr($msg) {
        // as soon as an error msg is encountered, auto change error status
        // violates SRP ? sometimes need to break rule for greater good
        if ($this->status == self::SUCCESS){
            $this->status = self::FAILURE;
        }
        array_push($this->infos, $msg);
    }

    public function hasErr(){
        return !($this->errors);
    }

    public function getInfoAsArray() {
        return $this->infos;
    }

    public function getErrorAsArray() {
        return $this->errors;
    }

    public function getData(){
        return $this->data;
    }

    public function getAllAsArray(){

    }

    public function makeMsgArr() {
        $this->messages = array(
            "status" => self::FAILURE,
            "info" => $this->infos,
            'err' => $this->errors,
            'data' => $this->data
        );
    }
}