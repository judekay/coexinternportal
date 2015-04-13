<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Judekayode
 * Date: 4/8/15
 * Time: 4:22 PM
 * To change this template use File | Settings | File Templates.
 */

class admin {

    private $username;
    private $password;
    private $usertype;
    private $email;
    private $firstname;
    private $lastname;
    private $sql_client;


        public function __construct(){
            $this->sql_client = new SQLClient(DBNAME, DBHOST, DBUSER, DBPASSWORD);
        }

//    function to log in a superadmin, admin and supervisor into their respective accounts
        public function adminlogin($username, $password, $usertype){
            // initialising the parameters username, password and usertype
            $this->username = $username;
            $this->password = $password;
            $this->usertype = $usertype;

            $sql = "SELECT username, usertype FROM admin WHERE username = :username AND password = SHA1(:password) AND status_id = 1";
            $this->sql_client->query($sql);
            $this->sql_client->bind(":username", $this->username);
            $this->sql_client->bind(":password", $this->password);
            $this->sql_client->execute();
            return $this->sql_client->fetchOne();
        }


//    function to add an admin or supervisor in the database
        public function adminregister($username, $password, $firstname, $lastname, $email, $usertype_id){
            //initialise the , password, firstname, lastname, email, usertype_id
            $this->username = $username;
            $this->password = $password;
            $this->usertype = $usertype_id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;

            $sql = "INSERT INTO admin username, password, firstname, lastname, email, usertype_id VALUES (:username, SHA1(:password), :firstname,
                    ,:lastname,:email, :usertype_id";
            $this->sql_client->query($sql);
            $this->sql_client->bind(":username", $this->username);
            $this->sql_client->bind(":password", $this->password);
            $this->sql_client->bind(":firstname", $this->firstname);
            $this->sql_client->bind(":lastname", $this->lastname);
            $this->sql_client->bind(":email", $this->email);
            $this->sql_client->bind(":usertype_id", $this->usertype);
            return $this->sql_client->execute();

        }

}