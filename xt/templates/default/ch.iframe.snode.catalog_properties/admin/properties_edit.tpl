<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="property_edit">
{include file="includes/buttons.tpl" data=$PROPERTIE_EDIT_BUTTONS}

<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Property"|translate}:</span><span class="title"> {$DATA.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>


{include file="includes/lang_selector_submit.tpl" form="property_edit" action="saveProperty"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"fieldname"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_title" value="{$DATA.title}"></td>
 </tr>
 <tr>
  <td class="left">{"description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="4" cols="65">{$DATA.description}</textarea>
  </td>
 </tr>
 <tr>
  <td class="left">{"position"|translate}</td>
  <td class="right"><input type="text" size="15" name="x{$BASEID}_position" value="{$DATA.position}"></td>
 </tr>
 <tr>
  <td class="left">{"type"|translate}</td>
  <td class="right">
    <select name=x{$BASEID}_type onChange="document.forms['property_edit'].x{$BASEID}_action.value='saveProperty';document.forms['property_edit'].submit()">
   {foreach from="propertytypes"|getConfigValue key=KEY item=VAL}
   <option label="{$VAL|translate}" value="{$KEY}" {if $KEY==$DATA.type}selected="selected"{/if}>{$VAL|translate}</option>
   {/foreach}
   </select>
  </td>
 </tr>


 {if $DATA.type==1}
 <tr>
  <td class="left">{"bool"|translate}</td>
  <td class="right">{"true"|translate}
  <input type="text" size="15" name="x{$BASEID}_true" value="{$VALUE.true}">
  {"false"|translate}
  <input type="text" size="15" name="x{$BASEID}_false" value="{$VALUE.false}">
  </td>
 </tr>
 {/if}

 {if $DATA.type==2}
 <tr>
  <td class="left">{"range"|translate}</td>
  <td class="right">{"from"|translate}
  <input type="text" size="15" name="x{$BASEID}_from" value="{$NUMBER.from}">
  {"to"|translate}
  <input type="text" size="15" name="x{$BASEID}_to" value="{$NUMBER.to}">
  </td>
 </tr>
 {/if}

 {if $DATA.type==5}
 <tr>
  <td class="left">{"range from"|translate}</td>
  <td class="right">{"from"|translate}
  <input type="text" size="15" name="x{$BASEID}_from_l" value="{$NUMBER.from_l}">
  {"to"|translate}
  <input type="text" size="15" name="x{$BASEID}_to_l" value="{$NUMBER.to_l}">
  </td>
 </tr>
 <tr>
  <td class="left">{"range to"|translate}</td>
  <td class="right">{"from"|translate}
  <input type="text" size="15" name="x{$BASEID}_from_r" value="{$NUMBER.from_r}">
  {"to"|translate}
  <input type="text" size="15" name="x{$BASEID}_to_r" value="{$NUMBER.to_r}">
  </td>
 </tr>
 {/if}
 {if $DATA.type==3 || $DATA.type==9}
 {foreach from=$DROPDOWN key=KEY item=ITEM}
 <tr>
  <td class="left">{"field"|translate}</td>
  <td class="right">{"label"|translate}
  <input type="text" size="15" name="x{$BASEID}_label[{$KEY}]" value="{$ITEM.label}">
  {"value"|translate}
  <input type="text" size="15" name="x{$BASEID}_dvalue[{$KEY}]" value="{$ITEM.value}">
  {"default"|translate}<input
    type="radio"
    name="x{$BASEID}_default"
    value="{$KEY}"
    {if $ITEM.default ==1}checked{/if}>
  <img src="{$XT_IMAGES}icons/delete.png" {"delete"|alttag} onclick="document.forms['property_edit'].x{$BASEID}_delete_field.value='{$KEY}';document.forms['property_edit'].x{$BASEID}_action.value='saveProperty';document.forms['property_edit'].submit();" />
  </td>
 </tr>
 {/foreach}
 <tr>
  <td class="left">{"new field"|translate}</td>
  <td class="right">{"label"|translate}
  <input type="text" size="15" name="x{$BASEID}_label[999]" value="">
  {"value"|translate}
  <input type="text" size="15" name="x{$BASEID}_dvalue[999]" value="">
  {"default"|translate}<input
    type="radio"
    name="x{$BASEID}_default"
    value="999">
  </td>
 </tr>
 {/if}
 {if $DATA.type==4 || $DATA.type==10}
 {foreach from=$DROPDOWN key=KEY item=ITEM}
 <tr>
  <td class="left">{"field"|translate}</td>
  <td class="right">{"label"|translate}
  <input type="text" size="15" name="x{$BASEID}_label[{$KEY}]" value="{$ITEM.label}">
  {"value"|translate}
  <input type="text" size="15" name="x{$BASEID}_dvalue[{$KEY}]" value="{$ITEM.value}">
  {"default"|translate}<input
    type="checkbox"
    name="x{$BASEID}_default[{$KEY}]"
    {if $ITEM.default ==1}checked{/if}>
<img src="{$XT_IMAGES}icons/delete.png" {"delete"|alttag} onclick="document.forms['property_edit'].x{$BASEID}_delete_field.value='{$KEY}';document.forms['property_edit'].x{$BASEID}_action.value='saveProperty';document.forms['property_edit'].submit();" />

  </td>
 </tr>
 {/foreach}
 <tr>
  <td class="left">{"new field"|translate}</td>
  <td class="right">{"label"|translate}
  <input type="text" size="15" name="x{$BASEID}_label[999]" value="">
  {"value"|translate}
  <input type="text" size="15" name="x{$BASEID}_dvalue[999]" value="">
  {"default"|translate}<input
    type="checkbox"
    name="x{$BASEID}_default[999]" >
  </td>
 </tr>
 {/if}
 {if $DATA.type==0}
 <tr>
  <td class="left">{"value"|translate}</td>
  <td class="right">
  <textarea id="x{$BASEID}_value" name="x{$BASEID}_value" rows="4" cols="65">{$DATA.value}</textarea>
  </td>
 </tr>
 {/if}
 {if $DATA.type==8}
 <tr>
  <td class="left">{"value"|translate}</td>
  <td class="right">
  <input type="text" id="x{$BASEID}_value" name="x{$BASEID}_value" size="50" value="{$DATA.value}">
  </td>
 </tr>
 {/if}

 {if $DATA.type==6 || $DATA.type==7}
 <tr>
  <td class="left">{"Content type"|translate}&nbsp;</td>
  <td class="right">
  <select name="x{$BASEID}_target_content_type" onchange="document.forms['edit'].x{$BASEID}_target_content_id.value=0;document.forms['edit'].x{$BASEID}_action.value='saveRelation';document.forms['edit'].submit();">
  {foreach from=$CTYPES item=CTYPE}
    <option value="{$CTYPE.id}"{if $CTYPE.id == $TARGET_CONTENT_TYPE} selected{/if}>{$CTYPE.title}</option>
  {/foreach}
  </select>
  </td>
 </tr>
 {/if}
{if $DATA.type == 11}


{foreach from=$MULTIPLETEXT item=ITEM key=KEY}
 <tr>
  <td class="left">{"field"|translate}</td>
  <td class="right">
  <input type="text" size="15" name="x{$BASEID}_value[{$KEY}]" value="{$ITEM}">
  </td>
 </tr>
 {assign var="MULTIPLETEXTMAXKEY" value=$KEY}
 {/foreach}
 <tr>
  <td class="left">{"new field"|translate}</td>
  <td class="right">
  <input type="text" size="15" name="x{$BASEID}_value[{$MULTIPLETEXTMAXKEY+1}]" value="">
  </td>
 </tr>
 {/if}
 </table>

{if $DISPLAY.property_permissions == 1}
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Permissions"|translate}:</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"allowed roles"|translate}</td>
  <td class="right">
{foreach from=$ROLES item=ROLE}
  <input
    type="checkbox"
    name="x{$BASEID}_roles[{$ROLE.id}]"
    {if $ROLE.allowed ==1}checked{/if}>{$ROLE.title}<br />
{/foreach}
  </td>
</table>
{/if}



 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Group"|translate}:</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">&nbsp;</td>
  <td class="right">
{foreach from=$GROUPS item=GROUP}
  <input
    type="checkbox"
    name="x{$BASEID}_groups[{$GROUP.id}]"
    {if $GROUP.selected ==1}checked{/if}>{$GROUP.name}<br />
{/foreach}
  </td>
</table>


 <input type="hidden" name="x{$BASEID}_id" value="{$DATA.id}">
 <input type="hidden" name="x{$BASEID}_delete_field" value="">
 <input type="hidden" name="x{$BASEID}_property_id" value="{$DATA.id}">
 <br />
 {include file="includes/buttons.tpl" data=$PROPERTIE_EDIT_BUTTONS withouthidden=1}


</form>

{include file="includes/editor.tpl"}