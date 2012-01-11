{XT_load_css file="formmanager.css"}
{XT_load_css file="jquery-ui-theme.css"}
{XT_load_css file="appointments.css"}

{if count($ERRORS) > 0}{include file="includes/widgets/errorhandler.tpl" Message="Die fehlenden Felder sind rot markiert"|translate Title="Fehlende Eingaben"|translate Options=",width:400"}{/if}
<h1>{"Skip this step"|livetranslate}</h1>
<br />
<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="invites" class="appointment">
	<input type="button" name="x{$BASEID}_submit" value="{"Skip invites"|translate}" {literal}onclick="this.form.submit();"{/literal} />
	<input type="hidden" name="x{$BASEID}_XT_autoaction[1]" value="dont_check_attendants" />
</form>
<br />
<h1>{"Invite People To:"|livetranslate} {$xt8300_inputvalues.title}</h1>

<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="invites" class="appointment">
<p><input class="attendantMisc" type="text" name="x{$BASEID}_attendant_name" value="{$xt8300_inputvalues.name}"/> Name</p>
<p><input class="attendantMisc" type="text" name="x{$BASEID}_attendant_email" value="{$xt8300_inputvalues.email}"/> Email</p>
<br />
<strong>{"Invite Attendants"|livetranslate}</strong>
<br />
	<div class="appointmentWrapper">
	{if $xt8300_add.attendantCount == ""}
			<div class='attendant'><input class="attendant" type="text" name="x{$BASEID}_attendant[]" /></div>
			<div class='attendant'><input class="attendant" type="text" name="x{$BASEID}_attendant[]" /></div>
			<div class='attendant'><input class="attendant" type="text" name="x{$BASEID}_attendant[]" /></div>
			<div class='attendant'><input class="attendant" type="text" name="x{$BASEID}_attendant[]" /></div>
	{else}
		{foreach from=$xt8300_add.attendants item=attendant}
			<div class='attendant'><input value="{$attendant.value}" class="attendant{if $attendant.error}Error{/if}" type="text" name="x{$BASEID}_attendant[]" /></div>
		{/foreach}
	{/if}
	</div>
{literal}
	<script type="text/javascript">
			var counter;
			counter = 4;
			var baseid = {/literal}{$BASEID}{literal};
	</script>
{/literal}
{literal}
	<script type="text/javascript">
	  function add_tr1() {
			if (counter == 4) {
	      		$("#buttons").append("<a href='#' id='remove' onclick='del_tr(); return false;'>Remove</a>");
			}
	  		counter++;
	      	$(".appointmentWrapper").append("<div class='attendant'><input class='attendant_" + counter + "' name='x" + baseid + "_attendant[]'></div>");
	  }

	  function del_tr() {
	  		$(".attendant_" + counter).remove();
			counter--;
			if (counter == 4) {
				$('#remove').remove();
			}
	  }
	</script>
{/literal}
<p id="buttons">
	<a href="#" id="add" onclick="add_tr1();return false;">Add</a>
</p>
<p>
	<a href="#">{"Import Adresses"|livetranslate}</a>
</p>
<br />
<p>{"Privacy settings"|livetranslate}</p>
<p>{"Privacy description"|livetranslate}</p>
<input type="radio" name="x{$BASEID}_privacyOn" />
<input type="radio" name="x{$BASEID}_privacyOn" />

<br />
<p>{"Enter Own Mailtext If You Want"|livetranslate}</p>
<br />
<textarea id="inviteText" name="x{$BASEID}_customMail" cols="50" rows="10">
{"Custom Mail Text"|livetranslate}
</textarea>
<br />
<a href="#" onclick="document.getElementById('inviteText').value=''; return false;">{"reset"|livetranslate}</a>
<br />
<br />
<input type="button" name="x{$BASEID}_submit" value="{"Send invites"|translate}" {literal}onclick="this.form.submit();"{/literal} />
<input type="hidden" name="x{$BASEID}_XT_autoaction[1]" value="check_attendants" />
</form>