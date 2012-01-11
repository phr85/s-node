<form name="searchform" id="searchform" method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<fieldset>
<legend>{"nslookup"|livetranslate}</legend>
<input type="text" name="x{$BASEID}_nslookup" size="50" value="{$USER_INPUT}" />&nbsp;
<select name="x{$BASEID}_nslookup_type">
	<option value="default" {if $TYPE == "default"}selected{/if}>{"default"|translate}</option>
	<option value="any" {if $TYPE == "any"}selected{/if}>{"ANY"|translate}</option>
	<option value="reverse" {if $TYPE == "reverse"}selected{/if}>{"reverse"|translate}</option>
	<option value="trace" {if $TYPE == "trace"}selected{/if}>{"trace"|translate}</option>
</select>
&nbsp;
<input type="submit" value="{'nslookup'|translate}" /><br/>
{if $RESULT != ""}
<br/><br/>
<div style="background-color: #EEEEEE; padding: 15px; border: 1px solid #BBBBBB;">
<pre>{$RESULT}</pre>
</div>
{/if}
</fieldset>
</form> 