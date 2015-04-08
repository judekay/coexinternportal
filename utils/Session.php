<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Judekayode
 * Date: 2/3/15
 * Time: 9:55 AM
 * To change this template use File | Settings | File Templates.
 */

class Session {

    private $logged_in = false;
    public $userID;
    public $message;

    public function __construct(){
        session_start();
        $this->checkmessage();
        $this->checklogin();

    }

    public function isloggedin(){
        return $this->logged_in;

    }

    public function login($user){
        if($this->logged_in){
            echo "You are logged in";
        }
        else{
            echo "You are not logged in";
        }
        if($user){
            $this->userID = $_SESSION['userID'] = $user;
            $this->logged_in = true;
            echo "<br/>" .$user;
        }

    }

    public function message($msg =""){
        if(!empty($msg)){

            $_SESSION['message'] = $msg;
        }
        else{
            return $this->message;
        }
            return "";
        }

    public function logout(){
        unset($_SESSION['userID']);
        unset($this->userID);
        $this->logged_in = false;
        echo "<br/>". "you have been logged out";

    }

    private function checklogin(){
        if(isset($_SESSION['userID'])){
            $this->userID = $_SESSION['userID'];
            $this->logged_in = true;
        }
        else{
            unset($this->userID);

            $this->logged_in = false;
        }
    }

    private  function checkmessage(){
        if(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

}

$session = new Session();
$message = $session->message();