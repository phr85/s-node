{print_data array=$xt8300_viewer}
<h1>{"Appointment"|livetranslate} {$xt8300_viewer.title}</h1>
<br />
<p>{$xt8300_viewer.appointmentData.description}</p>
<div class="appointmentTable">
	<table>
		<tr class="dates">
		{foreach from=$xt8300_viewer.months item=months name=months key=key}
			{$months}
			{foreach from=$xt8300_viewer.appointmentData.selected_days item=days name=days key=daysKey}
				<td>{$days|date_format:"%a, %d.%m.%Y"}</td>
			{/foreach}
		{/foreach}
		</tr>
		<tr class="times">
			{foreach from=$xt8300_viewer.frontDates item=datum name=daten key=datesKey}
				{foreach from=$datum item=times name=times}
					<td>{$times}</td>
					{if $smarty.foreach.times.iteration == $xt8300_viewer.numberOfDays}
						</tr>
						<tr>
					{/if}
				{/foreach}
			{/foreach}
		</tr>
	</table>
</div>
