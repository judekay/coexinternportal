<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Judekayode
 * Date: 1/30/15
 * Time: 2:27 PM
 * To change this template use File | Settings | File Templates.
 */

class SQLClient {
    private $pdo;
    private $username;
    private $password;
    private $dbname;
    private $pds;
    private $host;

    public function __construct($dbname, $dbhost, $dbuser, $dbpass){
        $user = $this->username =$dbuser ;
        $pass = $this->password = $dbpass;
        $host = $this->host = $dbhost;
        $db = $this->dbname = $dbname;

        $dsn = "mysql:host=$host;dbname=$db";

        $this->pdo = new PDO($dsn, $user, $pass);


    }

    public function query($sql){
        $this->pds = $this->pdo->prepare($sql);

    }
    public function bind($param, $value, $type = null)

    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->pds->bindParam($param, $value, $type);
    }
    public function execute(){
        return $this->pds->execute();
    }
    public function fetchOne(){
        $this->execute();
        return $this->pds->fetch(PDO::FETCH_ASSOC);


    }
    public function fetchAll(){

        $this->execute();
        return $this->pds->fetchAll(PDO::FETCH_ASSOC);
    }
    public function rowCount(){

        return $this->pds->rowCount();


    }
    public function fetchObjects(){
        $this->execute();
        return $this->pds->fetchObject();
    }
    public function lastinsertId(){
        return $this->pdo->lastInsertId();
    }
    public function beginTransaction(){
        return $this->pdo->beginTransaction();
    }
    public function endTransaction(){
        return $this->pdo->commit();
    }
    public function cancelTransaction(){
        return $this->pdo->rollBack();
    }

}