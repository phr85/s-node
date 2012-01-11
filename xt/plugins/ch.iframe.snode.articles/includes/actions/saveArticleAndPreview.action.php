<?php

$GLOBALS['plugin']->call("saveArticle");
if(isset($_SESSION['referer'])){
    $referer = $_SESSION['referer'];
    unset($_SESSION['referer']);
    header("Location: " . $referer . "&lang=" . $GLOBALS['plugin']->getActiveLang() . "" . "&x" . $GLOBALS['plugin']->getBaseID() . "_preview=1");
} else {
?>
<script language="JavaScript"><!--
if(window.parent.frames['master']){
    window.open('<?= $_SERVER['PHP_SELF']; ?>?TPL=113&x<?= $GLOBALS['plugin']->getBaseID(); ?>_preview=1&x<?= $GLOBALS['plugin']->getBaseID(); ?>_id=<?= $GLOBALS['plugin']->getSessionValue('id'); ?>');
} else {
    window.location.href='<?= $_SERVER['PHP_SELF']; ?>?TPL=113&x<?= $GLOBALS['plugin']->getBaseID(); ?>_preview=1&x<?= $GLOBALS['plugin']->getBaseID(); ?>_id=<?= $GLOBALS['plugin']->getSessionValue('id'); ?>';
}
//-->
</script>
<?php
}
?>
