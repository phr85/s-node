<?php

if ( XT::getValue('pseudoaction') == "vote"){
	XT::call("vote");
}

if (XT::getValue('view_result')){
		include("result.php");
}else {
		include("question.php");
}

?>