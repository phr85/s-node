<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div id="content">
<h1>{$TPL_REAL_TITLE}</h1>
<p class="introduction">{"intro_text"|translate}</p>
</div>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
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
