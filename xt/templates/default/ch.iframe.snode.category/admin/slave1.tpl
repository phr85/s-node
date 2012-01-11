{literal}
<style type="text/css">
@import url("{/literal}{$XT_STYLES}{literal}installer/default.css");
#introduction {
    width: 100%;
}
</style>
{/literal}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post"  name="slave1">
<div id="content">
<h1>{"Catalog"|translate}</h1>
<p id="introduction">{"intro_text"|translate}</p>



{include file="ch.iframe.snode.category/admin/hiddenValues.tpl"}

</div>
</form>

<script language="javascript" type="text/javascript"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x{$BASEID}_yoffset.value=yoffset
setTimeout("window.parent.frames['master'].document.forms[1].submit()",200);

//-->
</script>

