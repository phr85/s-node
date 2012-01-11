<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="edit">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Address"|translate}:</span> <span class="title">{$ADDRESS.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td width="200" valign="top">

<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td style="padding: 10px; padding-top: 15px;">
{if $ADDRESS.image > 0}
    {if $ADDRESS.image_type == 2}
        <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="182" height="{math equation=182/(width/height) width=$ADDRESS.width height=$ADDRESS.height}">
        <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$ADDRESS.image}" />
        <param name="quality" value="high" />
        <embed src="{$XT_WEB_ROOT}download.php?file_id={$ADDRESS.image}" quality="high" width="182" height="{math equation=182/(width/height) width=$ADDRESS.width height=$ADDRESS.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
        </object>
        </div>
        <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}spacer.gif" alt="" />
    {else}
        <a href="#" onclick="popup('{$smarty.server.PHP_SELF}?TPL=597&x240_field=x{$BASEID}_image&x240_form=edit',770,470,'picker');">
        <img style="cursor: hand; cursor: pointer;" name="x{$BASEID}_image_view" src="{$XT_WEB_ROOT}download.php?file_id={$ADDRESS.image}&file_version=1" alt="" />
        </a>
    {/if}
{else}
    {if $ADDRESS.type == 1}
        <a href="#"  onclick="popup('{$smarty.server.PHP_SELF}?TPL=597&x240_field=x{$BASEID}_image&x240_form=edit',770,470,'picker');">
        <img style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}admin/company_na.jpg" name="x{$BASEID}_image_view" /></a>
    {else}
        {if $ADDRESS.gender == 1}
            <a href="#"  onclick="popup('{$smarty.server.PHP_SELF}?TPL=597&x240_field=x{$BASEID}_image&x240_form=edit',770,470,'picker');">
            <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}admin/user_na.jpg" /></a>
         {else}
            <a href="#"  onclick="popup('{$smarty.server.PHP_SELF}?TPL=597&x240_field=x{$BASEID}_image&x240_form=edit',770,470,'picker');">
            <img name="x{$BASEID}_image_view" src="{$XT_IMAGES}admin/user_na2.jpg" /></a>
         {/if}
    {/if}
{/if}
<br />
  </td>
 </tr>
</table>

  </td>
  <td width="410" valign="top">

<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="left">{"Address type"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_type" onchange="document.forms['edit'].x{$BASEID}_action.value='save';document.forms['edit'].submit();">
    <option value="3" {if $ADDRESS.type == '3'}selected{/if}>{"Person"|translate}</option>
    <option value="1" {if $ADDRESS.type == '1'}selected{/if}>{"Company"|translate}</option>
    <option value="2" {if $ADDRESS.type == '2'}selected{/if}>{"Department"|translate}</option>
   </select>
   <select name="x{$BASEID}_status">
     <option value="0" {if $ADDRESS.status == '0'}selected{/if}>{"Cold address"|translate}</option>
     <option value="1" {if $ADDRESS.status == '1'}selected{/if}>{"Lead"|translate}</option>
     <option value="2" {if $ADDRESS.status == '2'}selected{/if}>{"Customer"|translate}</option>
     <option value="3" {if $ADDRESS.status == '3'}selected{/if}>{"Dead"|translate}</option>
    </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Display name"|translate}</td>
  <td class="right"><input id="x{$BASEID}_title" type="text" name="x{$BASEID}_title" value="{$ADDRESS.title}" size="42" {if $ADDRESS.type == 3}readonly{/if}/></td>
 </tr>
 <tr>
  <td class="left">{"First name"|translate} / {"Last name"|translate}</td>
  <td class="right"><select name="x{$BASEID}_gender" {if $ADDRESS.type == '1' || $ADDRESS.type == '2'}disabled{/if}>
  <option value="1" {if $ADDRESS.gender == 1}selected{/if}>{"Mr."|translate}</option>
  <option value="2" {if $ADDRESS.gender == 2}selected{/if}>{"Mrs."|translate}</option>
  </select> <input id="firstName" onkeyup="document.getElementById('x{$BASEID}_title').value=document.getElementById('lastName').value + ' ' + this.value" type="text" name="x{$BASEID}_firstName" value="{$ADDRESS.firstName}" size="11" {if $ADDRESS.type == '1' || $ADDRESS.type == '2'}disabled{/if}/>&nbsp;<input id="lastName" onkeyup="document.getElementById('x{$BASEID}_title').value=this.value + ' ' + document.getElementById('firstName').value" type="text" name="x{$BASEID}_lastName" value="{$ADDRESS.lastName}" size="13" {if $ADDRESS.type == '1' || $ADDRESS.type == '2'}disabled{/if}/></td>
 </tr>
 <tr>
  <td class="left">{"Company"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_organization" value="{$ADDRESS.organization}" {if $ADDRESS.type == '1'}disabled{/if} onchange="document.forms['edit'].x{$BASEID}_action.value='save';document.forms['edit'].submit();">
   <option value="0">{"None"|translate}</option>
   {foreach from=$ORGANIZATIONS item=ORGANIZATION}
   <option value="{$ORGANIZATION.id}" {if $ADDRESS.organization == $ORGANIZATION.id}selected{/if}>{$ORGANIZATION.title}</option>
   {/foreach}
  </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Department"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_organizationalUnit" value="{$ADDRESS.organizationalUnit}" {if $ADDRESS.type == '1'}disabled{/if}>
   <option value="0">{"None"|translate}</option>
   {foreach from=$DEPARTMENTS item=DEPARTMENT}
   <option value="{$DEPARTMENT.id}" {if $ADDRESS.organizationalUnit == $DEPARTMENT.id}selected{/if}>{$DEPARTMENT.title}</option>
   {/foreach}
  </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Position"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_position" value="{$ADDRESS.position}" size="42" {if $ADDRESS.type == '1' || $ADDRESS.type == '2'}disabled{/if}/></td>
 </tr>
 <tr>
  <td class="left">{"Street"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_street" value="{$ADDRESS.street}" size="42" /></td>
 </tr>
 <tr>
  <td class="left">{"Postal code"|translate} / {"City"|translate}</td>
  <td class="right">
   <input type="text" name="x{$BASEID}_postalCode" value="{$ADDRESS.postalCode}" size="8" />
   <input type="text" name="x{$BASEID}_city" value="{$ADDRESS.city}" size="30" />
  </td>
 </tr>
 <tr>
  <td class="left">{"Country"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_country" onchange="document.forms['edit'].x{$BASEID}_action.value='save';document.forms['edit'].submit();">
   {foreach from=$COUNTRIES item=COUNTRY}
   <option value="{$COUNTRY.country}" {if $COUNTRY.country == $ADDRESS.country}selected{/if}>{$COUNTRY.name}</option>
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
   <option value="{$REGION.region}" {if $REGION.region == $ADDRESS.state}selected{/if}>{$REGION.name}</option>
   {/foreach}
   </select>
  </td>
 </tr>
</table>
</td>
<td valign="top">
 <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td class="left">{"Website"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_website" value="{$ADDRESS.website}" size="42" /></td>
  </tr>
  <tr>
   <td class="left">{"E-Mail (Business)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_email" value="{$ADDRESS.email}" size="42" /></td>
  </tr>
  <tr>
   <td class="left">{"E-Mail (Private)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_email_private" value="{$ADDRESS.email_private}" size="42" /></td>
  </tr>
  <tr>
   <td class="left">{"Telephone (Business)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_tel" value="{$ADDRESS.tel}" size="20" />
   {if $ADDRESS.tel != ''}<a href="callto://{$ADDRESS.tel}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="left">{"Telephone (Private)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_tel_private" value="{$ADDRESS.tel_private}" size="20" />
   {if $ADDRESS.tel_private != ''}<a href="callto://{$ADDRESS.tel_private}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="left">{"Mobile (Business)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_tel_mobile" value="{$ADDRESS.tel_mobile}" size="20" />
   {if $ADDRESS.tel_mobile != ''}<a href="callto://{$ADDRESS.tel_mobile}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="left">{"Mobile (Private)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_tel_mobile_private" value="{$ADDRESS.tel_mobile_private}" size="20" />
   {if $ADDRESS.tel_mobile_private != ''}<a href="callto://{$ADDRESS.tel_mobile_private}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="left">{"Fax (Business)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_fax" value="{$ADDRESS.fax}" size="20" />
   {if $ADDRESS.fax != ''}<a href="callto://{$ADDRESS.fax}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="left">{"Fax (Private)"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_fax_private" value="{$ADDRESS.fax_private}" size="20" />
   {if $ADDRESS.fax_private != ''}<a href="callto://{$ADDRESS.fax_private}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="left">{"Public (indexed)"|translate}</td>
   <td class="right"> <input type="radio" name="x{$BASEID}_public" value="0" {if $ADDRESS.public==0}checked="checked{/if}" />{"no"|translate}
   <input type="radio" name="x{$BASEID}_public" value="1" {if $ADDRESS.public==1}checked="checked"{/if} />{"yes"|translate}
   </td>
  </tr>
  </table>
 </td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td colspan="2">
 {include file="includes/timed.tpl" form="edit"}
 </td>
 </tr>
 {if $DISPLAY.categories}
  <tr>
  <td>&nbsp;</td>
  <td><br /><span class="title_light">{"Category tree"|translate}:</span><br /><br /><iframe src="/index.php?TPL=555&amp;ctype={$BASEID}&amp;cid={$ADDRESS.id}&amp;ctitle={$ADDRESS.title}&amp;mod=tree" style="width:95%; height:280px"></iframe></td>
  <td><br /><span class="title_light">{"Category list"|translate}:</span><br /><br /><iframe src="/index.php?TPL=555&amp;ctype={$BASEID}&amp;cid={$ADDRESS.id}&amp;ctitle={$ADDRESS.title}&amp;mod=list" style="width:335px; height:280px"></iframe></td>
  </tr>
  {/if}
</table>

<input type="hidden" name="x{$BASEID}_image" value="{$ADDRESS.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$ADDRESS.image_version}" />
</form>