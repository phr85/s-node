<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div id="content">
{subplugin package="ch.iframe.snode.articles" module="viewer" id="38" style="default.tpl" ncpos="1"}
</div>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_poll_id" value="" />
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" value="{$smarty.server.HTTP_REFERER}" name="x{$BASEID}_request" />
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
