<tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Properties"|translate}<a name="additionalProperties">&nbsp;</a><input type="hidden" name="x{$BASEID}_field_id" value=""></span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>

{if $DISPLAY.single_property == 1}
{if $FIELDNAMES > 0}
 <tr>
  <td class="left">{"add properties"|translate}</td>
  <td class="right">
  <select name=x{$BASEID}_property_id>
    {html_options options=$FIELDNAMES}
  </select>
  <a href="javascript:document.forms['editArticle'].x{$BASEID}_action.value='addPropertiesToArticle'; document.forms['editArticle'].submit();">
   <img src="images/icons/breakpoint_add.png" alt="{"add property"|translate}" title="{"add property"|translate}" />
  </a>
  </td>
 </tr>
 {/if}
 {/if}
{if $DISPLAY.property_group == 1}
 {if sizeof($GROUPS) > 0}
 <tr>
  <td class="left">{"from group"|translate}</td>
  <td class="right">
   <select name=x{$BASEID}_fieldgroup_id>
   {html_options options=$GROUPS}
   </select>
   <a href="javascript:document.forms['editArticle'].x{$BASEID}_action.value='addGroupToArticle'; document.forms['editArticle'].submit();">
   <img src="images/icons/breakpoint_add.png" alt="{"add group"|translate}" title="{"add group"|translate}" />
   </a>
  </td>
 </tr>
 {/if}
 {/if}


 {foreach from=$ARTICLEFIELDS item=FIELD}

 <tr>
  <td class="left">
  <a href="javascript:
  if(confirm('{'q_delete_property'|translate}'))
   document.forms['editArticle'].x{$BASEID}_field_id.value={$FIELD.field_id};
   document.forms['editArticle'].x{$BASEID}_action.value='deletePropertyFromArticle';
   document.forms['editArticle'].submit();">
  <img src="images/icons/delete.png" align="right" alt="{"delete property"|translate}" title="{"delete property"|translate}" /></a>

  {if $FIELD.description == ""}
  {$FIELD.label}
  {else}
  <b>{$FIELD.label}</b><br />
  {$FIELD.description}
  {/if}
  </td>
  <td class="right">
  {if $FIELD.type == 1}
      <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][type]" value="1">
      <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][0]" value="{$FIELD.preptypevalue.0}">
      <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][1]" value="{$FIELD.preptypevalue.1}">

      {foreach from=$FIELD.preptypevalue key=key item=VAL}
      <input type="radio" name="x{$BASEID}_field[{$FIELD.field_id}][boolean]" value="{$key}" {if $key == $FIELD.value}checked="checked"{/if}>{$VAL}
      {/foreach}

  {/if}
  {if $FIELD.type == 2}
     <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][min]" value="{$FIELD.preptypevalue.min}">
     <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][max]" value="{$FIELD.preptypevalue.max}">
      <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][type]" value="2">
      <input type="text" name="x{$BASEID}_field[{$FIELD.field_id}][decimal1]" value="{$FIELD.value}">
  {/if}
  {if $FIELD.type == 5}
  <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][type]" value="5">
  <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][l][min]" value="{$FIELD.preptypevalue.l.min}">
  <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][l][max]" value="{$FIELD.preptypevalue.l.max}">
  <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][r][min]" value="{$FIELD.preptypevalue.r.min}">
  <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][r][max]" value="{$FIELD.preptypevalue.r.max}">

  {"from"|translate}<br /> <input type="text" name="x{$BASEID}_field[{$FIELD.field_id}][decimal1]" value="{$FIELD.decimal1}">
  <br />{"to"|translate}<br /><input type="text" name="x{$BASEID}_field[{$FIELD.field_id}][decimal2]" value="{$FIELD.decimal2}">
  {/if}

  {if $FIELD.type == 3}
  <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][type]" value="3">
  {foreach from=$FIELD.preptypevalue key=key item=VAL}
      <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][label][{$VAL.value}]" value="{$VAL.label}">
  {/foreach}
  <select name="x{$BASEID}_field[{$FIELD.field_id}][dropdown]" style="width:360px;">
      {foreach from=$FIELD.preptypevalue key=key item=VAL}
      <option label="{$VAL.label}" value="{$VAL.value}" {if $VAL.value == $FIELD.value}selected="selected"{/if}{if $FIELD.value=="" && $VAL.default !=""}selected="selected"{/if} >{$VAL.label}</option>
      {/foreach}
      </select>
  {/if}


    {if $FIELD.type == 9}
  <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][type]" value="9">
  {foreach from=$FIELD.preptypevalue key=key item=VAL}
      <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][label][{$VAL.value}]" value="{$VAL.label}">
  {/foreach}
      {foreach from=$FIELD.preptypevalue key=key item=VAL}
      <input type="radio" name="x{$BASEID}_field[{$FIELD.field_id}][dropdown]" label="{$VAL.label}" value="{$VAL.value}" {if $VAL.value == $FIELD.value}checked="checked"{/if}{if $FIELD.value=="" && $VAL.default !=""}checked="checked"{/if} />{$VAL.label}
      {/foreach}

  {/if}

  {if $FIELD.type == 4}
  <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][type]" value="4">
  {foreach from=$FIELD.preptypevalue key=key item=VAL}
      <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][label][{$VAL.value}]" value="{$VAL.label}">
  {/foreach}
      <select name="x{$BASEID}_field[{$FIELD.field_id}][multi][]" size="5" multiple style="width:360px;">
      {foreach from=$FIELD.preptypevalue key=key item=VAL}
            <option label="{$VAL.label}" value="{$VAL.value}" {if $VAL.default == 1}selected="selected"{/if} >{$VAL.label}</option>
      {/foreach}
      </select>
  {/if}

  {if $FIELD.type == 10}
  <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][type]" value="10">
  {foreach from=$FIELD.preptypevalue key=key item=VAL}
      <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][label][{$VAL.value}]" value="{$VAL.label}">
  {/foreach}

      {foreach from=$FIELD.preptypevalue key=key item=VAL}

      <input type="checkbox" name="x{$BASEID}_field[{$FIELD.field_id}][multi][]"
      label="{$VAL.label}" value="{$VAL.value}"
      {if $VAL.default == 1}checked="checked"{/if} />{$VAL.label}<br />
      {/foreach}
      </select>
  {/if}

  {if $FIELD.type == 0}
  <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][type]" value="0">
      {toggle_editor id="field_" suffix=$FIELD.field_id nobaseid="1"}
      <textarea id="field_{$FIELD.field_id}" name="x{$BASEID}_field[{$FIELD.field_id}][text]" rows="4" cols="65">{$FIELD.value}</textarea>
  {/if}
  {if $FIELD.type == 8}
  <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][type]" value="0">
      <input type="text" id="field_{$FIELD.field_id}" name="x{$BASEID}_field[{$FIELD.field_id}][text]" size="65" value="{$FIELD.value}">
  {/if}
{if $FIELD.type == 6 || $FIELD.type == 7}
<input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][type]" value="{$FIELD.type}" />
{foreach from=$FIELD.relations key=FKEY item=REL}<br />
    {if $FIELD.type == 7}<a href="javascript:document.forms['editArticle'].x{$BASEID}_field_{$FIELD.field_id}_{$FKEY}_target_content_id.value='delete';document.forms['editArticle'].x1200_action.value='saveArticle';document.forms['editArticle'].submit();document.forms['editArticle'].x{$BASEID}_yoffset.value=document.forms['editArticle'].pageYOffset;"><img src="{$XT_IMAGES}icons/delete.png" alt="{"delete"|translate}" /></a>{/if}

    {if $FIELD.picker !=""}
            <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$FIELD.picker}&field=x{$BASEID}_field_{$FIELD.field_id}_{$FKEY}_target_content_id&form=editArticle',960,500);">
            <img src="images/icons/breakpoint_add.png" {"please select an item"|alttag}></a>
            <input type="text" name="x{$BASEID}_field_{$FIELD.field_id}_{$FKEY}_target_content_id_title" size="60" class="disabled" readonly value="{$REL.title|default:$REL.content_id}">
            <input type="hidden" name="x{$BASEID}_field_{$FIELD.field_id}_{$FKEY}_target_content_id" value="{$REL.content_id}">
            <input type="hidden" name="x{$BASEID}_field_{$FIELD.field_id}_{$FKEY}_target_content_id_version" value="{$REL.content_id}">
            {else}
            <input type="text" name="x{$BASEID}_field_{$FIELD.field_id}_{$FKEY}_target_content_id" value="{$REL.content_id}"> ({$REL.title})
    {/if}

    <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][elements][{$FKEY}][count]" value="{$FKEY}">
   {if $REL.image > 0}
   <br /><br />
  {image id=$REL.image version=0
 name="x"|cat:$BASEID|cat:"_field_"|cat:$FIELD.field_id|cat:"_"|cat:$FKEY|cat:"_target_content_id_view"}
  <br />
 {else}
 <br />
 <img src="/images/spacer.gif" name="x{$BASEID}_field_{$FIELD.field_id}_{$FKEY}_target_content_id_view" alt=""/>
  {/if}
  {/foreach}
 {if $FIELD.type == 7}
     {if $FIELD.picker !=""}<br />
            <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$FIELD.picker}&field=x{$BASEID}_field_{$FIELD.field_id}_99_target_content_id&form=editArticle',960,500);">
            <img src="images/icons/breakpoint_add.png" {"please select an item"|alttag}></a>
            <input type="text" name="x{$BASEID}_field_{$FIELD.field_id}_99_target_content_id_title" class="disabled" readonly value="{"please select an item"|translate}" size="45">
            <input type="hidden" name="x{$BASEID}_field_{$FIELD.field_id}_99_target_content_id" value="">
            {else}
            <input type="text" name="x{$BASEID}_field_{$FIELD.field_id}_99_target_content_id" value="{$REL.content_id}"> ({$REL.title})
    {/if}
    <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][elements][99][count]" value="99" size="45">
 {/if}
 {/if}
 
 
  {if $FIELD.type == 11}
  <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][type]" value="11">
    <input type="hidden" name="x{$BASEID}_field[{$FIELD.field_id}][display]" value="">
    {foreach from=$FIELD.preptypevalue key=key item=VAL}
        <input type="text" name="x{$BASEID}_field[{$FIELD.field_id}][multitext][{$VAL.value}]" value="{$VAL.value}" /> {$VAL.label}<br />
    {/foreach}
  {/if}
 
  </td>
 </tr>
{/foreach}
<tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
