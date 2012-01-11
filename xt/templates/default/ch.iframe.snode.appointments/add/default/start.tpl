{XT_load_css file="appointments.css"}
{XT_load_js file="date.js"}
{XT_load_js file="jquery.datePicker.js"}
{literal}
<!-- Attach the datepicker to dateinput after document is ready -->
<script type="text/javascript" charset="utf-8">
	$(function()
	{
		$('.datepickerInline')
			.datePicker(
				{
					inline: true,
					createButton:false,
					selectMultiple:true
				}
			)
			.bind(
				'click',
				function()
				{
					this.blur();
					return false;
				}
			)
			.bind(
				'dateSelected',
				function(e, selectedDate, $td, state)
				{
					$('#datesPicked').load("/ajax.php?package=ch.iframe.snode.appointments&module=dateselect",{x8300_datearray : String($('.datepickerInline').dpGetSelected())});
				}
			)
	});
</script>
{/literal}
{if $xt8300_add.loggedin == 0}
	<p>{"Not logged in"|livetranslate}</p>
	<p>{"Register"|livetranslate}</p>
{/if}
<h1>{"Add an appointment"|livetranslate}</h1>
<div id="form_container">
	<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="appointment" class="appointment">
		<div class="form_separator">{"Personal Data"|translate}</div>
		<div class="faqInput">
			<div class="formlabel">{"Name"|livetranslate}</div>
			<div class="formelement">
				<input type="text" value="{$xt8300_add.content.name}" name="x{$BASEID}_name" {if $xt8300_add.error.name != ""}style="border: 1px solid red;"{/if} />{if $xt8300_add.error.name != ""}<span class="faqError">{$xt8300_add.error.name}</span>{/if}
			</div>
		</div>
		<div class="faqInput">
			<div class="formlabel">{"Email"|livetranslate}</div>
			<div class="formelement">
				<input value="{$xt8300_add.content.email}" type="text" name="x{$BASEID}_email" {if $xt8300_add.error.email != ""}style="border: 1px solid red;"{/if} />{if $xt8300_add.error.email != ""}<span class="faqError">{$xt8300_add.error.email}</span>{/if}
			</div>
		</div>
		<br clear="all" />
		<div class="form_separator">{"Appointment"|translate}</div>
		<div class="faqInput">
			<div class="formlabel">{"Title"|livetranslate}</div>
			<div class="formelement">
				<input value="{$xt8300_add.content.title}" type="text" name="x{$BASEID}_title" {if $xt8300_add.error.title != ""}style="border: 1px solid red;"{/if}/>{if $xt8300_add.error.title != ""}<span class="faqError">{$xt8300_add.error.title}</span>{/if}
			</div>
		</div>
		<br clear="all" />
		<div class="faqInput">
			<div class="formlabel">{"Visible to others?"|livetranslate}</div>
			<div class="formelement">
				<input type="checkbox" value="true" name="x{$BASEID}_visibility" />
			</div>
		</div>
		<br clear="all" />
		<div class="formlabel">{"Date"|livetranslate}</div>
		<div class="formelement">
			<div class="datepickerInline"> </div>{if $xt8300_add.error.date != ""}<span class="faqError">{$xt8300_add.error.date}</span>{/if}
			<div class="datesPicked"><b>{"Selected dates"|livetranslate}</b>
				<div id="datesPicked"> </div>
			</div>
		</div>
		<br clear="all" />
		<div class="faqInput">
			<div class="formlabel">{"Description"|livetranslate}</div>
			<div class="formelement">
				<textarea rows="10" cols="30" class="faq" name="x{$BASEID}_description">{$xt8300_add.content.description}</textarea>
			</div>
			<br clear="all" />
		</div>
		<br clear="all" />
		<div class="faqInput">
			<div class="formlabel">{"Ort (Optional)"|livetranslate}</div>
			<div class="formelement">
				<label>{"Street/Nr."|livetranslate}</label>&nbsp;<input value="{$xt8300_add.content.street}" size="10" type="text" name="x{$BASEID}_street" />
				<input value="{$xt8300_add.content.housenumber}" size="3" type="text" name="x{$BASEID}_housenumber" />
				<label>{"City"|livetranslate}</label>&nbsp;<input value="{$xt8300_add.content.city}" size="10" type="text" name="x{$BASEID}_city" />
				{if {$xt8300_add.content.adressnotfound != ""}<span style="color: red;">{$xt8300_add.content.adressnotfound}</span>{/if}
			</div>
			<br clear="all" />
		</div>
		<br clear="all" />
		<br clear="all" />
		<div class="formlabel">&nbsp;</div>
			<div class="formelement">
				<div class="faqCaptcha{if $xt8300_add.error.captcha != ""}Error{/if}">
				{if $xt8300_add.captcha == true}
					{include file="includes/widgets/captcha.tpl" name="captcha_faq"}<br clear="all" />
					{if $xt8300_add.error.captcha != ""}<span class="faqCaptchaError"><br />{"Captcha error"|livetranslate}</span>{/if}
				{/if}
			</div>
		</div>
		<br clear="all" />
		<input type="button" name="x{$BASEID}_submit" value="{"Continue"|translate}" {literal}onclick="this.form.submit();"{/literal} />
		<input type="hidden" name="x{$BASEID}_XT_autoaction[1]" value="check_values" />
		<br clear="all" />
	</form>
</div>