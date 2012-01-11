<form method="post" name="licence">
{include file="ch.iframe.snode.installer/admin/hiddenValues.tpl"}
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td class="view_header" colspan="2">
<span class="title_light">{"Licencegenerator"|translate}</span>
</td>
</tr>
<tr>
<td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
</tr>
<tr>
<td colspan="2">
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="1"}
</td>
</tr>
<tr>
 <td class="left">
    Vorname des lizenznehmers 
 </td>
 <td class="right">
   <input type="text" name="x{$BASEID}_value[firstname]" value="{$VALUES.firstname}" />
 </td>
</tr>
<tr>
 <td class="left">
   Name des lizenznehmers
 </td>
 <td class="right">
  <input type="text" name="x{$BASEID}_value[lastname]" value="{$VALUES.lastname}" />
 </td>
</tr>
<tr>
 <td class="left">
  Produktname
 </td>
 <td class="right">
<select name=x{$BASEID}_value[product]" style="width:200px;"/>
 {foreach from=$PRODUCTS item=PRODUCT}
      <option label="{$PRODUCT}" value="{$PRODUCT}" {if $SELECTEDPRODUCT == $PRODUCT}selected="selected"{/if}>{$PRODUCT}</option>  
 {/foreach}
 </select>
 </td>
</tr>
<tr>
 <td class="left">
   Ablaufdatum 08-Okt-2006 
 </td>
 <td class="right">
  <input type="text" name="x{$BASEID}_value[date]" value="{$VALUES.date|default:"never"}">
 </td>
</tr>
<tr>
 <td class="left">
   userid
 </td>
 <td class="right">
  <input type="text" name="x{$BASEID}_value[userid]" value="{$VALUES.userid}">
 </td>
</tr>
<tr>
 <td class="left">
   bundleid
 </td>
 <td class="right">
  <input type="text" name="x{$BASEID}_value[bundleid]" value="{$VALUES.bundleid}">
 </td>
</tr>
<tr>
 <td class="left">
   domainname
 </td>
 <td class="right">
  <input type="text" name="x{$BASEID}_value[domainname]" value="{$VALUES.domainname}">
 </td>
</tr>
</table>
</form>
{foreach from=$OUTPUT item=LINE}
{$LINE}<br />
{/foreach}