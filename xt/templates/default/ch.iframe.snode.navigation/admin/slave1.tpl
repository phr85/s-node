<form method="post" name="navigation" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div id="content">
<h1>{$TPL_REAL_TITLE}</h1>
<p id="introduction">{"intro_text"|translate}</p>
<br clear="all" />
<div><img src="{$XT_IMAGES}admin/tipps/ch.iframe.snode.navigation/tipp1.gif" alt="" class="tipp"/>{"tipp1"|translate}<br /><br /><br /><br /></div>
<br clear="all" />
<div><img src="{$XT_IMAGES}admin/tipps/ch.iframe.snode.navigation/tipp2.gif" alt="" class="tipp"/>{"tipp2"|translate}<br /><br /><br /><br /></div>
<input type="hidden" name="x{$BASEID}_step" value="1" />
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_node_perm_pid" />
<input type="hidden" name="x{$BASEID}_node_perm_id" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_active" value="" />
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_target_module" value="" />
<input type="hidden" name="TPL" value="{$TPL}" />
{yoffset}
<br clear="all" />
</div>
</form>
{literal}
<script language="JavaScript" type="text/javascript"><!--
if(window.parent.frames['master'].document.forms[1]){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}