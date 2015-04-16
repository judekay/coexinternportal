<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KAYODE
 * Date: 4/16/15
 * Time: 1:12 AM
 * To change this template use File | Settings | File Templates.
 */

class Activity {

    private $weekno;
    private $summary;
    private $intern_id;

    private $sqlclient;
    public function __construct(){
     $this->sqlclient = new SQLClient(DBNAME,DBHOST,DBUSER,DBPASSWORD);

    }

//    A function to log activity
    public function logActivity($weekno, $summary, $intern_id){
        //initialize properties
    $this->weekno = $weekno;
    $this->summary = $summary;
    $this->intern_id = $intern_id;

    $sql = ActivityTable::addactivity;
    $this->sqlclient ->query($sql);
    $this->sqlclient ->bind(":week_no", $this->weekno);
    $this->sqlclient ->bind(":summary_of _activity", $this->summary);
    $this->sqlclient ->bind(":intern_id", $this->intern_id);
    $this->sqlclient ->execute();
    return $this->sqlclient ->rowCount();
    }


//    A function to view all activities
    public function displayActivity($intern_id){
    //initialize property
    $this->intern_id = $intern_id;

    $sql  = ActivityTable::displayactivity;
    $this->sqlclient ->query($sql);
    $this->sqlclient ->bind(":intern_id", $this->intern_id);
    return $this->sqlclient->fetchAll();
    }


//    All function to view activity by week no
    public function displayActivitybyWeek($intern_id){
        //initialize property
     $this->intern_id = $intern_id;

    $sql  = ActivityTable::displayactivitybyweek;
    $this->sqlclient ->query($sql);
    $this->sqlclient ->bind(":intern_id", $this->intern_id);
    return $this->sqlclient->fetchAll();
}

}