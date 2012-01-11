{print_data array=$xt8300_add}
<h1>{"Ihr Termin wurde erstellt"|livetranslate}</h1>
<p>&nbsp;</p>
<h2>Titel: {$xt8300_add.values.title}</h2>
<p>&nbsp;</p>
<p>{"You can start spreading the link"|livetranslate}</p>
<p>URL: <a href="/index.php?TPL={$xt8300_add.viewerTpl}&x{$BASEID}_url={$xt8300_add.values.url}">{$smarty.server.SERVER_NAME}/index.php?TPL={$xt8300_add.viewerTpl}&x{$BASEID}_url={$xt8300_add.values.url}</a></p>
<p>&nbsp;</p>
<h3>{"Chosen Dates"|livetranslate}</h3>
{foreach from=$xt8300_selecteddates item="date"}
	<p>{$date|date_format:"%a, %d.%m.%Y"}</p>
	{foreach from=$xt8300_times item="time" name="times"}
		<p>{if $time.0 == $date AND $time.2 != ""}{$time.2}{/if}</p>
	{/foreach}
<p>&nbsp;</p>
{/foreach}