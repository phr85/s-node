<?php
// Set the base id
XT::setBaseID(7600);

// Add the content type
XT::addContentType(7600,'Comment');

// Set used tables
XT::addTable('comments');
XT::addTable('user');
XT::addTable('comments_trackback_incomming');
XT::addTable('comments_trackback_outgoing');
// moderator email address
XT::addConfig("moderate", $GLOBALS['cfg']->get('system','email'), "Use this email to moderate comments. A blank value disable the moderation function.");
// Erlaubte HTML TAGS
XT::addConfig("allowable_tags","<b>,<strong>,<p>,<i>,<a>");

// Kommentare direkt aktivieren
XT::addConfig("postCommentActive",1);

XT::addTab('c','Comments','comments.php',true,true);
XT::addTab('t','Trackbacks','trackbacks.php',true,true);
?>