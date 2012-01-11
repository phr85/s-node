<h1>{"Tragen Sie sich ein"|livetranslate}</h1>
<p>&nbsp;</p>
<h2>Titel: {$xt8300_appointment.title}</h2>
<p>&nbsp;</p>
<h4>Beschreibung: {$xt8300_appointment.description}</h4>
<p>&nbsp;</p>
<h4>Die Abstimmung geht noch bis zum {$xt8300_appointment.end_date|date_format:"%a, %d.%m.%Y"}</h4>
<p>&nbsp;</p>
<h3>{"Chosen Dates"|livetranslate}</h3>
{print_data array=$xt8300_times}
<table>
	{foreach from=$xt8300_dates item="date"}
		{$date|date_format:"%a, %d.%m.%Y"}
		<br />
				{foreach from=$xt8300_times item="time"}
					{if $date|date_format:"%M" == $time.timestamp|date_format:"%M"}CHECK{/if}
					{if $date == $time.timestamp}{$time.value}{/if}
				{/foreach}
		<br />
		<br />
	{/foreach}
</table>

{if $xt8300_error != ""}<p class="error">{$xt8300_error}</p>{/if}