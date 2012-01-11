{literal}
<script type="text/javascript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<div id="intro">
<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div class="content">
<h1>{$TPL_REAL_TITLE}</h1>
<p class="introduction">{"intro_text"|translate}</p>
</div>
<input type="hidden" name="x{$BASEID}_theme" value="" />
<input type="hidden" name="x{$BASEID}_file" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
</form>
</div>
