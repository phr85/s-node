<?php
XT::call('saveAssessment');
switch($GLOBALS['plugin']->getValue("position")){

    case 'before':
        XT::query("
            UPDATE " . $GLOBALS['plugin']->getTable("assessment_questions") .  " SET position = position + 1 WHERE assessment_id = " . $GLOBALS['plugin']->getValue("id") . " AND position >= " . $GLOBALS['plugin']->getValue("insert_position") . "",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("assessment_questions") .  " (assessment_id,position,title) VALUES (" . $GLOBALS['plugin']->getValue("id") . "," . ($GLOBALS['plugin']->getValue("insert_position")) . ",'" . XT::translate("New question") . "')
            ",__FILE__,__LINE__);

        break;

    case 'after':
        XT::query("
            UPDATE " . $GLOBALS['plugin']->getTable("assessment_questions") .  " SET position = position + 1 WHERE assessment_id = " . $GLOBALS['plugin']->getValue("id") . " AND position > " . $GLOBALS['plugin']->getValue("insert_position") . "",__FILE__,__LINE__);

        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("assessment_questions") .  " (assessment_id,position,title) VALUES (" . $GLOBALS['plugin']->getValue("id") . "," . ($GLOBALS['plugin']->getValue("insert_position") + 1) . ",'" . XT::translate("New question") . "')
            ",__FILE__,__LINE__);

        break;

}

// Get last insert id
$result = XT::query("
    SELECT id FROM " . $GLOBALS['plugin']->getTable("assessment_questions") .  " ORDER BY id DESC LIMIT 1", __FILE__,__LINE__);
while($row = $result->FetchRow()){
    $GLOBALS['plugin']->setValue("question_id", $row['id']);
}

$GLOBALS['plugin']->call("cancel");
$GLOBALS['plugin']->setAdminModule("eq");

?>