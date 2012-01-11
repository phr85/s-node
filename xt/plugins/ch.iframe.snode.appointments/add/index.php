<?php

// Select which step to show.
switch (XT::getValue('step')){
	case 'start':
		include('start.php');
		break;
	case 'times':
		include('times.php');
		break;
	case 'invite':
		include('invite.php');
		break;
	case 'finish':
		include('finish.php');
		break;
	default:
		include('start.php');
};

?>