{literal}
<style type="text/css">
@import url("{/literal}{$XT_STYLES}{literal}installer/default.css");
#introduction {
    width: 100%;
}
</style>
{/literal}
{literal}
<script language="JavaScript"><!--
if(window.parent.frames['master'].document.forms[1]){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form method="post" name="slave1">
<div id="content">
<h1>{$TPL_REAL_TITLE}</h1>
<p id="introduction">{"intro_text"|translate}</p>
</div>


<input type="hidden" name="x{$BASEID}_content_type" value="" />
<input type="hidden" name="x{$BASEID}_content_id" value="" />
<input type="hidden" name="x{$BASEID}_target_content_type" value="" />
<input type="hidden" name="x{$BASEID}_target_content_id" value="" />
<input type="hidden" name="x{$BASEID}_relation_id" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
</form>
