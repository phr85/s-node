<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div id="content">
<h1>{$TPL_REAL_TITLE}</h1>
<p class="introduction">{"intro_text"|translate}</p>
</div>
{include file="ch.iframe.snode.faq/admin/hiddenValues.tpl"}
</form>