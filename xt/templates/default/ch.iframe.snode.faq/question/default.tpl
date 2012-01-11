<h1>{"Ask a question"|livetranslate}</h1>
<div id="form_container">
	<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="poll" class="poll">
		<div class="form_separator">{"Personal Data"|translate}</div>
		<div class="faqInput">
			<div class="formlabel">{"Name"|livetranslate}</div>
			<div class="formelement">
				{if $xt1400_question.error.name != ""}<span class="faqError">{$xt1400_question.error.name}</span>{/if}<input type="text" value="{$xt1400_question.content.name}" name="x{$BASEID}_name" {if $xt1400_question.error.name != ""}style="border: 1px solid red;"{/if} />
			</div>
		</div>
		<div class="faqInput">
			<div class="formlabel">{"Email"|livetranslate}</div>
			<div class="formelement">
				{if $xt1400_question.error.email != ""}<span class="faqError">{$xt1400_question.error.email}</span>{/if}
				<input value="{$xt1400_question.content.email}" type="text" name="x{$BASEID}_email" {if $xt1400_question.error.email != ""}style="border: 1px solid red;"{/if} />
			</div>
		</div>
		<br clear="all" />
		<div class="form_separator">{"Question"|translate}</div>
		<div class="faqInput">
			<div class="formlabel">{"Question title"|livetranslate}</div>
			<div class="formelement">
				{if $xt1400_question.error.title != ""}<span class="faqError">{$xt1400_question.error.title}</span>{/if}
				<input value="{$xt1400_question.content.title}" type="text" name="x{$BASEID}_title" {if $xt1400_question.error.title != ""}style="border: 1px solid red;"{/if}/>
			</div>
		</div>
		<div class="faqInput">
			<div class="formlabel">{"Text"|livetranslate}</div>
			<div class="formelement">
				{if $xt1400_question.error.message != ""}<span class="faqError">{$xt1400_question.error.message}</span>{/if}
				<textarea rows="10" cols="30" class="faq" name="x{$BASEID}_message" {if $xt1400_question.error.message != ""}style="border: 1px solid red;"{/if}>{$xt1400_question.content.message}</textarea>
			</div>
			<br clear="all" />
		</div>
		<br clear="all" />
		<br clear="all" />
		<div class="formlabel">&nbsp;</div>
			<div class="formelement">
				<div class="faqCaptcha{if $xt1400_question.error.captcha != ""}Error{/if}">
				{if $xt1400_question.captcha == true}
					{include file="includes/widgets/captcha.tpl" name="captcha_faq"}<br clear="all" />
					{if $xt1400_question.error.captcha != ""}<span class="faqCaptchaError"><br />{"Captcha error"|livetranslate}</span>{/if}
				{/if}
			</div>
		</div>
		<br clear="all" />
		<input type="button" name="x{$BASEID}_submit" value="{"Vote"|translate}" {literal}onclick="this.form.submit();"{/literal} />
		<input type="hidden" name="x{$BASEID}_pseudoaction" value="ask" />
		<br clear="all" />
	</form>
</div>