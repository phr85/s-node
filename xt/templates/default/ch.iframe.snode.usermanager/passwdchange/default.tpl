<form method="POST" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="passwdchange">

<div id="form_container">
<div class="form_separator">{"Set new password"|livetranslate}</div>

<div class="formsublabel">{"Password"|translate}</div>
<input {if $xt110_passwdchange.errors.password}class="form_error" {/if}type="password" name="x{$BASEID}_password" />
<br clear="all" />
<div class="formsublabel">{"Repeat Password"|translate}</div>
<input {if $xt110_passwdchange.errors.password}class="form_error" {/if}type="password" name="x{$BASEID}_password_repeat" />
<br clear="all" />

{if $xt110_passwdchange.errors.password}
<div class="formsublabel">&nbsp;</div>
{$xt110_passwdchange.errors.password}
{/if}

{if $xt110_passwdchange.messages.password}
<div class="formsublabel">&nbsp;</div>
{$xt110_passwdchange.messages.password}
{/if}

<br clear="all" />
<div class="formsublabel">&nbsp;</div>
<input type="submit" name="x{$BASEID}_submit" value="{"change password"|translate}" />

</form>
</div>