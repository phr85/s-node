<?php
switch (XT::getValue("wizard")) {
	case "upload":
        XT::setAdminModule('upload');
		break;
    case "upload_sampledata":
        XT::setAdminModule('upload_sampledata');
		break;
	case "overview":
        XT::setAdminModule('slave1');
		break;
	case "update":
        XT::setAdminModule('update');
		break;
	case "install":
		XT::setAdminModule('install');
		break;
	case "upload_theme":
		XT::setAdminModule('upload_theme');
		break;
	case "online_update":
		XT::setAdminModule('online_update');
		break;
	case "developer_mode":
		if (XT::getValue("developer_password") == "sp4M") {
			XT::setAdminModule('developer_mode');
		} else {
			 XT::setAdminModule('slave1');
		}
		break;
}

?>