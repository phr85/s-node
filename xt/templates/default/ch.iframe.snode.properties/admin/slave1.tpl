{literal}
<style type="text/css">
@import url("{/literal}{$XT_STYLES}{literal}installer/default.css");
#introduction {
    width: 100%;
}
</style>
{/literal}
<form method="POST" name="slave1">
<div id="content">
<h1>{"Properties"|translate}</h1>
<p id="introduction">{"intro_text"|translate}</p>

</div>
{include file="ch.iframe.snode.properties/admin/hiddenValues.tpl"}
</form>