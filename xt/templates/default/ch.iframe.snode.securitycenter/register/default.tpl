{if !$AJAXMODE}
{XT_load_css file="formmanager.css"}
{XT_load_css file="jquery-ui-theme.css"}
{XT_load_js file="ch.iframe.snode.securitycenter/registration.js"}
{XT_load_js file="jquery.form.js"}
{XT_load_js file="jquery-ui/ui.dialog.js"}{XT_load_js file="jquery-ui/ui.draggable.js"}
{*
{XT_get_param param="autologin" assign="autologin"}
{XT_get_param param="redirect_tpl" assign="redirect_tpl"}
{XT_get_param param="group" assign="group"}
{XT_get_param param="role" assign="role"}
{XT_get_param param="style" assign="style"}
*}


<div id="registration_body" >
{/if}
{if $xt100_register.ERRORS|@count > 0}
{include file="includes/widgets/errorhandler.tpl" Message="Sie haben nicht alle erforderlichen Felder ausgefüllt"|translate Title="Fehlende Eingaben"|translate Options=",width:500" ERRORS=$xt100_register.ERRORS}
{/if}

{if $REGISTRED == 1}
{"You are successfully registred."|livetranslate}
{else}
<form method="POST" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="register" id="register">

<div id="form_container">
<div class="form_separator">{"Username and Password"|livetranslate}</div>

<div class="formsublabel">{"Username"|translate}</div>
<input {if $xt100_register.ERRORS.username} class="form_error"{/if} type="text" name="x{$BASEID}_username" id="x{$BASEID}_username" value="{$xt100_register.username}" />
<br clear="all" />
<div class="formsublabel">{"Password"|translate}</div>
<input {if $xt100_register.ERRORS.password} class="form_error"{/if} type="password" name="x{$BASEID}_password" id="x{$BASEID}_password" value="{$xt100_register.password}" />
<br clear="all" />
<div class="formsublabel">{"Repeat Password"|translate}</div>
<input {if $xt100_register.ERRORS.password} class="form_error"{/if} type="password" name="x{$BASEID}_password_repeat" id="x{$BASEID}_password_repeat" value="{$xt100_register.password_repeat}">
<br clear="all" />
<div class="formsublabel">{"E-Mail"|translate}</div>
<input {if $xt100_register.ERRORS.email} class="form_error"{/if} type="text" name="x{$BASEID}_email" id="x{$BASEID}_email" value="{$xt100_register.email}" />
<br clear="all" />
<br clear="all" />



<div class="formsublabel">&nbsp;</div>
<input type="submit" name="x{$BASEID}_submit" value="{"Register"|translate}" />
<br clear="all" />
<input type="hidden" name="x{$BASEID}_pseudoaction" value="register">
</form>
</div>
{/if}


{if !$AJAXMODE}
</div>
{/if}