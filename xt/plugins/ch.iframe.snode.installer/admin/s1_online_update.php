<?php
if (!eregi('fsockopen', ini_get('disable_functions'))) {
	
    download('http://www.s-node.com/packagelist.php',DATA_DIR . 'installer/repository/packagelist.txt');
    $lines = file(DATA_DIR . 'installer/repository/packagelist.txt');

    $result = XT::query("SELECT package,id FROM " . XT::getTable("plugins_packages"));
    while($row = $result->FetchRow()){
        $installed[$row['package']] = $row['id'];
    }


    // Loop through our array, show HTML source as HTML source; and line numbers too.
    foreach ($lines as $line_num => $line) {

        $farray[] = explode(';',$line);
    }
    // installierte packete rausfinden
    foreach ($farray as $key => $package) {
        if($installed[substr($package[0],0,-4)] > 0){
            $farray[$key]['installed'] = true;
        }

    }

    XT::assign('FILES',$farray);


}

$content = XT::build("s1_online_update.tpl");
?>
