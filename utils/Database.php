<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KAYODE
 * Date: 4/16/15
 * Time: 12:07 AM
 * To change this template use File | Settings | File Templates.
 */

class Database {


}

class TaskTable {
    const createtask = "INSERT INTO task (task_title,task_description,supervisor_id,created_date, task_comments)
                        VALUES (:task_title, :task_description,:supervisor_id, NOW(), :task_comments)";

    const assigntask = "INSERT INTO intern_task (intern_id, task_id, due_date) VALUES(:intern_id, :task_id, :duedate)";

    const edittask =   "UPDATE task SET task_title =:task_title, task_description = :task_description,
                        supervisor_id = :supervisor_id, task_comments = :task_comments WHERE task_id = :task_id
                        AND status_id = 1";

    const addcomment = "UPDATE task SET task_comments = :task_comments WHERE task_id = :task_id AND
                        status_id = 1";

    const removetask = "UPDATE task SET status_id = 2 WHERE task_id = :task_id";

}

class ActivityTable {

    const addactivity = "INSERT INTO activity (week_no, summmary_of_activity,created_date, modified_date, intern_id)
                         VALUES (:week_no, :summary_of_activity,NOW(), NOW(), :intern_id)";

    const displayactivity = "SELECT * from activity WHERE intern_id = :intern_id";

    const displayactivitybyweek = "SELECT * from activity WHERE intern_id = :intern_id AND week_no = :week_no";
}