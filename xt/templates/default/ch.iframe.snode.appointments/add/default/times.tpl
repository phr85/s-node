{XT_load_css file="appointments.css"}
<h1>{$xt8300_values.title}</h1>
<h3>{"Wählen Sie die gewünschte Zeit aus"|livetranslate}</h3>
{if $xt8300_errors != ""}<p style="color: red;">{$xt8300_errors}</p>{/if}
<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="dates" class="dates">
	<table id="times">
		<tr class="times">
			<td class="date">&nbsp;</td>
			<td class="time">Zeit 1</td>
			<td class="time">Zeit 2</td>
			<td class="time">Zeit 3</td>
			<td class="time">Zeit 4</td>
		</tr>
				<script type="text/javascript">
					var dates = new Array();
					var baseid = {$BASEID};
					</script>
		{foreach from=$xt8300_values.date item="date" name="dates"}
			<tr id="times{$smarty.foreach.dates.iteration}">
				<td>{$date|date_format:"%a, %d.%m.%Y"}</td>
				<td><input class="time" type="text" name="x{$BASEID}_{$date}_1" /></td>
				<td><input class="time" type="text" name="x{$BASEID}_{$date}_2" /></td>
				<td><input class="time" type="text" name="x{$BASEID}_{$date}_3" /></td>
				<td><input class="time" type="text" name="x{$BASEID}_{$date}_4" /></td>
			</tr>
			{literal}
				<script type="text/javascript">
					dates[{/literal}{$smarty.foreach.dates.iteration}] = "{$date}"{literal};
	      			var counter;
		  			counter = 4;
				</script>
			{/literal}
			{if $smarty.foreach.dates.last}{literal}
				<script type="text/javascript">
					var numberOfDates = {/literal}{$smarty.foreach.dates.iteration};{literal}
				</script>{/literal}
			{/if}
		{/foreach}
		<div id='divTxt'></div>
	</table>
	<br />
	<p id="buttons">
		<a href="#" id="add" onclick="add_tr1()">Add</a>
	</p>
	<br />
	<br />
	<input type="button" name="x{$BASEID}_submit" value="{"Create Appointment"|translate}" {literal}onclick="this.form.submit();"{/literal} />
	<input type="hidden" name="x{$BASEID}_XT_autoaction[1]" value="check_times" />
	<input type="hidden" name="x{$BASEID}_numberOfTimes" value="4" id="numberOfTimes" />

{literal}
	<script type="text/javascript">
	  function add_tr1() {
			if (counter == 4) {
	      		$("#buttons").append("<a href='#' id='remove' onclick='del_tr()'>Remove</a>");
			}
	  		counter++;
	  		$("#numberOfTimes").val(counter);
	      	$(".times").append("<td class='time" + counter + "'>Zeit " + counter + "</td>");
	      	var i = 1;
	      	for (i=1;i<=numberOfDates;i++)
			{
			      $("#times" + i).append("<td class='" + dates[i] + "_" + counter +"'><input class='time' id='time" + dates[i] + "_" + counter + "' type='text' name='x" + baseid + "_" + dates[i] + "_" + counter + "' /></td>");
			}
			
	  }

	  function del_tr() {
	  		$('.time' + counter).remove();
	  		for (i=1;i<=numberOfDates;i++)
			{
			      $('.' + dates[i] + "_" + counter).remove();
			}
			counter--;
	  		$("#numberOfTimes").val(counter);
			if (counter == 4) {
				$('#remove').remove();
			}
	  }
	  
	</script>
{/literal}
</form>