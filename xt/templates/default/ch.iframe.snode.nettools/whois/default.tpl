<form name="searchform" id="searchform" method="POST" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<fieldset>
<legend>{"WHOIS"|livetranslate}</legend>
<input type="text" name="x{$BASEID}_whois" size="50" value="{$USER_INPUT}">&nbsp;<input type="submit" value="{'Request domain name or ip adress'|translate}" />
{if $RESULT != ""}
<br/><br/>
<div style="background-color: #EEEEEE; padding: 15px; border: 1px solid #BBBBBB;">
<pre>{$RESULT}</pre>
</div>
{/if}
</fieldset>
</form> 