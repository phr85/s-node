<?php

header("Location: " . $this->indexfile . "?TPL=" . $TTPL . "&x" . $PLUGINID ."_ID=" . $var[$PLUGINID]['ID'] . "&x" . $PLUGINID ."_go=content#c" . $var[$PLUGINID]['actionID']);
unset($_SESSION['x' . $PLUGINID]['c_TWOSTEP']);

?>