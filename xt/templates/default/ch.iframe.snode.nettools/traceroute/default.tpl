<form name="searchform" id="searchform" method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<fieldset>
<legend>{"traceroute"|livetranslate}</legend>
<input type="text" name="x{$BASEID}_traceroute" size="50" value="{$USER_INPUT}" />&nbsp;<input type="submit" value="{'start'|translate}" /><br/>
{if $RESULT != ""}
<br/><br/>
<div style="background-color: #EEEEEE; padding: 15px; border: 1px solid #BBBBBB;">
<pre>{$RESULT}</pre>
</div>
{/if}
</fieldset>
</form> 