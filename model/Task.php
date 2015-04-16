<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KAYODE
 * Date: 4/16/15
 * Time: 12:02 AM
 * To change this template use File | Settings | File Templates.
 */

class Task {
    private $tasktitle;
    private $task_description;
    private $supervisor_id;
    private $duedate;
    private $task_comments;
    private $intern_id;
    private $task_id;
    private $sqlclient;



    public function __construct(){
        $this->sqlclient = new SQLClient(DBNAME,DBHOST,DBUSER,DBPASSWORD);

    }

//    A method that creates a new task for the intern

    public function createTask($task_title, $task_description, $supervisor_id, $task_comments){
        // initialize variable
        $this->tasktitle = $task_title;
        $this->task_description = $task_description;
        $this->supervisor_id = $supervisor_id;
        $this->task_comments = $task_comments;

        $sql = TaskTable::createtask;
        $this->sqlclient ->query($sql);
        $this->sqlclient ->bind(":task_title", $this->tasktitle);
        $this->sqlclient ->bind(":task_description", $this->task_description);
        $this->sqlclient ->bind(":supervisor_id", $this->supervisor_id);
        $this->sqlclient ->bind(":task_comments", $this->task_comments);
        return $this->sqlclient ->execute();

    }

//    A method that assigns a task to an intern
    public function assignTask($intern_id, $task_id, $duedate){
        //initialize properties
        $this->intern_id = $intern_id;
        $this->task_id = $task_id;
        $this->duedate = $duedate;

        $sql =Tasktable::assigntask;
        $this->sqlclient ->query($sql);
        $this->sqlclient ->bind(":intern_id", $this->intern_id);
        $this->sqlclient ->bind(":task_id", $this->task_id);
        $this->sqlclient ->bind(":duedate", $this->duedate);
        $this->sqlclient ->execute();
        return $this->sqlclient ->rowCount();

    }

//    A method to edit/modify a particular task
    public function editTask($task_id, $task_title, $description, $supervisor_id, $task_comments ){
        //initialize associated properties
        $this->task_id = $task_id;
        $this->tasktitle = $task_title;
        $this->task_description =$description;
        $this->supervisor_id = $supervisor_id;
        $this->task_comments = $task_comments;

        $sql = TaskTable::edittask;
        $this->sqlclient ->query($sql);
        $this->sqlclient ->bind(":task_id", $this->task_id);
        $this->sqlclient ->bind(":task_title", $this->tasktitle);
        $this->sqlclient ->bind(":task_description", $this->task_description);
        $this->sqlclient ->bind(":supervisor_id", $this->supervisor_id);
        $this->sqlclient ->bind(":task_comments", $this->task_comments);
        return $this->sqlclient ->execute();
    }

//    A method to remove a particular task by its id
    public function removeTask($task_id){
        //initialize property
        $this->task_id = $task_id;

        $sql = TaskTable::removetask;
        $this->sqlclient ->query($sql);
        $this->sqlclient ->bind(":task_id", $this->task_id);
        return $this->sqlclient ->execute();
    }

//    A method to add/edit comment on a specific task
    public function addComment($task_id){
        //initialize property
        $this->task_id = $task_id;

        $sql = TaskTable::addcomment;
        $this->sqlclient ->query($sql);
        $this->sqlclient ->bind(":task_id", $this->task_id);
        return $this->sqlclient ->execute();
    }



}