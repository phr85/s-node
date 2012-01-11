{*print_data array=$EDIT*}
<script language="JavaScript"><!--
{literal}
if(typeof(window.parent.frames['master'].document.forms[1].x1700_lang_filter) !='undefined'){
	window.parent.frames['master'].document.forms[1].x1700_lang_filter.value = '{/literal}{$ACTIVE_LANG}{literal}' ;
}
window.parent.frames['master'].document.forms[1].submit();
{/literal}
//-->
</script>

<form method="post" name="edit">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Job"|translate}:</span><span class="title"> {$EDIT.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}
{include file="includes/lang_selector_simple.tpl" form="edit"}
<table cellspacing="0" cellpadding="0" width="100%">

 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_job[title]" value="{$EDIT.title}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Subtitle"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_job[subtitle]" value="{$EDIT.subtitle}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Introdution"|translate}</td>
  <td class="right">{toggle_editor id="introduction"}
  <textarea id="x{$BASEID}_introduction" name="x{$BASEID}_job[introduction]" cols="65" rows="6">{$EDIT.introduction}</textarea>
  </td>
 </tr>
 <tr>
  <td class="left">{"Maintext"|translate}</td>
  <td class="right">{toggle_editor id="maintext"}
  <textarea id="x{$BASEID}_maintext" name="x{$BASEID}_job[maintext]" cols="65" rows="10">{$EDIT.maintext}</textarea>
  </td>
 </tr>
{if $DISPLAY.relations}
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Relations"|translate}</span>
  </td>
 </tr>
 <tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {include file="includes/widgets/relations.tpl" cid=$EDIT.id ctitle=$EDIT.title}
{/if}
{if $DISPLAY.properties}
  {include file="includes/widgets/properties.tpl" content_id=$EDIT.id content_type=$BASEID formname="edit" universal=true lang=$ACTIVE_LANG}
{/if}
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Adresses"|translate}</span>
  </td>
 </tr>
 <tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Contact"|translate}<a name="contact_addr_picker" /></td>
  <td class="right">
  <input size="55" type="text" readonly="yes" class="disabled" id="x{$BASEID}_contact_title" name="x{$BASEID}_job[contact_title]" value="{if $EDIT.contact_id > 0}{$EDIT.contact_title}{if $EDIT.contact_firstName != ""}, {$EDIT.contact_firstName} {$EDIT.contact_lastName}{/if}{if $EDIT.contact_street != ""}, {$EDIT.contact_street}{/if}{if $EDIT.contact_postalCode != ""}, {$EDIT.contact_postalCode}{/if}{if $EDIT.contact_city != ""}, {$EDIT.contact_city}{/if}{/if}" />
  {actionPopUp
    icon="breakpoint_add.png"
    title="Pick an address"|translate
    TPL=$ADDR_PICKER_TPL
    BASEID=7400
    fieldBaseId=$BASEID
    fieldName="contact"
    form="edit"
    name="contact_addr_picker"
    anker="contact_addr_picker"
}<input type="hidden" id="x{$BASEID}_contact" name="x{$BASEID}_job[contact_id]" value="{$EDIT.contact_id}" /></td>
 </tr>
 <tr>
  <td class="left">{"Location"|translate}<a name="location_addr_picker" /></td>
  <td class="right">
  <input size="55" type="text" readonly="yes" class="disabled" id="x{$BASEID}_location_title" name="x{$BASEID}_job[location_title]" value="{if $EDIT.location_id > 0}{$EDIT.location_title}{if $EDIT.location_firstName != ""}, {$EDIT.location_firstName} {$EDIT.location_lastName}{/if}{if $EDIT.location_street != ""}, {$EDIT.location_street}{/if}{if $EDIT.location_postalCode != ""}, {$EDIT.location_postalCode}{/if}{if $EDIT.location_city != ""}, {$EDIT.location_city}{/if}{/if}" />
  {actionPopUp
    icon="breakpoint_add.png"
    title="Pick an address"|translate
    TPL=$ADDR_PICKER_TPL
    BASEID=7400
    fieldBaseId=$BASEID
    fieldName="location"
    form="edit"
    name="location_addr_picker"
    anker="location_addr_picker"
}<input type="hidden" id="x{$BASEID}_location" name="x{$BASEID}_job[location_id]" value="{$EDIT.location_id}" /></td>
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"General Information"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Job ID"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_job[job_id]" value="{$EDIT.job_id}" size="12"></td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"min percentage"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_job[job_percentage_from]" value="{$EDIT.job_percentage_from}" size="12"></td>
 </tr>
 <tr>
  <td class="left">{"max percentage"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_job[job_percentage_to]" value="{$EDIT.job_percentage_to}" size="12"></td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
  <tr>
  <td class="left">{"Start"|translate} {"(d.m.y)"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_job[job_start_at_str]" id="x{$BASEID}_job_start_at_str" value="{if $EDIT.job_start_at > 0}{$EDIT.job_start_at|date_format:"%d.%m.%Y"}{/if}" size="12" />
      {include file="includes/widgets/datepicker.tpl" relative="job_start_at_str"}
  </td>
 </tr>
  <tr>
  <td class="left">{"End"|translate} {"(d.m.y)"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_job[job_end_at_str]" id="x{$BASEID}_job_end_at_str" value="{if $EDIT.job_end_at > 0}{$EDIT.job_end_at|date_format:"%d.%m.%Y"}{/if}" size="12" />
      {include file="includes/widgets/datepicker.tpl" relative="job_end_at_str"}
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
  <tr>
  <td class="left">{"Application up"|translate} {"(d.m.y)"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_job[application_up_str]" id="x{$BASEID}_application_up_str" value="{if $EDIT.application_up > 0}{$EDIT.application_up|date_format:"%d.%m.%Y"}{/if}" size="12" />
      {include file="includes/widgets/datepicker.tpl" relative="application_up_str"}
  </td>
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Application form"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"application schematic"|translate}</td>
  <td class="right">
    <select name="x{$BASEID}_job[application_schematic]">
        {foreach from=$SCHEMATICS key=KEY item=VALUE}
            <option value="{$KEY}" {if $KEY == $EDIT.application_schematic}selected="selected"{/if}>{$KEY}</option>
        {/foreach}
    </select>
    </td>
 </tr>

 <tr>
  <td class="left">{"application template"|translate}</td>
  <td class="right">
    <select name="x{$BASEID}_job[application_template]">
        {foreach from=$TEMPLATES key=KEY item=VALUE}
            <option value="{$VALUE}" {if $VALUE == $EDIT.application_template}selected="selected"{/if}>{$VALUE}</option>
        {/foreach}
    </select>
    </td>
 </tr>
{if sizeof($LANGS) > 1}
<tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Languages"|translate}</span>
  </td>
 </tr>
 <tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Copy into"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_copyToLang">
   {foreach from=$LANGS key=KEY item=LANG}
    {if $KEY != $ACTIVE_LANG}
    <option value="{$KEY}">{$LANG.name|translate}</option>
    {/if}
   {/foreach}
   </select>
   {actionIcon
       action="copyToLang"
       form="edit"
       icon="explorer/arrow_right_green.png"
       title="Copy to this language"
   }
  </td>
 </tr>
{/if}
</table>
{include file="ch.iframe.snode.jobcenter/admin/hiddenvalues.tpl"}
</form>
{include file="includes/editor.tpl"}