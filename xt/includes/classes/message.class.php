<?php
class XT_Message {

	var $message_table = 'xt_messages';
	var $user_table = 'xt_user';
	var $user_groups_table = 'xt_user_groups';
	var $user_roles_table = 'xt_user_roles';
	var $message_flow = 0;
	var $parent_message = 0;
	var $sender = 0;
	var $receivers = array();
	var $message_text_truncate = 88;
	var $message_allowed_tags = "<b>,<br>,<p>,<a>";

	function XT_Message(){
		$this->setSender(XT::getUserID());
	}

	function setSender($senderID){
		$this->sender = $senderID;
	}

	function resetReceivers(){
		$this->receivers = array();
	}

	/**
     * Add multiple receivers to message
     *
     * @param string Semikolon separated list of receivers
     */
	function addReceivers($receivers){

		// Build array with all receivers from string (separated with semicolon)
		$receivers = explode(';',$receivers);

		// Build in string (separated with commata) holding all the usernames
		$in = "";
		foreach($receivers as $key => $value){
			$in = "'" . trim($value) . "',";
		}
		$in = substr($in, 0, -1);

		// Get id's for given usernames
		$result = XT::query("SELECT id FROM " . $this->user_table . " WHERE username IN (" . $in . ")",__FILE__,__LINE__);
		while($row = $result->FetchRow()){
			$this->addReceiver($row['id']);
		}
	}

	/**
     * Add a full group with all her members
     */
	function addReceiverGroup($group_id){
		$result = XT::query("SELECT user_id FROM " . $this->user_groups_table . " WHERE group_id = " . $group_id . "",__FILE__,__LINE__);
		while($row = $result->FetchRow()){
			$this->addReceiver($row['user_id']);
		}
	}

	/**
     * Add all the users with a given role
     */
	function addReceiverRole($role_id){
		$result = XT::query("SELECT user_id FROM " . $this->user_roles_table . " WHERE role_id = " . $role_id . "",__FILE__,__LINE__);
		while($row = $result->FetchRow()){
			$this->addReceiver($row['user_id']);
		}
	}

	/**
     * Add a single receiver to message
     *
     * @param string Receiver's username
     */
	function addReceiver($receiver){
		if(!in_array($receiver, $this->receivers)){
			array_push($this->receivers, $receiver);
		}
	}

	function setMessageFlow($id){
		$this->message_flow = $id;
	}

	function setParentMessage($pid){
		$this->parent_message = $pid;
	}

	function send_quick_message($to,$subject, $text){
		$this->addReceiver($to);
		$this->send($subject, $text);
	}

	function send($subject, $text, $priority = 1){
		if(!is_numeric($this->message_flow)){
			$this->message_flow = 0;
		}

		if(!is_numeric($this->parent_message)){
			$this->parent_message = 0;
		}

		if($subject == ''){
			$subject = $GLOBALS['lang']->msg("No subject");
		}

		foreach($this->receivers as $key => $receiver_id){
			XT::query("
                INSERT INTO " . $this->message_table . " (
                    sender,
                    subject,
                    text,
                    priority,
                    receiver,
                    send_date,
                    read_date,
                    message_flow,
                    parent_message
                ) VALUES (
                    " . $this->sender . ",
                    '" . $this->strip_javascript(strip_tags($subject,$this->message_allowed_tags)) . "',
                    '" . $this->strip_javascript(strip_tags($text,$this->message_allowed_tags)) . "',
                    '" . $priority . "',
                    '" . $receiver_id . "',
                    '" . TIME . "',
                    0,
                    " . $this->message_flow . ",
                    " . $this->parent_message . "
                )"
			,__FILE__,__LINE__);
		}

		/*
		if(sizeof($this->receivers > 0)){
		XT::log("Your message has been successfully delivered",__FILE__,__LINE__,XT_INFO);
		}
		*/
	}


	function read_message($message_id, $user_id = NULL){
		if($user_id === NULL){
			$user_id = $this->sender;
		}

		if($message_id > 0){
			$result = XT::query("
	    SELECT
	        *
	    FROM
	        {$this->message_table}
	    WHERE
	        id = {$message_id} AND receiver = {$user_id}",__FILE__,__LINE__);

			$data = XT::getQueryData($result);
			return $data[0];
		}else {
			return false;
		}
	}


	/**
      * Liste mit den gesendeten Nachrichten
      * @user_id int UserID
      * @limit int Anzahl der Nachrichten pro Seite
      * @page int gewünschte Seite
      * @from_date Nachrichten ab (als unix timestamp)
      * @to_date Nachrichten bis (als unix timestamp)
     * @return array gesendete Nachrichten in einem verschachtelten Array mit Array metadata und Array messages
     */

	function get_sent($user_id = NULL, $limit = 25 , $page = NULL , $from_date = NULL, $to_date = NULL){
		if($user_id === NULL){
			$user_id = $this->sender;
		}

		// count für den paginator
		$result = XT::query("
	    SELECT
	        count(id) as cnt
	    FROM
	       {$this->message_table}
	    WHERE
        sender = {$user_id} AND ~deleted &2");

		$data['metadata']['paginator']  = $this->paginator($limit, XT::getCountQuery($result,"cnt"),$page);

		$result = XT::query("
	    SELECT
	        *
	    FROM
	        {$this->message_table}
	    WHERE
	        sender = {$user_id} AND ~deleted &2
	    ORDER BY
	        send_date DESC
	    LIMIT {$data['metadata']['paginator']['pagelimit']}, {$data['metadata']['paginator']['messages_per_page']}",__FILE__,__LINE__);

		$data['messages'] = XT::getQueryData($result);
		return $data;
	}

	function paginator($limit,$count,$page){
		$paginator['num_of_pages'] = ceil($count/$limit);
		$paginator['num_of_messages'] = $count;
		$paginator['messages_per_page'] = $limit;
		if($page === NULL || $page < 1){
			$paginator['current_page'] = 1;
		}else {
			if($page > $paginator['num_of_pages']){
				$paginator['current_page'] = $paginator['num_of_pages'];
			}else {
				$paginator['current_page'] = $page;
			}
		}
		$paginator['pagelimit'] = ($paginator['current_page'] * $paginator['messages_per_page']) - $paginator['messages_per_page'];
		return $paginator;
	}


	/**
      * Empfangene Nachrichten 
      * @user_id int UserID
      * @new_messages_only bool nur neue Nachrichten
      * @limit int Anzahl der Nachrichten pro Seite
      * @page int gewünschte Seite
      * @from_date Nachrichten ab (als unix timestamp)
      * @to_date Nachrichten bis (als unix timestamp)
     * @return array empfangene Nachrichten in einem verschachtelten Array mit Array metadata und Array messages
     */
	function get_received($user_id = NULL, $new_messages_only = false, $limit = 25 , $page = NULL , $from_date = NULL, $to_date = NULL){
		if($user_id === NULL){
			$user_id = $this->sender;
		}
		if($new_messages_only){
			$new_only = " AND read_date = 0 ";
		}
		 
		// count für den paginator
		$result = XT::query("
	    SELECT
	        count(id) as cnt
	    FROM
			{$this->message_table}
	    WHERE
        receiver = {$user_id} {$new_only} AND ~deleted &2",__FILE__,__LINE__);

		$data['metadata']['paginator']  = $this->paginator($limit, XT::getCountQuery($result,"cnt"),$page);
		
		$result = XT::query("
	    SELECT
	        id, sender, subject, substr(text,1,{$this->message_text_truncate}) as text,priority, send_date, parent_message, read_date
	    FROM
	        {$this->message_table}
	    WHERE
	        receiver = {$user_id} {$new_only} AND ~deleted &2
	    ORDER BY
	    send_date DESC
	    LIMIT {$data['metadata']['paginator']['pagelimit']}, {$data['metadata']['paginator']['messages_per_page']}",__FILE__,__LINE__);

		$data['messages'] = XT::getQueryData($result);
		return $data;
	}

	/**
      * @user_id int UserID
      * @limit int Anzahl der Nachrichten pro Seite
      * @page int gewünschte Seite
      * @from_date Nachrichten ab (als unix timestamp)
      * @to_date Nachrichten bis (als unix timestamp)
     * @return array gesendete Nachrichten in einem verschachtelten Array mit Array metadata und Array messages
     */
	function get_deleted($user_id = NULL, $limit = 25 , $page = NULL , $from_date = NULL, $to_date = NULL){
		if($user_id === NULL){
			$user_id = $this->sender;
		}

		// count für den paginator
		$result = XT::query("
	    SELECT
	        count(id) as cnt
	    FROM
	       {$this->message_table}
	    WHERE
        (sender = {$user_id} OR receiver = {$user_id})
        AND deleted &2");

		$data['metadata']['paginator']  = $this->paginator($limit, XT::getCountQuery($result,"cnt"),$page);

		$result = XT::query("
	    SELECT
	        *
	    FROM
	        {$this->message_table}
	    WHERE
	        sender = {$user_id}
	        AND deleted &2
	    ORDER BY
	        send_date DESC
	    LIMIT {$data['metadata']['paginator']['pagelimit']}, {$data['metadata']['paginator']['messages_per_page']}",__FILE__,__LINE__);

		$data['messages'] = XT::getQueryData($result);
		return $data;
	}


	function set_unread($id){
		XT::query("UPDATE {$this->message_table} set read_date = 0 where id={$id} AND receiver = " . XT::getUserID() ,__FILE__,__LINE__);
	}
	function set_readed($id){
		XT::query("UPDATE {$this->message_table} set read_date = " . TIME . " where id={$id} AND receiver = " . XT::getUserID() . " AND read_date=0" ,__FILE__,__LINE__);
	}


	function delete_received($id){
		XT::query("UPDATE " . $this->message_table . " xt_messages set deleted = deleted+2 where id=" . $id . " AND receiver = " . XT::getUserID() . " AND ~deleted&2",__FILE__,__LINE__);
		XT::log("received Message deleted successfully",__FILE__,__LINE__,XT_INFO);
	}

	function delete_sent($id){
		XT::query("UPDATE " . $this->message_table . " xt_messages set deleted = deleted+1 where id=" . $id . " AND sender = " . XT::getUserID() . " AND ~deleted&1",__FILE__,__LINE__);
		XT::log("sent Message deleted successfully",__FILE__,__LINE__,XT_INFO);
	}

	function undelete_received($id){
		XT::query("UPDATE " . $this->message_table . " xt_messages set deleted = deleted-2 where id=" . $id . " AND receiver = " . XT::getUserID() . " AND deleted&2",__FILE__,__LINE__);
	}
	function undelete_sent($id){
		XT::query("UPDATE " . $this->message_table . " xt_messages set deleted = deleted-1 where id=" . $id . " AND sender = " . XT::getUserID() . " AND deleted&1",__FILE__,__LINE__);
	}

	function delete_received_final($id){
		XT::query("UPDATE " . $this->message_table . " xt_messages set deleted = deleted+4 where id=" . $id . " AND receiver = " . XT::getUserID() . " AND ~deleted&4",__FILE__,__LINE__);
		XT::log("received Message deleted successfully",__FILE__,__LINE__,XT_INFO);
	}

	function delete_sent_final($id){
		XT::query("UPDATE " . $this->message_table . " xt_messages set deleted = deleted+8 where id=" . $id . " AND sender = " . XT::getUserID() . " AND ~deleted&8",__FILE__,__LINE__);
		XT::log("sent Message deleted successfully",__FILE__,__LINE__,XT_INFO);
	}

	function delete_all_received_final(){
		XT::query("UPDATE " . $this->message_table . " xt_messages set deleted = deleted+4 where receiver = " . XT::getUserID() . " AND ~deleted&4",__FILE__,__LINE__);
		XT::log("all received Message deleted successfully",__FILE__,__LINE__,XT_INFO);
	}

	function delete_all_sent_final(){
		XT::query("UPDATE " . $this->message_table . " xt_messages set deleted = deleted+8 where sender = " . XT::getUserID() . " AND ~deleted&8",__FILE__,__LINE__);
		XT::log("all sent Message deleted successfully",__FILE__,__LINE__,XT_INFO);
	}

	function purge(){
		XT::query("DELETE FROM " . $this->message_table . " WHERE deleted&12",__FILE__,__LINE__);
		XT::log("Message purged successfully",__FILE__,__LINE__,XT_INFO);
	}

	function enableEmailNotification($email){

	}

	function strip_javascript($filter){

		// realign javascript href to onclick
		$filter = preg_replace("/href=(['\"]).*?javascript:(.*)?\\1/i", "onclick=' $2 '", $filter);

		//remove javascript from tags
		while( preg_match("/<(.*)?javascript.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", $filter))
		$filter = preg_replace("/<(.*)?javascript.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", "<$1$3$4$5>", $filter);

		// dump expressions from contibuted content
		if(0) $filter = preg_replace("/:expression\(.*?((?>[^(.*?)]+)|(?R)).*?\)\)/i", "", $filter);

		while( preg_match("/<(.*)?:expr.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", $filter))
		$filter = preg_replace("/<(.*)?:expr.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", "<$1$3$4$5>", $filter);

		// remove all on* events
		while( preg_match("/<(.*)?\s?on.+?=?\s?.+?(['\"]).*?\\2\s?(.*)?>/i", $filter) )
		$filter = preg_replace("/<(.*)?\s?on.+?=?\s?.+?(['\"]).*?\\2\s?(.*)?>/i", "<$1$3>", $filter);

		return $filter;
	}
}
?>