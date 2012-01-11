<?php

// eine erhebung einer bestehenden kategorie zuf�gen

//*****************************************************************************
//folgende 2 select anweisungen lesen den titel des formulares aus und setzen 
//die report_id anhand der maximalen id in der table xt_poll
//*****************************************************************************
if (XT::getSessionValue("pickedForm")){
	$title = XT::query(
		"SELECT
			title
		 FROM
		 	" . XT::getTable('forms') . "
		  WHERE
		    id = " . XT::getSessionValue("pickedForm") . "
		  ",__FILE__,__LINE__);
		
	$titlefield = XT::getQueryData($title);
	
	$result = XT::query(
	"SELECT 
			 MAX(id) as maxid 
	 FROM 
	 	" . $GLOBALS['plugin']->getTable('formreport')
	,__FILE__,__LINE__);

	$id = $result->FetchRow(); //enth�lt die maximale id aus der tabelle xt_poll
	
	$pollid = $id['maxid'] + 1 ;
	
	if(XT::getSessionValue('open') > 0) // ist ein folder gewählt?
	{
		if(XT::getValue('edate') != XT::getValue('sdate'))// ist der start und endzeitpunkt nicht der selbe?
		{
			
			if(XT::getValue('edate') < XT::getValue('sdate'))// ist der start und endzeitpunkt nicht der selbe?
			{
				XT::log(XT::translate('Start is older as the end'),__FILE__,__LINE__,1,0,0);
				
				$GLOBALS['plugin']->setAdminModule("add");
			}else{
			
				//*****************************************************************************
				//insert für die folder ansicht
				//*****************************************************************************
			
				XT::query(
					"INSERT INTO
				        " . XT::getTable('formreport_tree_rel') . "
				        (
				       		report_id,
				       		node_id
				       	) 
				      VALUES
				       	(
				       		" . $pollid . ",
				       		" . XT::getSessionValue('open') . "
				       	)
				     ",__FILE__,__LINE__);
					
					
					
				//*****************************************************************************
				//insert für die pollverwaltung xt_poll
				//report_id   neue id des polls
				//form_id als zeiger auf das verwendete formular
				//title wert des formularzeigers für title des polls
				//start und endzeit für den poll
				//und erstellungsdatum (wird nicht verwendet)
				//*****************************************************************************
					XT::query(
						"INSERT INTO
							" . XT::getTable('formreport') . "
							(
								form_id,
								title,
								time_start,
								time_end,
								creation_date
							)
						  VALUES
						  	(
						  		" . XT::getSessionValue("pickedForm") . ",
						  		'" . $titlefield[0][title] . "',
						  		" . XT::getValue('sdate') . ",
						  		" . XT::getValue('edate') . ",
						  		" . time() . "
						  	)
						  ",__FILE__,__LINE__);
						
						
					$GLOBALS['plugin']->setAdminModule("slave1");
				}
				
			}
			else 
			{
			XT::log(XT::translate('start and end time are the same!'),__FILE__,__LINE__,1,0,0);
			
			$GLOBALS['plugin']->setAdminModule("add");
	 	 		
			}
			
	}	
} else {
	XT::log(XT::translate('Please select a form!'),__FILE__,__LINE__,1,0,0);
		
		$GLOBALS['plugin']->setAdminModule("add");
	}
	
	

?>