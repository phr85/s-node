<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<h2>{$CATEGORY.title}</h2>

{if $SUBSCRIPTION_TRY && $SUBSCRIPTION_OK}
<div style="color: green;">{"Thank you for your subscription"|translate}<br /><b>{$SUBSCRIPTION_EMAIL}</b><br /><br /></div>
{/if}
{if $SUBSCRIPTION_TRY && !$SUBSCRIPTION_OK}
{include file="includes/widgets/errorhandler.tpl" Title="Newsletter Registrierung"|translate Options=",width:400" ERRORS=$ERROR }
{/if}

<input type="text" name="x{$BASEID}_email" value="{$SUBSCRIPTION_EMAIL}" />
<input type="submit" name="x{$BASEID}_subscribe" value="{'Subscribe'|translate}" />
<input type="hidden" name="x{$BASEID}_lang" value="de" />
<input type="submit" name="x{$BASEID}_unsubscribe" value="{'Unsubscribe'|translate}" />
</form>
{literal}
{/literal}
