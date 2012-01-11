<?php
/**
 * XT_Workflow
 *
 * Function index:
 *
 * __construct
 *
 * @package S-Node
 * @subpackage Workflow
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: workflow.class.php 3495 2007-07-26 09:09:49Z mgraf $
 */

class XT_Workflow {

    var $_instance_id;
    var $_instance_title;

    /**
     * Constructor, needs id and contenttype of the object
     */
    function __construct(){
    }

    /**
     * Accept active workflow task
     */
    function accept($comment){

    }

    /**
     * Forwards an object to the next workflow step
     */
    function forward($comment){

    }

    /**
     * Reject active workflow task
     */
    function reject($comment){

    }

    /**
     * Abort active workflow, escalation handling
     */
    function abort($comment){

    }

    /**
     * Create workflow instance
     *
     * @param string Title of the instance
     * @param int Workflow structure ID
     */
    function create($title, $workflow_id){

        $this->_instance_title = $title;

        // Create new workflow instance
        XT::query("
            INSERT INTO
                " . $GLOBALS['cfg']->get("database","prefix") . "workflows_instances" . "
            (
                workflow_id,
                title,
                creation_date,
                creation_user
            ) VALUES (
                " . $workflow_id . ",
                '" . $title . "',
                " . time() . ",
                " . XT::getUserID() . "
            )",__FILE__,__LINE__);

        // Get instance id
        $result = XT::query("
            SELECT
                id
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "workflows_instances" . "
            ORDER BY
                id DESC
            LIMIT 1
            ",__FILE__,__LINE__);

        $data = XT::getQueryData($result);
        return $data[0]['id'];
    }

    /**
     * Starts a workflow
     *
     * @param int ID of the workflow instance to start
     */
    function start($instance_id){

        $this->_instance_id = $instance_id;

        // Update instance details
        XT::query("
            UPDATE
                " . $GLOBALS['cfg']->get("database","prefix") . "workflows_instances" . "
            SET
                start_date = " . time() . ",
                start_user = " . XT::getUserID() . "
            WHERE
                id = " . $instance_id . "
            ",__FILE__,__LINE__);

        // Get workflow structur for instance
        $result = XT::query("
            SELECT
                workflow_id
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "workflows_instances" . "
            WHERE
                id = " . $instance_id . "
            ",__FILE__,__LINE__);

        while($row =$result->FetchRow()){
            $workflow_id = $row['workflow_id'];
        }

        // Get information about the first phase
        $result = XT::query("
            SELECT
                id,
                phase
            FROM
                " . $GLOBALS['plugin']->getTable("workflows") . "
            WHERE
                workflow_id = " . $workflow_id . "
                AND id != workflow_id
            ORDER BY
                phase ASC
        ",__FILE__,__LINE__);

        $first = true;
        while($row = $result->FetchRow()){

            // Get the first phase id, which is started after this process
            if($first){
                $phase = $row['phase'];
                $first = false;
            }

            // Delegate tasks to members, who have to do something in this workflow
            if($row['phase'] == $phase){
                $this->_createAndActivateTasks($row['id']);
            } else {
                $this->_createTasks($row['id']);
            }
        }
    }

    /**
     * Create tasks for a given workflow step (active)
     *
     * @param int Workflow step ID
     */
    function _createAndActivateTasks($step_id){
        $this->_createTasks($step_id, true);
    }

    /**
     * Create tasks for a given workflow step (active / inactive)
     *
     * @param int Workflow step ID
     * @param bool <code>true</code> active / <code>false</code> inactive
     */
    function _createTasks($step_id, $active = false){
        require_once(CLASS_DIR . "task.class.php");
        $task = new XT_Task();

        $result = XT::query("
            SELECT
                wm.executer_id,
                wm.executer_mode,
                wm.workflow_id,
                w.title as workflow_title,
                ws.title as step_title
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "workflows_members" . " as wm,
                " . $GLOBALS['plugin']->getTable("workflows") . " as w,
                " . $GLOBALS['plugin']->getTable("workflows") . " as ws
            WHERE
                wm.step_id = " . $step_id . "
                AND w.id = wm.workflow_id
                AND ws.id = wm.step_id
            ",__FILE__,__LINE__);

        // Iterate through all step members
        while($row = $result->FetchRow()){

            // Send message to members
            switch($row['executer_mode']){
                case 1:
                    // Send message to single user
                    $task->addReceiver($row['executer_id']);
                    break;
                case 2:
                    // Send message to all group members
                    $task->addReceiverGroup($row['executer_id']);
                    break;
                case 3:
                    // Send message to all role members
                    $task->addReceiverRole($row['executer_id']);
                    break;
            }


            $workflow_title = $row['workflow_title'];
            $step_title = $row['step_title'];
            $workflow_id = $row['workflow_id'];
        }

        // Create tasks tasks
        $task->setWorkflow($workflow_id, $step_id, $this->_instance_id);
        $task->setActive($active);
        $task->setSubject("" . $step_title . " (" . $this->_instance_title . ")");
        $task->setDescription("...");
        $task->send();
    }

    /**
     * Create notifications (messages) for a given workflow step
     *
     * Possible events are:
     * workflow_start - A workflow has been started
     *
     * @param int Workflow step ID
     * @param string Event to notify for
     */
    function _createNotifications($step_id, $event){

        require_once(CLASS_DIR . "message.class.php");
        $message = new XT_Message();

        $result = XT::query("
            SELECT
                wm.executer_id,
                wm.executer_mode,
                w.title
            FROM
                " . $GLOBALS['cfg']->get("database","prefix") . "workflows_members" . " as wm,
                " . $GLOBALS['plugin']->getTable("workflows") . " as w
            WHERE
                wm.step_id = " . $step_id . "
                AND w.id = wm.workflow_id
            ",__FILE__,__LINE__);

        // Iterate through all step members
        while($row = $result->FetchRow()){

            // Send message to members
            switch($row['executer_mode']){
                case 1:
                    // Send message to single user
                    $message->addReceiver($row['executer_id']);
                    break;
                case 2:
                    // Send message to all group members
                    $message->addReceiverGroup($row['executer_id']);
                    break;
                case 3:
                    // Send message to all role members
                    $message->addReceiverRole($row['executer_id']);
                    break;
            }


            $workflow_title = $row['title'];
        }

        switch($event){
            case 'workflow_start':
                $message->send("Workflow \"" . $workflow_title . "\" has been started", "Be patient");
                break;
        }

    }
}

?>