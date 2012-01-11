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
<ul id="packages">
 <li><input type="radio" name="x{$BASEID}_wizard" checked value="wz_ct">&nbsp;{"<b>Create</b> your own theme"|translate}</li>
 <li><input type="radio" name="x{$BASEID}_wizard" value="wz_st">&nbsp;{"<b>Switch</b> your site to another theme"|translate}</li>
 <li><input type="radio" name="x{$BASEID}_wizard" value="wz_dt">&nbsp;{"<b>Delete</b> an existing theme"|translate}</li>
 <li><input type="radio" name="x{$BASEID}_wizard" value="wz_ex">&nbsp;{"<b>Export</b> a theme"|translate}</li>
</ul>
</div>
<div id="control">
<input type="image" onclick="this.form.x{$BASEID}_action.value='goToNextStep';this.form.submit();" name="x{$BASEID}_wizard_submit" src="{$XT_IMAGES}installer/de/weiter.gif" />
</div>
<input type="hidden" name="x{$BASEID}_path" />
<input type="hidden" name="x{$BASEID}_action" />
</form>
