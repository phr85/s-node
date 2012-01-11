{XT_load_css file="ch.iframe.snode.messages.css"}
{XT_load_js file="ch.iframe.snode.messages/comp_messages.js"}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="XTMSGform">
<div class="XTMSGcomp">
	<div id="XTMSGhead">
		{include file="ch.iframe.snode.messages/comp_messages/sections/mailfolders.tpl"}
	</div>
	<div id="XTMSGbuttons">
		{include file="ch.iframe.snode.messages/comp_messages/sections/buttons.tpl"}
	</div>
	<div id="XTMSGbody">
		{include file="ch.iframe.snode.messages/comp_messages/sections/body.tpl"}
	</div>

</div>
<input type="hidden" name="x{$BASEID}_action" value="" />
</form>