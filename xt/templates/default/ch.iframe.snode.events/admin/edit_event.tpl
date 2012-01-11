<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="edit" onSubmit="window.document.forms['edit'].x{$BASEID}_yoffset.value=window.pageYOffset;">
<h2><span class="light">{"Event"|translate}:</span> {$EVENT.title}</h2>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
{include file="includes/lang_selector_submit.tpl" form="edit" action="saveEvent"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" value="{$EVENT.title|htmlspecialchars}" size="42" /></td>
 </tr>
 <tr>
  <td class="left">{"Introduction"|translate}</td>
  <td class="right">{toggle_editor id="introduction"}
  <textarea id="x{$BASEID}_introduction" name="x{$BASEID}_introduction" rows="4" cols="65">{$EVENT.introduction}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Text"|translate}</td>
  <td class="right">{toggle_editor id="maintext"}
  <textarea id="x{$BASEID}_maintext" name="x{$BASEID}_maintext" rows="8" cols="65">{$EVENT.maintext}</textarea></td>
 </tr>
 <tr>
  <td class="left">{"Picture"|translate}<a name="image" /></td>
  <td class="right">{actionPopUp
    icon="pick_photo.png"
    title="Pick an image"|translate
    TPL=$IMAGE_PICKER_TPL
    BASEID=$IMAGE_PICKER_BASE_ID
    fieldBaseId=$BASEID
    fieldName="image"
    form="edit"
    name="picker"
    anker="image"
}{
   actionIcon
       action="saveEvent"
       delete_image="1"
       icon="delete.png"
       form="edit"
       yoffset=1
       title="Delete Image"
       ask="Are you sure that you want to delete this image relation"
       id=$EVENT.id
   }<br />
   {if $EVENT.image < 1}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <img name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$EVENT.image}&amp;file_version=1" alt="" class="picked" />
   {/if}</td>
 </tr>

 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Data"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>


 <tr>
  <td class="left">{"Country"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_country" onchange="document.forms['edit'].x5100_yoffset.value= window.pageYOffset;document.forms['edit'].x{$BASEID}_action.value='saveEvent';document.forms['edit'].submit();">
   <option value="" {if $COUNTRY.country == $EVENT.country}selected="selected"{/if}>{"Select a country"|translate}</option>
   {foreach from=$COUNTRIES item=COUNTRY}
   <option value="{$COUNTRY.country}" {if $COUNTRY.country == $EVENT.country}selected="selected"{/if}>{$COUNTRY.name}</option>
   {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Region"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_region_id">
   <option value="0">{"None"|translate}</option>
   {foreach from=$REGIONS item=REGION}
   <option value="{$REGION.region}" {if $REGION.region == $EVENT.region_id}selected{/if}>{$REGION.name}</option>
   {/foreach}
   </select>
  </td>
 </tr>

 <tr>
  <td class="left">{"Address"|translate}<a name="addr_picker" /></td>
  <td class="right">
  <input size="40" type="text" readonly="yes" class="disabled" id="x{$BASEID}_address_title" name="x{$BASEID}_address_title" value="{if $EVENT.address >0}{$ADDRESS.title}{if $ADDRESS.street != ""}, {$ADDRESS.street}{/if}{if $ADDRESS.postalCode != ""}, {$ADDRESS.postalCode}{/if}{if $ADDRESS.city != ""}, {$ADDRESS.city}{/if}{/if}" />
  {actionPopUp
    icon="breakpoint_add.png"
    title="Pick an address"|translate
    TPL=$ADDR_PICKER_TPL
    BASEID=7400
    fieldBaseId=$BASEID
    fieldName="address"
    form="edit"
    name="addr_picker"
    anker="addr_picker"
}<input type="hidden" id="x{$BASEID}_address" name="x{$BASEID}_address" value="{$ADDRESS.id}" /></td>
 </tr>

 <tr>
  <td class="left">{"Contact Person"|translate}<a name="contact_picker" /></td>
  <td class="right">
  <input size="40" type="text" readonly="yes" class="disabled" id="x{$BASEID}_contact_person_id_title" name="x{$BASEID}_contact_title" value="{if $EVENT.contact_person_id > 0}{$CONTACT_PERSON.title}{if $CONTACT_PERSON.street != ""}, {$CONTACT_PERSON.street}{/if}{if $CONTACT_PERSON.postalCode != ""}, {$CONTACT_PERSON.postalCode}{/if}{if $CONTACT_PERSON.city != ""}, {$CONTACT_PERSON.city}{/if}{/if}" />
  {actionPopUp
    icon="breakpoint_add.png"
    title="Pick an image"|translate
    TPL=$ADDR_PICKER_TPL
    BASEID=7400
    fieldBaseId=$BASEID
    fieldName="contact_person_id"
    form="edit"
    name="contact_picker"
    anker="contact_picker"
}
<a href="#" onclick="$('#x{$BASEID}_contact_person_id').val(0); $('#x{$BASEID}_contact_person_id_title').val(''); return false;">
    <img src="images/icons/delete.png" alt="delete" />
</a>
<input type="hidden" id="x{$BASEID}_contact_person_id" name="x{$BASEID}_contact_person_id" value="{$CONTACT_PERSON.id}" /></td>
 </tr>
 
  <tr>
  <td class="left">{"Speaker"|translate}<a name="speaker_picker" /></td>
  <td class="right">
  <input size="40" type="text" readonly="yes" class="disabled" id="x{$BASEID}_speaker_id_title" name="x{$BASEID}_speaker_title" value="{if $EVENT.speaker_id > 0}{$SPEAKER.title}{if $SPEAKER.street != ""}, {$SPEAKER.street}{/if}{if $SPEAKER.postalCode != ""}, {$SPEAKER.postalCode}{/if}{if $SPEAKER.city != ""}, {$SPEAKER.city}{/if}{/if}" />
  {actionPopUp
    icon="breakpoint_add.png"
    title="Pick an image"|translate
    TPL=$ADDR_PICKER_TPL
    BASEID=7400
    fieldBaseId=$BASEID
    fieldName="speaker_id"
    form="edit"
    name="speaker_picker"
    anker="speaker_picker"
}
<a href="#" onclick="$('#x{$BASEID}_speaker_id').val(0); $('#x{$BASEID}_speaker_id_title').val(''); return false;">
    <img src="images/icons/delete.png" alt="delete" />
</a>
<input type="hidden" id="x{$BASEID}_speaker_id" name="x{$BASEID}_speaker_id" value="{$SPEAKER.id}" /></td>
 </tr>
 
  <tr>
  <td class="left">{"Meeting Place"|translate}<a name="meeting_place_picker" /></td>
  <td class="right">
  <input size="40" type="text" readonly="yes" class="disabled" id="x{$BASEID}_meeting_place_id_title" name="x{$BASEID}_meeting_place_title" value="{if $EVENT.meeting_place_id > 0}{$MEETINGPLACE.title}{if $MEETINGPLACE.street != ""}, {$MEETINGPLACE.street}{/if}{if $MEETINGPLACE.postalCode != ""}, {$MEETINGPLACE.postalCode}{/if}{if $MEETINGPLACE.city != ""}, {$MEETINGPLACE.city}{/if}{/if}" />
  {actionPopUp
    icon="breakpoint_add.png"
    title="Pick an image"|translate
    TPL=$ADDR_PICKER_TPL
    BASEID=7400
    fieldBaseId=$BASEID
    fieldName="meeting_place_id"
    form="edit"
    name="meeting_place_picker"
    anker="meeting_place_picker"
}
<a href="#" onclick="$('#x{$BASEID}_meeting_place_id').val(0); $('#x{$BASEID}_meeting_place_id_title').val(''); return false;">
    <img src="images/icons/delete.png" alt="delete" />
</a>
<input type="hidden" id="x{$BASEID}_meeting_place_id" name="x{$BASEID}_meeting_place_id" value="{$MEETINGPLACE.id}" /></td>
 </tr>

 <tr>
  <td class="left">{"Date"|translate}<a name="date" /></td>
  <td class="right">
  <select  style="width:50px;" name="x{$BASEID}_select_day" onchange="document.getElementById('x{$BASEID}_day').value=document.getElementById('x{$BASEID}_select_day')[selectedIndex].value;document.forms[0].x{$BASEID}_action.value='saveEvent';document.forms[0].submit();" id="x{$BASEID}_select_day">
  {foreach from=$DAYS item=DAY}
    <option value="{$DAY}"{if $DAY == $DAY_SELECTED} selected{/if}>{$DAY}</option>
  {/foreach}
  </select>
  <select  style="width:50px;" name="x{$BASEID}_select_month" onchange="document.getElementById('x{$BASEID}_month').value=document.getElementById('x{$BASEID}_select_month')[selectedIndex].value;document.forms[0].x{$BASEID}_action.value='saveEvent';document.forms[0].submit();" id="x{$BASEID}_select_month">
  {foreach from=$MONTHS item=MONTH}
    <option value="{$MONTH}"{if $MONTH == $MONTH_SELECTED} selected{/if}>{$MONTH}</option>
  {/foreach}
  </select>
  <select style="width:60px;" name="x{$BASEID}_select_year" onchange="document.getElementById('x{$BASEID}_year').value=document.getElementById('x{$BASEID}_select_year')[selectedIndex].value;document.forms[0].x{$BASEID}_action.value='saveEvent';document.forms[0].submit();" id="x{$BASEID}_select_year">
  {foreach from=$YEARS item=YEAR}
    <option value="{$YEAR}"{if $YEAR == $YEAR_SELECTED} selected{/if}>{$YEAR}</option>
  {/foreach}
  </select>
  <input type="hidden" name="x{$BASEID}_day" id="x{$BASEID}_day" value="{$EVENT.from_date|date_format:"%e"}" />
  <input type="hidden" name="x{$BASEID}_month" id="x{$BASEID}_month" value="{$EVENT.from_date|date_format:"%m"}" />
  <input type="hidden" name="x{$BASEID}_year" id="x{$BASEID}_year" value="{$EVENT.from_date|date_format:"%Y"}" />

  </td>
 </tr>

{* Starttime and Duration Select *}
<tr>
    <td class="left">
        {"defined starttime"|translate}
    </td>
    <td class="right">
        <input type="radio" name="x{$BASEID}_set_start_date_only" id="x{$BASEID}_set_start_date_only" value="0" {if !$EVENT.set_start_date_only}checked="checked"{/if} onchange="document.forms[0].x{$BASEID}_action.value='saveEvent';document.forms[0].submit();" />{"yes"|translate}
        <input type="radio" name="x{$BASEID}_set_start_date_only" id="x{$BASEID}_set_start_date_only" value="1" {if $EVENT.set_start_date_only}checked="checked"{/if} onchange="document.forms[0].x{$BASEID}_action.value='saveEvent';document.forms[0].submit();" />{"no"|translate}
    </td>
</tr>

{* EOF Starttime and Duration Select *}

{if !$EVENT.set_start_date_only}

    {* Starttime *}
     <tr>
      <td class="left">{"Time"|translate}</td>
      <td class="right">
      <select style="width: 50px;" name="x{$BASEID}_select_start_hour" id="x{$BASEID}_select_start_hour" onchange="document.getElementById('x{$BASEID}_start_hour').value=document.getElementById('x{$BASEID}_select_start_hour')[selectedIndex].value;document.forms[0].x{$BASEID}_action.value='saveEvent';document.forms[0].submit();">
      {foreach from=$HOURS item=HOUR}
        <option value="{$HOUR}"{if $HOUR == $HOUR_SELECTED} selected{/if}>{$HOUR}</option>
      {/foreach}
      </select>
    
      <input type="hidden" name="x{$BASEID}_start_hour" value="{$EVENT.from_date|date_format:"%H"}" id="x{$BASEID}_start_hour" maxlength="2" />&nbsp;:&nbsp;<input type="text" style="width: 50px;" name="x{$BASEID}_start_min" value="{$EVENT.from_date|date_format:"%M"}" id="start_min" maxlength="2" /></td>
     </tr>
    
    {* EOF Starttime *}

{/if}

{* Duration *}
 <tr>
  <td class="left">{"Duration"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_duration" value="{$EVENT.duration|default:1}" />&nbsp;
  <select name="x{$BASEID}_duration_type">
    <option value="week"{if $EVENT.duration_type == 'week'} selected{/if}>{"Week(s)"|translate}</option>
    <option value="day"{if $EVENT.duration_type == 'day'} selected{/if}>{"Day(s)"|translate}</option>
    <option value="hours"{if $EVENT.duration_type == 'hours'} selected{/if}>{"Hour(s)"|translate}</option>
    <option value="minutes"{if $EVENT.duration_type == 'minutes'} selected{/if}>{"Minute(s)"|translate}</option>
  </select>

  &nbsp;({$EVENT.end_date|date_format:"%d.%m.%Y %H:%M"})
  </td>
 </tr>

{* EOF Duration *}

 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Options"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
{if $DISPLAY.relations}
 {include file="includes/widgets/relations.tpl" cid=$EVENT.id ctitle=$EVENT.title}
{/if}
{if $DISPLAY.properties}
 {include file="includes/widgets/properties.tpl" content_id=$EVENT.id content_type=$BASEID formname="edit" universal=false}
{/if}





 <tr>
    <td class="left">{"Visitors"|translate}</td>
    <td class="right"><input type="text" value="{$EVENT.max_visitors}" name="x{$BASEID}_max_visitors" size="10" />&nbsp;{"Reg"|translate}={$EVENT.reg_visitors} / {"Free"|translate}={$EVENT.free_places}
  </td>
 </tr>
  <tr>
  <td class="left">{"costs"|translate}</td>
  <td class="right">{toggle_editor id="costs"}
  <textarea id="x{$BASEID}_costs" name="x{$BASEID}_costs" rows="3" cols="65">{$EVENT.costs}</textarea></td>
 </tr>
 <tr>
    <td class="left">{"Link"|translate}</td>
    <td class="right"><input onclick="showhideCheckbox('x{$BASEID}_haslink', 'x{$BASEID}_linktr');" type="checkbox" name="x{$BASEID}_haslink" id="x{$BASEID}_haslink"{if $EVENT.link !=""} checked{/if} /></td>
 </tr>
 <tr id="x{$BASEID}_linktr" style="display:{if $EVENT.link != ''} table-row{else} none{/if};">
    <td class="left">{"URL"|translate}</td>
    <td class="right"><input type="text" value="{$EVENT.link}" name="x{$BASEID}_link" size="40" />&nbsp;
    <input type="checkbox" name="x{$BASEID}_link_external"{if $EVENT.link_external == 1} checked{/if} />&nbsp;{"New window"|translate}</td>
 </tr>
 
{* Registattion yes/no *}
<tr>
    <td class="left">
        {"Allow registration"|translate}
    </td>
    <td class="right">
        <input type="radio" name="x{$BASEID}_allow_registration" id="x{$BASEID}_allow_registration" value="0" {if $EVENT.registertpl != ""}checked="checked"{/if} onchange="$('#x{$BASEID}_registertplwrapper').css('display', 'table-row'); $('#x{$BASEID}_registertpl').val('default.tpl');" />{"yes"|translate}
        <input type="radio" name="x{$BASEID}_allow_registration" id="x{$BASEID}_allow_registration" value="1" {if $EVENT.registertpl == ""}checked="checked"{/if} onchange="$('#x{$BASEID}_registertpl').val(''); document.forms[0].x{$BASEID}_action.value='saveEvent';document.forms[0].submit();" />{"no"|translate}
    </td>
</tr>
{* EOF Registattion yes/no *}

{* Registertpl *}
<tr id="x{$BASEID}_registertplwrapper" style="display:{if $EVENT.registertpl != ""}table-row{else} none{/if};">
    <td class="left">
        {"Registertemplate"|translate}
    </td>
    <td class="right">
        <select name="x{$BASEID}_registertpl" id="x{$BASEID}_registertpl" onchange="document.forms[0].x{$BASEID}_action.value='saveEvent';document.forms[0].submit();">
            <option value=""></option>
            {foreach from=$REGISTERTPLS key=THEME item=TPLS}
                {foreach from=$TPLS item=TPL}
                    <option value="{$TPL}" {if $EVENT.registertpl == $TPL}selected="selected"{/if} {if $THEME != "default"}style="background-color: rgb(56, 255, 24);"{/if}>
                        {$TPL} {if $THEME != "default"}({$THEME}){/if}
                    </option>
                {/foreach}
            {/foreach}
        </select>
    </td>
</tr>
{* EOF Registertpl *}

</table>

{include file="includes/timed.tpl"}

<input type="hidden" name="x{$BASEID}_delete_image" value="" />
{include file="ch.iframe.snode.events/admin/hiddenValues.tpl"}
{include file="includes/editor.tpl"}
</form>