<?php

class XT_WIZARD{
	var $elements = array();
	var $current_element ;
	var $basedir;
	var $current_element_data;
	var $payload = array();
	
	function XT_WIZARD($name,$basedir,$elements){
		$this->basedir = dirname($basedir);
		$this->elements = $elements;
		
		// current aus der session holen oder session aufbauen
		if(!isset($_SESSION['XT_wizard'][$name])){
			// pointer auf session setzen
		 $this->current_element  =& $_SESSION['XT_wizard'][$name]['current'];
			$this->set_current_element(0);
		}else {
			
		// pointer auf session setzen
		 $this->current_element  =& $_SESSION['XT_wizard'][$name]['current'];
		 $this->set_current_element($this->current_element);
		 
		 // pointer für payload setzen
		 $this->payload  =& $_SESSION['XT_wizard'][$name]['payload'];
		}

	}
	
	
	
	function execute_current_element(){
		include($this->basedir . "/" . $this->current_element_data['file']);
		
	}
	
	
	function execute_element($element_id){
		if($this->set_current_element($element_id)){
		include($this->basedir . "/" . $this->current_element_data['file']);
		return true;
		}else {
			return false;
		}
	}
	
	function set_current_element($element_id){
		if(isset($this->elements[$element_id])){
			$this->current_element 		= $element_id;
			$this->current_element_data = $this->elements[$this->current_element];
			return true;
		}else {
			return false;
		}
	}
	
	function redirect_to_element($element_id){
		$this->set_current_element($element_id);
		header("Location: /index.php?TPL=" . $this->elements[$element_id]['TPL']);
		die();
	}
	
	//TODO: redirect_to_next_display() redirect_to_previous_display() reset()
}