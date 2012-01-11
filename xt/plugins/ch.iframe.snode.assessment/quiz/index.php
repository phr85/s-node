<?php

$data = array();

// id
$data['metadata']['id'] = XT::autoval("id", "R", 0);

// style
$data['metadata']['style'] = XT::autoval("style", "P", "default.tpl");

// Zur naechsten Frage gehen
if(XT::autoval("next", "R", false, true)) {
    XT::setSessionValue("active_question", XT::getSessionValue("active_question", XT::getBaseID()) + 1);
}

// Die aktuelle Fragen setzen, falls wir noch am Anfang stehen
if(!XT::getSessionValue("active_question", XT::getBaseID())) {
    XT::setSessionValue("active_question", 1);
}

// Die aktuelle Frage zuweisen
$data['metadata']['active_question'] = XT::getSessionValue("active_question", XT::getBaseID());


// Daten abrufen
$result = XT::query("
    SELECT
        assessment.id,
        assessment.title,
        assessment.description,
        q.id as question_id,
        q.title as question_title,
        q.description as question_description,
        q.position as question_position,
        a.id as answer_id,
        a.description as answer_description,
        a.value as answer_value,
        a.comment as answer_comment,
        a.position as answer_position
    FROM
        " . XT::getTable("assessment") . " as assessment
    LEFT JOIN
        " . XT::getTable("assessment_questions") . " as q ON (assessment.id = q.assessment_id)
    LEFT JOIN
        " . XT::getTable("assessment_answers") . " as a ON (q.id = a.question_id)
    WHERE
        assessment.id = " . intval($data['metadata']['id']) . " AND
        assessment.active = 1
    ORDER BY
        q.position ASC,
        a.position ASC
",__FILE__,__LINE__);

while($row = $result->fetchRow()) {
    
    // Hautinformationen
    $data['data']['id'] = $row['id'];
    $data['data']['title'] = $row['title'];
    $data['data']['description'] = $row['description'];
    
    // Fragen
    if($row['question_id'] > 0) {
        $data['data']['questions'][$row['question_id']]['id'] = $row['question_id'];
        $data['data']['questions'][$row['question_id']]['title'] = $row['question_title'];
        $data['data']['questions'][$row['question_id']]['description'] = $row['question_description'];
        $data['data']['questions'][$row['question_id']]['position'] = $row['question_position'];
        
        // IDs zusammenstellen fuer den Wizzard
        $questions[$row['question_id']] = $row['question_id'];
        
        // Antworten
        if($row['answer_id'] > 0) {
            $data['data']['questions'][$row['question_id']]['answers'][$row['answer_id']]['id'] = $row['answer_id'];
            $data['data']['questions'][$row['question_id']]['answers'][$row['answer_id']]['description'] = $row['answer_description'];
            $data['data']['questions'][$row['question_id']]['answers'][$row['answer_id']]['value'] = $row['answer_value'];
            $data['data']['questions'][$row['question_id']]['answers'][$row['answer_id']]['comment'] = $row['answer_comment'];
            $data['data']['questions'][$row['question_id']]['answers'][$row['answer_id']]['position'] = $row['answer_position'];
        }
    }
}

// Den Array mit den Fragen aufbereiten
if(isset($questions) && is_array($questions)) {
    $q = 1;
    foreach($questions as $question) {
        $data['metadata']['questions'][$q] = $question;
        $q++;
    }
    unset($q);
}

$data['metadata']['questions_count'] = count($data['metadata']['questions']);

// Die aktuelle Frage zuweisen
if(isset($data['metadata']['questions'][$data['metadata']['active_question']])) {
    $data['question'] = $data['data']['questions'][$data['metadata']['questions'][$data['metadata']['active_question']]];
}
// Falls es keine Frage mehr gibt ist das Quiz zu Ende
else {
    $data['points'] = XT::getSessionValue("points", XT::getBaseID());
    $result = XT::query("
        SELECT
            assessment_solutions.title,
            assessment_solutions.description
        FROM
            " . XT::getTable("assessment_solutions") . " as assessment_solutions
        WHERE
            assessment_solutions.assessment_id = " . intval($data['metadata']['id']) . " AND
            assessment_solutions.lower_level <= " . $data['points'] . " AND
            assessment_solutions.upper_level >= " . $data['points'] . "
        ORDER BY
            assessment_solutions.lower_level DESC
        LIMIT 1
    ",__FILE__,__LINE__);
    while($row = $result->fetchRow()) {
        $data['solution'] = $row;
    }
    $data['finished'] = true;
    XT::unsetSessionValue("active_question");
    XT::unsetSessionValue("points");
}

// Die aktuelle Antwort zuweisen
if(isset($data['question']['answers'][XT::autoval("answer_id", "R", false, true)])) {
    XT::setSessionValue("points", XT::getSessionValue("points", XT::getBaseID()) + $data['question']['answers'][XT::autoval("answer_id", "R", false, true)]['value']);
    $data['answer'] = $data['question']['answers'][XT::autoval("answer_id", "R", false, true)];
    $data['points'] = XT::getSessionValue("points", XT::getBaseID());
}

XT::assign("xt" . XT::getBaseID() . "_quiz", $data);
$content = XT::build($data['metadata']['style']);

?>