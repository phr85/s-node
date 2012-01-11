<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div id="content" style="font-weight: bold;">
<h1>POLL Auswertung</h1><br /><br />
Die Auswertung ist noch nicht Abgeschlossen.<br /><br /><br />

Bitte warten Sie bis der Endzeitpunkt gekommen ist
</div>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_node_id" />
<input type="hidden" name="x{$BASEID}_poll_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_position" />
</form>


{if $LIVEEDIT}
<script type="text/javascript"><!--
window.opener.location.reload();
window.close();
//-->
</script>
{else}
{literal}
<script type="text/javascript"><!--
if(window.parent.frames['master'].document.forms[1]){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
{/if}
