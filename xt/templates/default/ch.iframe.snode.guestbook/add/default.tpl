{XT_load_css file="formmanager.css"}
{XT_load_css file="jquery-ui-theme.css"}

{if  $xt1500_add.error|@count > 0}{include file="includes/widgets/errorhandler.tpl" Message="Die fehlenden Felder sind rot markiert"|translate Title="Fehlende Eingaben"|translate ERRORS=$xt1500_add.error Options=",width:400"}{/if}
 
<form action="{$smarty.server.REQUEST_URI}" method="post" name="guestbook">
<div id="form_container">
<div class="form_separator">{"new entry"|livetranslate}</div>

<div class="formsublabel">{"email address"|livetranslate}:</div>
<input class="field" type="text" size="24" name="x{$BASEID}_email" value="{$xt1500_add.email}" />
<br clear="all" />
<div class="formsublabel">{"name"|livetranslate}:</div>
<input class="field" type="text" size="24" name="x{$BASEID}_name" value="{$xt1500_add.name}" />
<br clear="all" />

<div class="formsublabel">{"website"|livetranslate}:</div>
<input class="field" type="text" size="24" name="x{$BASEID}_website" value="{$xt1500_add.website}" />
<br clear="all" />

<div class="formsublabel">{"Comment"|livetranslate}:</div>
<textarea name="x{$BASEID}_comment" class="commenttxt">{$xt1500_add.comment}
</textarea>

<br clear="all" />
{if $xt1500_add.captcha == true}
<div class="formsublabel">&nbsp;</div>
{include file="includes/widgets/captcha.tpl" name="captcha_guestbook"}
{/if}

<br clear="all" />
<div class="formsublabel">&nbsp;</div>
<input type="submit" name="x{$BASEID}_submit" value="{'send comment'|translate}" />
<input type="hidden" name="x{$BASEID}_pseudoaction" value="AddEntry" />
</div>

</form>