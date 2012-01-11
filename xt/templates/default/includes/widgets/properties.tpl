{xt_get_properties_fields content_id=$content_id content_type=$content_type universal=$universal lang=$lang}
<input type="hidden" name="x{$BASEID}_XT_PROP_property_id_action" value="" />
<input type="hidden" name="x{$BASEID}_XT_PROP_save_lang" value="{$lang}" />
<input type="hidden" name="x{$BASEID}_XT_PROP_property_level_action" value="" />
<input type="hidden" name="x{$BASEID}_XT_PROP_content_id" value="{$content_id}" />
<input type="hidden" name="x{$BASEID}_XT_PROP_content_type" value="{$WBASEID|default:$BASEID}" />
<input type="hidden" name="x{$BASEID}_XT_autoaction[]" value="ch.iframe.snode.properties.savePropertieValues" />
<tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Properties"|translate}<a name="additionalProperties">&nbsp;</a></span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>

 {if sizeof($PROPERTIES.props) > 0}
 <tr>
  <td class="left">{"add properties"|translate}</td>
  <td class="right">
  <select name=x{$BASEID}_XT_PROP_property_id>
  {html_options options=$PROPERTIES.props}
  </select>
  <a href="javascript:document.forms['{$formname}'].x{$BASEID}_action.value='ch.iframe.snode.properties.addPropertyToContentID'; document.forms['{$formname}'].submit();">
   <img src="images/icons/breakpoint_add.png" alt="{"add property"|translate}" title="{"add property"|translate}" />
  </a>
   {if sizeof($PROPERTIES.groups) > 0 && !$nogroups}
  &nbsp;|&nbsp;
  <select name=x{$BASEID}_XT_PROP_propertygroup_id>
   {html_options options=$PROPERTIES.groups}
   </select>
   <a href="javascript:document.forms['{$formname}'].x{$BASEID}_action.value='ch.iframe.snode.properties.addPropertyGroupToContentID'; document.forms['{$formname}'].submit();">
   <img src="images/icons/breakpoint_add.png" alt="{"add group"|translate}" title="{"add group"|translate}" />
   </a>
 {/if}
  </td>
 </tr>
 {/if}

 {* Werte *}
 {foreach from=$PROPERTIES.filled item=SINGLEPROPERTY}
 <tr>
  <td class="left">
  <a href="javascript:
  if(confirm('{'q_delete_property'|translate}'))
   document.forms['{$formname}'].x{$BASEID}_XT_PROP_property_id_action.value={$SINGLEPROPERTY.property_id};
   document.forms['{$formname}'].x{$BASEID}_action.value='ch.iframe.snode.properties.deletePropertyFromContentID';
   document.forms['{$formname}'].submit();">
  <img src="images/icons/delete.png" align="right" alt="{"delete property"|translate}" title="{"delete property"|translate}" /></a>

  {if $SINGLEPROPERTY.description == ""}
  {$SINGLEPROPERTY.label}
  {else}
  <b>{$SINGLEPROPERTY.label}</b><br />
  {$SINGLEPROPERTY.description}
  {/if}
  </td>
  <td class="right">
  {if $SINGLEPROPERTY.type == 1}
      <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="1">
      <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][0]" value="{$SINGLEPROPERTY.preptypevalue.0}">
      <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][1]" value="{$SINGLEPROPERTY.preptypevalue.1}">

      {foreach from=$SINGLEPROPERTY.preptypevalue key=key item=VAL}
      <input type="radio" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][boolean]" value="{$key}" {if $key == $SINGLEPROPERTY.value}checked="checked"{/if}>{$VAL}
      {/foreach}

  {/if}
  {if $SINGLEPROPERTY.type == 2}
     <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][min]" value="{$SINGLEPROPERTY.preptypevalue.min}">
     <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][max]" value="{$SINGLEPROPERTY.preptypevalue.max}">
      <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="2">
      <input type="text" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][decimal1]" value="{$SINGLEPROPERTY.value}">
  {/if}
  {if $SINGLEPROPERTY.type == 5}
  <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="5">
  <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][l][min]" value="{$SINGLEPROPERTY.preptypevalue.l.min}">
  <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][l][max]" value="{$SINGLEPROPERTY.preptypevalue.l.max}">
  <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][r][min]" value="{$SINGLEPROPERTY.preptypevalue.r.min}">
  <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][r][max]" value="{$SINGLEPROPERTY.preptypevalue.r.max}">

  {"from"|translate}<br /> <input type="text" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][decimal1]" value="{$SINGLEPROPERTY.decimal1}">
  <br />{"to"|translate}<br /><input type="text" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][decimal2]" value="{$SINGLEPROPERTY.decimal2}">
  {/if}

  {if $SINGLEPROPERTY.type == 3}
  <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="3">
  {foreach from=$SINGLEPROPERTY.preptypevalue key=key item=VAL}
      <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][label][{$VAL.value}]" value="{$VAL.label}">
  {/foreach}
  <select name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][dropdown]" style="width:360px;">
      {foreach from=$SINGLEPROPERTY.preptypevalue key=key item=VAL}
      <option label="{$VAL.label}" value="{$VAL.value}" {if $VAL.value == $SINGLEPROPERTY.value}selected="selected"{/if}{if $SINGLEPROPERTY.value=="" && $VAL.default !=""}selected="selected"{/if} >{$VAL.label}</option>
      {/foreach}
      </select>
  {/if}


    {if $SINGLEPROPERTY.type == 9}
  <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="9">
  {foreach from=$SINGLEPROPERTY.preptypevalue key=key item=VAL}
      <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][label][{$VAL.value}]" value="{$VAL.label}">
  {/foreach}
      {foreach from=$SINGLEPROPERTY.preptypevalue key=key item=VAL}
      <input type="radio" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][dropdown]" label="{$VAL.label}" value="{$VAL.value}" {if $VAL.value == $SINGLEPROPERTY.value}checked="checked"{/if}{if $SINGLEPROPERTY.value=="" && $VAL.default !=""}checked="checked"{/if} />{$VAL.label}
      {/foreach}

  {/if}

  {if $SINGLEPROPERTY.type == 4}
  <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="4">
  {foreach from=$SINGLEPROPERTY.preptypevalue key=key item=VAL}
      <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][label][{$VAL.value}]" value="{$VAL.label}">
  {/foreach}
      <select name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][multi][]" size="5" multiple style="width:360px;">
      {foreach from=$SINGLEPROPERTY.preptypevalue key=key item=VAL}
            <option label="{$VAL.label}" value="{$VAL.value}" {if $VAL.default == 1}selected="selected"{/if} >{$VAL.label}</option>
      {/foreach}
      </select>
  {/if}

  {if $SINGLEPROPERTY.type == 10}
  <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="10">
  {foreach from=$SINGLEPROPERTY.preptypevalue key=key item=VAL}
      <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][label][{$VAL.value}]" value="{$VAL.label}">
  {/foreach}

      {foreach from=$SINGLEPROPERTY.preptypevalue key=key item=VAL}

      <input type="checkbox" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][multi][]"
      label="{$VAL.label}" value="{$VAL.value}"
      {if $VAL.default == 1}checked="checked"{/if} />{$VAL.label}<br />
      {/foreach}
      </select>
  {/if}

  {if $SINGLEPROPERTY.type == 0}
  <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="0">
      {toggle_editor id="field_" suffix=$SINGLEPROPERTY.property_id nobaseid="1"}
      <textarea id="field_{$SINGLEPROPERTY.property_id}" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][text]" rows="4" cols="65">{$SINGLEPROPERTY.value}</textarea>
  {/if}
  {if $SINGLEPROPERTY.type == 8}
  <input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="0">
      <input type="text" id="field_{$SINGLEPROPERTY.property_id}" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][text]" size="65" value="{$SINGLEPROPERTY.value}">
  {/if}
  
{if $SINGLEPROPERTY.type == 11}


<input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="{$SINGLEPROPERTY.type}" />
<a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL=135&field=x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_{$FKEY}_target_content_id&form={$formname}&titlefield=x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_{$FKEY}_target_content_id_title',960,500);"><img src="images/icons/breakpoint_add.png" {"please select an item"|alttag}></a>
            <input type="text" name="x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_{$FKEY}_target_content_id_title" size="60" class="disabled" readonly value="{$SINGLEPROPERTY.fieldlabel}">
            <input type="hidden" name="x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_{$FKEY}_target_content_id" value="{$SINGLEPROPERTY.value}">

 {/if}
 
 {*****************}
 
{if $SINGLEPROPERTY.type == 6}

<input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="{$SINGLEPROPERTY.type}" />

<a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$SINGLEPROPERTY.value}&field=x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_1_target_content_id&form={$formname}&titlefield=x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_1_target_content_id_title',960,500);">
    <img src="images/icons/breakpoint_add.png" {"please select an item"|alttag}>
</a>


<input type="text" name="x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_1_target_content_id_title" size="60" class="disabled" readonly value="{$SINGLEPROPERTY.preptypevalue.1.fieldlabel}">

<input type="hidden" name="x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_1_target_content_id" value="{$SINGLEPROPERTY.preptypevalue.1.value}">

 {/if}
 
  {*****************}
 
{if $SINGLEPROPERTY.type == 7}


{assign var="PROPLEVEL" value=0}


{foreach from=$SINGLEPROPERTY.preptypevalue item="MULTIVALUES"}

<a href="javascript:
  if(confirm('{'q_delete_property'|translate}'))
   document.forms['{$formname}'].x{$BASEID}_XT_PROP_property_id_action.value={$SINGLEPROPERTY.property_id};
   document.forms['{$formname}'].x{$BASEID}_XT_PROP_property_level_action.value={$MULTIVALUES.level};
   document.forms['{$formname}'].x{$BASEID}_action.value='ch.iframe.snode.properties.deletePropertyFromContentID';
   document.forms['{$formname}'].submit();">
  <img src="images/icons/delete.png" alt="{"delete property"|translate}" title="{"delete property"|translate}" /></a>


<input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="{$SINGLEPROPERTY.type}" />
  
<a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$SINGLEPROPERTY.value}&field=x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_{$MULTIVALUES.level}_target_content_id&form={$formname}&titlefield=x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_{$MULTIVALUES.level}_target_content_id_title',960,500);">
    <img src="images/icons/breakpoint_add.png" {"please select an item"|alttag}>
</a>

<input type="text" name="x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_{$MULTIVALUES.level}_target_content_id_title" size="60" class="disabled" readonly value="{$MULTIVALUES.fieldlabel}">

<input type="hidden" name="x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_{$MULTIVALUES.level}_target_content_id" value="{$MULTIVALUES.value}">
<br />

{assign var="PROPLEVEL" value=$MULTIVALUES.level}

{/foreach}


<input type="hidden" name="x{$BASEID}_XT_PROP_property[{$SINGLEPROPERTY.property_id}][type]" value="{$SINGLEPROPERTY.type}" />


<a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL={$SINGLEPROPERTY.value}&field=x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_{$PROPLEVEL+1}_target_content_id&form={$formname}&titlefield=x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_{$PROPLEVEL+1}_target_content_id_title',960,500);">
    <img src="images/icons/breakpoint_add.png" {"please select an item"|alttag}>
</a>


<input type="text" name="x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_{$PROPLEVEL+1}_target_content_id_title" size="60" class="disabled" readonly value="">

<input type="hidden" name="x{$BASEID}_XT_PROP_property_{$SINGLEPROPERTY.property_id}_{$PROPLEVEL+1}_target_content_id" value="">


 {/if}

 {*****************}

 
  </td>
 </tr>
{/foreach}
<tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>