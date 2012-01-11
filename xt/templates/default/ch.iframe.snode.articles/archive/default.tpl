<span class="archive">{"Select a month"|livetranslate}</span>
<form name="form" action="/index.php?TPL={$TPL}" method="POST" onChange="document.forms['form'].submit()">
	<select name="x{$BASEID}_month">
	<option value="">{"Please Select"|livetranslate}</option>
	{foreach from=$xt270_archive item=ARCHIVE}
		<option {if $ARCHIVE.selected}selected{/if} value="{$ARCHIVE.value}">{$ARCHIVE.monat}, {$ARCHIVE.jahr}</option>
	{/foreach}
	</select>
	<input type="submit" value="{"Absenden"|livetranslate}"/>
</form>