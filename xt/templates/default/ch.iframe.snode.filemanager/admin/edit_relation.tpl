<form method="POST">
<input type="hidden" name="x{$BASEID}_target_content_id" value="0" />
{include file="includes/buttons.tpl" data=$EDIT_RELATION_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Target content type"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_target_content_type" onChange="document.forms[0].x{$BASEID}_action.value='saveRelation';document.forms[0].submit();">
    <option value="0">-- {"Please choose"|translate} --</option>
    {foreach from=$CONTENT_TYPES item=CONTENT_TYPE}
    <option value="{$CONTENT_TYPE.id}" {if $RELATION.target_content_type == $CONTENT_TYPE.id}selected{/if}>{$CONTENT_TYPE.title}</option>
    {/foreach}
   </select>
  </td>
 </tr>
 {if $RELATION.target_content_type != 0}
 <tr>
  <td class="left">{"Select content"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_target_content_id">
    <option value="0">-- {"Please choose"|translate} --</option>
    {foreach from=$CONTENT_ELEMENTS item=CONTENT_ELEMENT}
    <option value="{$CONTENT_ELEMENT.content_id}" {if $RELATION.target_content_id == $CONTENT_ELEMENT.content_id}selected{/if}>{$CONTENT_ELEMENT.title}</option>
    {/foreach}
   </select>
  </td>
 </tr>
 {/if}
</table>
<input type="hidden" name="x{$BASEID}_node_id" />
<input type="hidden" name="x{$BASEID}_node_pid" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_file_id" value="{$RELATION.content_id}" />

<input type="hidden" name="x{$BASEID}_before_content_type" value="{$RELATION.target_content_type}" />
<input type="hidden" name="x{$BASEID}_before_content_id" value="{$RELATION.target_content_id}" />
</form>
