<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="overview">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="80">&nbsp;</td>
  <td class="table_header">{"Title"|translate}</td>
 </tr>
 {foreach from=$CATEGORIES item=CATEGORY}
 <tr>
  <td class="button">{
  actionIcon
      action="editCategory"
      icon="pencil.png"
      title="Edit category"
      category_id=$CATEGORY.id
      target="slave1"
      form="0"
  }{
  actionIcon
      action="deleteCategory"
      icon="delete.png"
      title="Delete category"
      form="overview"
      category_id=$CATEGORY.id
      ask="Are you sure you want to delete this category?"
  }</td>
  <td class="row" style="padding-left: 0px;">{
  actionLink
      action="editCategory"
      title="Edit category"
      category_id=$CATEGORY.id
      target="slave1"
      form="0"
      text=$CATEGORY.title
  }</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_newsletter_id" />
<input type="hidden" name="module" value="c" />
{include file="ch.iframe.snode.newsletter/admin/hiddenValues.tpl"}
</form>
