<form method="post" name="overview">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
{include file="includes/charfilter.tpl" form="overview"}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" width="40">&nbsp;</td>
  <td class="table_header" width="40">&nbsp;</td>
  <td class="table_header" width="50">ID</td>
  <td class="table_header" width="150">{"Title"|translate}</td>
  <td class="table_header">{"Content table"|translate}</td>
 </tr>
 {foreach from=$DATA item=OBJECT}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{
  actionIcon
      action="editObject"
      form="0"
      icon="pencil.png"
      perm="editobjects"
      title="Edit this object"
      object_id=$OBJECT.id
      target="slave1"
  }</td>
  <td class="row">{if $OBJECT.icon != ""}<img src="{$XT_IMAGES}icons/{$OBJECT.icon}" alt="{$OBJECT.title}"/>{else}<img src="{$XT_IMAGES}icons/help_grey.png" alt="{$OBJECT.title}"/>{/if}</td>
  <td class="row">{$OBJECT.id}&nbsp;</td>
  <td class="row">{
  actionLink
      action="editObject"
      form="0"
      target="slave1"
      perm="editobjects"
      text=$OBJECT.title
      object_id=$OBJECT.id
  }&nbsp;</td>
  <td class="row">{$OBJECT.content_table|truncate:30:"...":true}&nbsp;</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_object_id" />
<input type="hidden" name="x{$BASEID}_action" />
{include file="includes/navigator.tpl" form="overview"}
</form>