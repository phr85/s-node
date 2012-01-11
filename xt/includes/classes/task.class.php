<?php
/**
 * XT_Task
 *
 * Function index:
 *
 * __construct
 * setSubject
 * setDescription
 * addReceiverGroup
 * addReceiverRole
 * addReceiver
 * setActive
 * setWorkflow
 * setPriority
 * send
 *
 * @package S-Node
 * @subpackage Tasks
 * @author Roger Dudler <rdudler@iframe.ch>
 * @copyright Copyright 2005, iframe AG, http://www.iframe.ch
 * @version $Id: task.class.php 3495 2007-07-26 09:09:49Z mgraf $
 */
 
class XT_Task {
    
    var $_task_table = '';
    var $_subject = '';
    var $_description = '';
    var $_receivers = array();
    var $_priority = 2;
    var $_active = true;
    var $_workflow_id = 0;
    var $_workflow_step_id = 0;
    
    function XT_Task($table = 'tasks'){
        $this->_task_table = $GLOBALS['cfg']->get("database","prefix") . $table;
    }
    
    /**
     * Set task subject
     *
     * @param string Task subject or title
     */
    function setSubject($subject){
        $this->_subject = $subject;
    }
    
    /**
     * Set task description
     *
     * @param string Task description
     */
    function setDescription($description){
        $this->_description = $description;
    }
    
    /**
     * Add a full group with all her members
     *
     * @param int Group ID
     */
    function addReceiverGroup($group_id){
        $result = XT::query("SELECT user_id FROM " . $this->user_groups_table . " WHERE group_id = " . $group_id . "",__FILE__,__LINE__);
        while($row = $result->FetchRow()){
            $this->addReceiver($row['user_id']);
        }
    }
    
    /**
     * Add all the users with a given role
     *
     * @param int Role ID
     */
    function addReceiverRole($role_id){
        $result = XT::query("SELECT user_id FROM " . $this->user_roles_table . " WHERE role_id = " . $role_id . "",__FILE__,__LINE__);
        while($row = $result->FetchRow()){
            $this->addReceiver($row['user_id']);
        }
    }
    
    /**
     * Add a single receiver to the task
     *
     * @param string Receiver's username
     */
    function addReceiver($receiver){
        if(!in_array($receiver, $this->_receivers)){
            array_push($this->_receivers, $receiver);
        }
    }
    
    /**
     * Set active state of this task
     *
     * @param bool <code>true</code> for active, <code>false</code> for inactive
     */
    function setActive($active){
        $this->_active = $active;
    }
    
    /**
     * Set Workflow data
     * 
     * @param int Workflow ID
     * @param int Workflow Step ID
     */
    function setWorkflow($id, $step_id, $instance_id){
        $this->_workflow_id = $id;
        $this->_workflow_step_id = $step_id;
        $this->_workflow_instance_id = $instance_id;
    }
    
    /**
     * Set task priority
     * 
     * Possible values are:
     * 0 - very low
     * 1 - low
     * 2 - medium (default)
     * 3 - high
     * 4 - very high
     *
     * @param int Priority
     */
    function setPriority($priority){
        $this->_priority($priority);
    }
    
    /**
     * Sends a message, based on previously set variables
     */
    function send(){
        foreach($this->_receivers as $key => $receiver_id){
            XT::query("
                INSERT INTO " . $this->_task_table . " (
                    sender,
                    title,
                    text,
                    priority,
                    receiver,
                    creation_date,
                    read_date,
                    active,
                    workflow_id,
                    workflow_step_id,
                    workflow_instance_id
                ) VALUES (
                    " . XT::getUserID() . ",
                    '" . $this->_subject . "',
                    '" . $this->_description . "',
                    '" . $this->_priority . "',
                    '" . $receiver_id . "',
                    '" . time() . "',
                    0,
                    '" . $this->_active . "',
                    '" . $this->_workflow_id . "',
                    '" . $this->_workflow_step_id . "',
                    '" . $this->_workflow_instance_id . "'
                )",__FILE__,__LINE__,1);
        }
    }

}

?>