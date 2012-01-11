<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="edit" onSubmit="window.document.forms['edit'].x{$BASEID}_yoffset.value= window.pageYOffset;">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%" summary="">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Address"|translate}:</span> <span class="title">
   {if $DATA.type == 3}
   <img src="{$XT_IMAGES}icons/user.png" alt="{"Person"|translate}"/> {$DATA.lastName} {$DATA.firstName}
   {/if}
   {if $DATA.type == 1}
   <img src="{$XT_IMAGES}icons/factory.png" alt="{"Company"|translate}"/> {$DATA.title}
   {/if}
   {if $DATA.type == 2 }
   <img src="{$XT_IMAGES}icons/member2.png" alt="{"Department"|translate}"/> {$DATA.title}
   {/if}
   </span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="left">{"Address type"|translate}</td>
  <td class="right">
   {"Typ"|translate}:
   <select name="x{$BASEID}_type" onchange="document.forms['edit'].x{$BASEID}_action.value='save';document.forms['edit'].submit();">
     {foreach from=$ADDRESSTYPES item=TYPE key=TYPEKEY}
           <option value="{$TYPEKEY}" {if $DATA.type == $TYPEKEY || ($DATA.type==0 && $TYPEKEY==3 )}selected{/if}>{$TYPE|translate}</option>
    {/foreach}
   </select>
   {"Status"|translate}:
   <select name="x{$BASEID}_status">
     {foreach from=$ADDRESSSTATES item=TYPE key=TYPEKEY}
           <option value="{$TYPEKEY}" {if $DATA.status == $TYPEKEY}selected{/if}>{$TYPE|translate}</option>
    {/foreach}

    </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Display name"|translate}</td>
  <td class="right"><input id="x{$BASEID}_title" type="text" name="x{$BASEID}_title" value="{$DATA.title}" size="42" /></td>
 </tr>
 <tr>
  <td class="left">{"First name"|translate} / {"Last name"|translate}</td>
  <td class="right"><select name="x{$BASEID}_gender">
  <option value="0" {if $DATA.gender == 0}selected{/if}>{"unknown"|translate}</option>
  <option value="1" {if $DATA.gender == 1}selected{/if}>{"Mr."|translate}</option>
  <option value="2" {if $DATA.gender == 2}selected{/if}>{"Mrs."|translate}</option>
  </select> <input id="firstName" type="text" name="x{$BASEID}_firstName" value="{$DATA.firstName}" size="11"/>&nbsp;<input id="lastName" type="text" name="x{$BASEID}_lastName" value="{$DATA.lastName}" size="13"/></td>
 </tr>
 {if $DATA.type != 1}
 <tr>
  <td class="left">{"Company"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_organization" value="{$DATA.organization}"  onchange="document.forms['edit'].x{$BASEID}_action.value='save';document.forms['edit'].submit();">
   <option value="0">{"None"|translate}</option>
   {foreach from=$ORGANIZATIONS item=ORGANIZATION}
   <option value="{$ORGANIZATION.id}" {if $DATA.organization == $ORGANIZATION.id}selected{/if}>{$ORGANIZATION.title}</option>
   {/foreach}
  </select>
  </td>
 </tr>
 {/if}
 {if $DATA.type > 2 && $DATA.organization > 0}
 <tr>
  <td class="left">{"Department"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_organizationalUnit" value="{$DATA.organizationalUnit}" {if $DATA.type == '1'}disabled{/if}>
   <option value="0">{"None"|translate}</option>
   {foreach from=$DEPARTMENTS item=DEPARTMENT}
   <option value="{$DEPARTMENT.id}" {if $DATA.organizationalUnit == $DEPARTMENT.id}selected{/if}>{$DEPARTMENT.title}</option>
   {/foreach}
  </select>
  </td>
 </tr>
 {/if}
{if $DATA.type > 2 }
 <tr>
  <td class="left">{"Position"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_position" value="{$DATA.position}" size="42" {if $DATA.type == '1' || $DATA.type == '2'}disabled{/if}/></td>
 </tr>
{/if}

 <tr>
  <td class="left">{"Street"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_street" value="{$DATA.street}" size="42" /></td>
 </tr>
 <tr>
  <td class="left">{"Postal code"|translate} / {"City"|translate}</td>
  <td class="right">
   <input type="text" name="x{$BASEID}_postalCode" value="{$DATA.postalCode}" size="8" />
   <input type="text" name="x{$BASEID}_city" value="{$DATA.city}" size="30" />
  </td>
 </tr>
 <tr>
  <td class="left">{"Country"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_country" onchange="document.forms['edit'].x{$BASEID}_action.value='save';document.forms['edit'].submit();">
   {foreach from=$COUNTRIES item=COUNTRY}
   <option value="{$COUNTRY.country}" {if $COUNTRY.country == $DATA.country}selected{/if}>{$COUNTRY.name}   ({$COUNTRY.country})</option>
   {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Region"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_state">
   <option value="0">{"None"|translate}</option>
   {foreach from=$REGIONS item=REGION}
   <option value="{$REGION.region}" {if $REGION.region == $DATA.state}selected{/if}>{$REGION.name}</option>
   {/foreach}
   </select>
  </td>
 </tr>
  <tr>
   <td class="left">{"Website"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_website" value="{$DATA.website}" size="42" /></td>
  </tr>
   <tr>
   <td class="left">{"Skype"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_skype" value="{$DATA.skype}" size="42" /></td>
  </tr>
  <tr>
   <td class="left">{"E-Mail"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_email" value="{$DATA.email}" size="42" /></td>
  </tr>

  <tr>
   <td class="left">{"Telephone"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_tel" value="{$DATA.tel}" size="20" />
   {if $DATA.tel != ''}<a href="callto://{$DATA.tel}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>

  <tr>
   <td class="left">{"Mobile"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_tel_mobile" value="{$DATA.tel_mobile}" size="20" />
   {if $DATA.tel_mobile != ''}<a href="callto://{$DATA.tel_mobile}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>

  <tr>
   <td class="left">{"Fax"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_fax" value="{$DATA.fax}" size="20" />
   {if $DATA.fax != ''}<a href="callto://{$DATA.fax}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>

{if $DATA.type > 2 }
 <tr>
  <td class="left">{"Birthdate"|translate} (d.m.y)</td>
  <td class="right"><input type="text" name="x{$BASEID}_birthdate_str" id="x{$BASEID}_birthdate_str" value="{$DATA.birthdate|date_format:"%d.%m.%Y"}" size="12" />
  <input type="hidden" name="x{$BASEID}_birthdate" value="{$DATA.birthdate}" />
      {include file="includes/widgets/datepicker.tpl" relative="birthdate_str"}
  </td>
 </tr>
 {/if}
   <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="4" cols="65">{$DATA.description}</textarea></td>
 </tr>

  <tr>
   <td class="left">{"Public (indexed)"|translate}</td>
   <td class="right"> <input type="radio" name="x{$BASEID}_public" value="0" {if $DATA.public==0}checked="checked{/if}" />{"no"|translate}
   <input type="radio" name="x{$BASEID}_public" value="1" {if $DATA.public==1}checked="checked"{/if} />{"yes"|translate}
   </td>
  </tr>

  <tr>
  <td class="left">{"Image"|translate}<a name="image" /></td>
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
       action="deleteImage"
       icon="delete.png"
       form="edit"
       title="Delete Image"
       ask="Are you sure that you want to delete this image"
       id=$DATA.id
   }<br />
   {if $DATA.image < 1}
   <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
   {else}
   <img name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$DATA.image}&amp;file_version=1" alt="" class="picked" />
   {/if}
  </td>
 </tr>

{if $DISPLAY.relations}
{include file="includes/widgets/relations.tpl" cid=$DATA.id ctitle=$DATA.title}
{/if}




 {* PRIVAT *}

 {if $DATA.type > 2 }
 <tr>
  <td class="view_header" colspan="2"><span class="title_light">{"Private Adressangaben"|translate}</span></td>
 </tr>
  <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
  <tr>
   <td class="left">{"E-Mail (Private)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_email_private" value="{$DATA.email_private}" size="42" /></td>
  </tr>
  <tr>
   <td class="left">{"Telephone (Private)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_tel_private" value="{$DATA.tel_private}" size="20" />
   {if $DATA.tel_private != ''}<a href="callto://{$DATA.tel_private}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="left">{"Mobile (Private)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_tel_mobile_private" value="{$DATA.tel_mobile_private}" size="20" />
   {if $DATA.tel_mobile_private != ''}<a href="callto://{$DATA.tel_mobile_private}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
   <tr>
   <td class="left">{"Fax (Private)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_fax_private" value="{$DATA.fax_private}" size="20" />
   {if $DATA.fax_private != ''}<a href="callto://{$DATA.fax_private}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  {/if}




{if $DISPLAY.properties}
{include file="includes/widgets/properties.tpl" content_id=$DATA.id content_type=$BASEID formname="edit" universal=$DISPLAY.properties_universal}
{/if}

{include file="includes/editor.tpl"}
  </table>


{if $DISPLAY.time}
{include file="includes/timed.tpl"}
{/if}



<input type="hidden" name="x{$BASEID}_image" value="{$DATA.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$DATA.image_version}" />
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}" />
<input type="hidden" name="x{$BASEID}_id" value="{$DATA.id}" />
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=true yoffset=true}
{yoffset}
</form>
