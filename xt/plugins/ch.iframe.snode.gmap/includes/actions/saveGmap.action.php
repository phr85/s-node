<?php
	XT::query("
		UPDATE
			" . XT::getTable("gmap") . "
		SET
			title = '" . XT::getValue("title") . "',
			description = '" . XT::getValue("description") . "',
			maplatlong = '" . XT::getValue("maplatlong") . "',
			mapzoom = '" . XT::getValue("mapzoom") . "',
			markerlatlong = '" . XT::getValue("markerlatlong") . "'
			
		WHERE id = " . XT::getValue("id") . "
	",__FILE__,__LINE__);
?>