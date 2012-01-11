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
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form method="post">
<div id="content">
<h1>{$TPL_REAL_TITLE}</h1>
<p id="introduction">{"intro_text"|translate}</p>
</div>
<div id="tipp"><img src="{$XT_IMAGES}admin/tipps/ch.iframe.snode.banner/tipp1.gif" alt="" class="tipp"/>{"tipp1"|translate}</div>
<input type="hidden" name="x{$BASEID}_action" />
<input type="hidden" name="x{$BASEID}_zone_id" />
</form>
