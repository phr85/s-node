<?php

$file_id = XT::getParam("id");
$autoplay = XT::autoval("autoplay","P",false);

// Parameter :: style
$style = XT::getParam("style") != '' ? XT::getParam("style") : 'default.tpl';
$style = str_replace(".tpl","",$style);

$result = XT::query("
            SELECT
                file.id,file.type,file.filename,file.image,file.image_version,details.title,details.description
            FROM
            	" . XT::getTable("files") . " as file
            LEFT JOIN " . XT::getTable("files_details") . " as details on (details.id = file.id)
            WHERE
                file.id ='" . $file_id . "' AND  details.lang = '". XT::getLang() ."'
        ",__FILE__,__LINE__);

// Get Results
while ($row = $result->FetchRow()){
	$data = $row;
	$data['filetitle'] = $row['title'];
	$data['filename'] = $row['filename'];
}
// find out which filetype is included

if($data['type']==2){$data['type']=0;}

switch ($data['type']){
	case 0:
	    $data['mimetype'] = strtolower(substr(strrchr(trim($data['filename']),'.'),1));
		$data['preview_image'] = $data['image'];

		XT::assign("xt" . XT::getBaseID() . "_movie", $data);
		XT::assign("xt" . XT::getBaseID() . "_autoplay", $autoplay);
		// if themed template file is there
		if(is_file(TEMPLATE_DIR . $_SESSION['theme'] . "/ch.iframe.snode.filemanager/movie/" . $style . "/" . $data['mimetype'] . ".tpl")){
		    $content = $GLOBALS['tpl']->fetch(TEMPLATE_DIR . $_SESSION['theme'] . "/ch.iframe.snode.filemanager/movie/" . $style . "/" . $data['mimetype'] . ".tpl");
		}else{
			// Specifical filetype template is not available
			if(is_file(TEMPLATE_DIR."default/ch.iframe.snode.filemanager/movie/".$style."/".$data['mimetype'].".tpl")){
				$content = XT::build($style."/".$data['mimetype'].".tpl");
			}else{
				$style = XT::getParam("style") != '' ? XT::getParam("style") : 'default.tpl';
				$content = XT::build($style);
			}
		}
		break;
	case 1:
		$content = XT::build($style."/image.tpl");
		break;
}
?>