{literal}
<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
window.parent.frames['slave2'].document.forms[0].submit();
//-->
</script>
{/literal}
<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div id="content">
<h1>{$TPL_REAL_TITLE|htmlspecialchars}</h1>
<p id="introduction">{"intro_text"|translate}</p>

<div id="tipp"><img src="{$XT_IMAGES}admin/tipps/ch.iframe.snode.filemanager/tipp1.gif" alt="" class="tipp"/>{"tipp1"|translate}</div>
<br clear="all" />
</div>
<input type="hidden" name="x{$BASEID}_action" />
<input type="hidden" name="x{$BASEID}_node_id" />
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_file_id" />
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}" />
</form>