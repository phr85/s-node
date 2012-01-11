<?php

XT::setBaseID(8200);

XT::addTable('assessment');
XT::addTable('assessment_questions');
XT::addTable('assessment_answers');
XT::addTable('assessment_solutions');


XT::addTab('o','Overview','overview.php',true,true);
XT::addTab('e','Edit','edit.php',false,false);
XT::addTab('eq','Edit question','editQuestion.php',false,false);
XT::addTab('addassessment','Add assessment','addAssessment.php',false,false);
XT::addTab('slave1','slave1','slave1.php',false,false);



XT::addContentType(8200,'Assessment');

// quiz like
$display['quiz_like'] = true;

// relations
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.relations.zl")){
    $display['relations'] = true;
}

XT::assign("DISPLAY",$display);
?>