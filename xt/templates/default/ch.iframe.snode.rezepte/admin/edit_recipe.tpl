<script type="text/javascript" src="/scripts/autosuggest/bsn.AutoSuggest_c_2.0.js"></script>

<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="editRecipe" onSubmit="window.document.forms['editRecipe'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<a name="top" />
{include file="includes/lang_selector_submit.tpl" form="editRecipe" action="saveRecipe"}
<!-- {inline_navigator data=$INLINE_NAVIGATION} -->
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light"> {"Product"|translate}: </span><span class="title"> {$DATA.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_RECIPE_BUTTONS withouthidden=1}

<table cellspacing="0" cellpadding="0" width="100%">
{include file="ch.iframe.snode.rezepte/admin/edit_recipe/basics.tpl"}
{include file="ch.iframe.snode.rezepte/admin/edit_recipe/ingridients.tpl"}
{include file="ch.iframe.snode.rezepte/admin/edit_recipe/images.tpl"}

<tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Relations"|translate}</span>
  </td>
</tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
{include file="includes/widgets/relations.tpl" cid=$DATA.id ctitle=$DATA.title}
</table>


{if $FOCUS.segment != ''}
<img src="{$XT_IMAGES}spacer.gif" onLoad="anchor('{$FOCUS.segment}');" width="1" />
{/if}
{if $FOCUS.field != ''}
<img src="{$XT_IMAGES}spacer.gif" onLoad="document.forms['editRecipe'].{$FOCUS.field}.focus();" width="1" />
{/if}
{if $PICKER > 0}
<img src="{$XT_IMAGES}spacer.gif" onLoad="popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image_{$PICKER}&x{$IMAGE_PICKER_BASE_ID}_form=editRecipe',770,470,'picker');" width="1" />
{/if}


{include file="ch.iframe.snode.rezepte/admin/hiddenValues.tpl"}
</form>
{include file="includes/editor.tpl"}