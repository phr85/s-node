<?php

XT::query("
    UPDATE
        " . XT::getTable('assessment_questions') . " 
    SET
        mod_user=" . XT::getUserID() . ",
        mod_date=" . time() . ",
        title='" . XT::getValue("title") . "',
        description='" . XT::getValue("description") . "'
    WHERE
        id=" . XT::getValue("question_id")  . "
    ",__FILE__,__LINE__);

// Get all answers for the requested question
$result_assessment_ansewrs = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('assessment_answers') .  "
    WHERE
        question_id=" . XT::getValue("question_id") . "
    ORDER BY
        position ASC
    ",__FILE__,__LINE__);

while ($row_assessment_answers = $result_assessment_ansewrs->fetchRow()) {
    XT::query("
        UPDATE
            " . XT::getTable('assessment_answers') . " 
        SET
            mod_user=" . XT::getUserID() . ",
            mod_date=" . time() . ",
            value='" . XT::getValue("answer_value_" . $row_assessment_answers['id']) . "',
            description='" .  XT::getValue("answer_description_" . $row_assessment_answers['id']) . "',
            comment='" . XT::getValue("answer_comment_" . $row_assessment_answers['id']) . "'
        WHERE
            id=" . $row_assessment_answers['id']  . "
    ",__FILE__,__LINE__);
}

// Set the view to edit
XT::setAdminModule("eq");
?>