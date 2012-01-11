<?php

// table
global $table;
global $tree;
$table = XT::getValue("table");
$repair = XT::getValue("repair");
$tree = XT::autoval("tree","R",1);
if($table !="" && $repair == "true"){

    // baum holen
    $result = XT::query("
    SELECT
        *
    FROM
        " . $table . " WHERE tree_id=" . $tree . " ORDER by l",__FILE__,__LINE__);

    $original = XT::getQueryData($result);
    $result = XT::query("SELECT count(id) as cnt from " . $table . " WHERE tree_id=" . $tree);
    $count = XT::getQueryData($result);
    $calulatedEndOfWorm = $count[0]['cnt'] * 2;
    $result = XT::query("SELECT * from " . $table . " WHERE id=" . $tree . " ORDER by l");
    $repaired = XT::getQueryData($result,"l");
    $repaired[1]['l'] = 1;
    $repaired[1]['r'] = $count[0]['cnt'] * 2;
    global $worm;
    $worm=1;
    global $r;
    $r=1;
    getSubs($tree,&$repaired,1);
    if($worm != $calulatedEndOfWorm){
        echo "counted in tree is " . $calulatedEndOfWorm . "<br />but repair brings " . $worm . "<br>";
        echo "MISSING " . ($calulatedEndOfWorm - $worm)/2 . " elements <br> Possible missed entries are:";
        foreach ($repaired as $vals) {
            $notin[] = $vals['id'];
        }
        $result = XT::query("SELECT * from " . $table . " WHERE tree_id=" . $tree . " AND id not in (" . implode(",",$notin) . ") ORDER by pid ASC",0,0);
        XT::printArray(XT::getQueryData($result));
        echo "<hr>";
        echo "Please assign a valid PID maunualy and run again";
    }else{

        ksort($repaired);

        foreach ($original as $orig) {
            if($orig['id'] != $repaired[$orig['l']]['id']){
                $indiferrent = true;
            }
            if($orig['level'] != $repaired[$orig['l']]['level']){
                $indiferrent = true;
            }
        }
        if($indiferrent){
            echo "Tree will be set to the following : <br />";
            XT::printArray($repaired);
            foreach ($repaired as $fixit) {
                XT::query("update " . $table . " set
        	l=" . $fixit['l'] . ",
        	r=" . $fixit['r'] . ",
        	pid=" . $fixit['pid'] . ",
        	level=" . $fixit['level'] . "
        	where `id`='" . $fixit['id'] . "'  ");
            }
        }else {
            echo "Tree is ok and must not be repaired";
        }
    }




}
function getSubs($pid,&$repaired,$level){
    ++$level;


    $result = XT::query("SELECT * from " . $GLOBALS["table"] . " WHERE pid=" . $pid . " AND tree_id=" . $GLOBALS["tree"] . " ORDER by l");

    while($row = $result->FetchRow()){
        ++$GLOBALS["worm"];
        $rtemp['id'] = $row['id'];
        $rtemp['l'] = $GLOBALS["worm"];
        $rtemp['r'] = getSubs($row['id'],&$repaired,$level);
        $rtemp['pid'] = $row['pid'];
        $rtemp['level'] = $level;
        $repaired[$rtemp['l']] = $rtemp;

    }
    return ++$GLOBALS["worm"];
}
?>