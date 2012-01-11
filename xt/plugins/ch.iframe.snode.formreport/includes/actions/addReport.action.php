
<?php

if(XT::getSessionValue('open') < 1)
{
		//fehlermeldung weil keine kategorie ausgewählt ist
	 $GLOBALS['preplugin_content'] .= '<script language="JavaScript"><!--
				alert(\'' . $GLOBALS['lang']->msg('Please chose a category') . '\');
				//-->
				</script>';
	 
	 $GLOBALS['plugin']->setAdminModule("slave1");
}
else
{
	//maximale id ausgeben

	$result = XT::query(
	"SELECT 
	 MAX(id) as maxid 
	 FROM 
	 	" . $GLOBALS['plugin']->getTable('formreport')
	,__FILE__,__LINE__);

	$row = $result->FetchRow(); //enth�lt die maximale id aus der tabelle xt_poll

	$GLOBALS['plugin']->setValue("id", $row['maxid']);	//in der global variabel den wert setzen
	$GLOBALS['plugin']->setAdminModule("add"); //admin modul setzen

	}
?>
