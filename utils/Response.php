<?php


abstract class Response {
    protected $message;
    public function __construct($message){
        $this->message = $message;
    }

    /**
     * @return string
     */
    abstract public function get();
}