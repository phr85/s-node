<?php
// hole alle displays und deren unterseiten
$current_display = XT::autoval('display_id',"R",0);
$curent_page = XT::autoval("page_id","R");

$res = XT::query("SELECT * from " . XT::getTable("microshop_display") . " WHERE id=" . $current_display,__FILE__,__LINE__);
$data['data'] = $res->fetchRow();

// styles rausfinden

foreach (glob(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.microshop/display/*') as $usertpls){
	if(is_file($usertpls)){
		$data['metadata']['styles'][trim(basename($usertpls))]= $_SESSION['theme'];
	}
    
    
}

// Images
    XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
    XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));

XT::assign("MICROSHOP",$data);

$content = XT::build('edit_display.tpl');

?>