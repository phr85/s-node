<script type="text/javascript" src="/scripts/autosuggest/bsn.AutoSuggest_c_2.0.js"></script>
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="create">
{actionIcon action="LiveSaveRecipe" icon="save.png" title="Save" label="Save" form="create"}
{actionIcon action="LivePublish" icon="check.png" title="Publish" label="Publish" form="create"}

<table cellspacing="0" cellpadding="0" width="100%">
{include file="ch.iframe.snode.rezepte/user_edit/edit/basics.tpl"}
{include file="ch.iframe.snode.rezepte/user_edit/edit/ingridients.tpl"}
</table>
{"to add more ingridents press save"|translate} <br />
{actionIcon action="LiveSaveRecipe" icon="save.png" title="Save" label="Save" form="create"}

<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_id" value="{$DATA.id}" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_ingridient_id" value="" />
{yoffset}
</form>
{include file="includes/editor_live.tpl"}