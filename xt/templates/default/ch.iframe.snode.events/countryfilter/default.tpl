{if sizeof($DATA) > 0}
<form action="{$smarty.server.PHP_SELF}">
<h1>{"COUNTRY"|translate}</h1>
<select onchange="submit();" name="x{$BASEID}_country">

<option {if $SELECTED==0}selected="selected"{/if} value="unset">
{"show all"|translate}
</option>


{foreach from=$DATA item=COUNTRY name=N}
<option {if $SELECTED==$COUNTRY.country}selected="selected"{/if} value="{$COUNTRY.country}">
{$COUNTRY.name}
</option>
{/foreach}
</select>
<input type="hidden" name="TPL" value="{$TPL}"
</form>
{/if}
