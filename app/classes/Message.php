<?php

/*
 An Utility class to facilitate
 communication between objects/interfaces
 Author: Kenan
 Organization : dev-seahouse
*/

class Message {

    private $infos = array();
    private $errors = array();
    private $data = array();

    public function putinfo($msg) {
        array_push($this->infos, $msg);
    }

    public function putErr($msg) {
        array_push($this->infos, $msg);
    }

    public function hasErr(){

    }

    public function getInfoAsArray() {
        return $this->infos;
    }

    public function getErrorAsArray() {
        return $this->errors;
    }
}