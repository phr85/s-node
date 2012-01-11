<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="overview">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Search / Filter"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="search_box">
   {"Search for"|translate}&nbsp;
   <input type="text" name="x{$BASEID}_search" />&nbsp;
   {"in"|translate}&nbsp;
   <select name="x{$BASEID}_search_field">
    <option value="a.title">{"Organization / Name"|translate}</option>
    <option value="a.firstName">{"First name"|translate}</option>
    <option value="a.lastName">{"Last name"|translate}</option>
    <option value="a.street">{"Street"|translate}</option>
    <option value="a.postalCode">{"Postal code"|translate}</option>
    <option value="a.city">{"City"|translate}</option>
    <option value="a.id">{"ID"|translate}</option>
   </select>
   <input type="submit" value="{'Search'|translate}" />
  </td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"List"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" width="30">&nbsp;</td>
  <td class="table_header" width="30" onclick="document.forms['overview'].x{$BASEID}_order_by.value='a.id';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.id'}DESC{else}ASC{/if}';document.forms['overview'].submit();">{"ID"|translate} {if $ORDER_BY == 'a.id'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
  <td class="table_header" width="180" onclick="document.forms['overview'].x{$BASEID}_order_by.value='a.title';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.title'}DESC{else}ASC{/if}';document.forms['overview'].submit();">{"Organization / Name"|translate} {if $ORDER_BY == 'a.title'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
  <td class="table_header" width="150" onclick="document.forms['overview'].x{$BASEID}_order_by.value='a.street';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.street'}DESC{else}ASC{/if}';document.forms['overview'].submit();">{"Street"|translate} {if $ORDER_BY == 'a.street'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
  <td class="table_header" width="40" onclick="document.forms['overview'].x{$BASEID}_order_by.value='a.postalCode';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.postalCode'}DESC{else}ASC{/if}';document.forms['overview'].submit();">{"Postal code"|translate} {if $ORDER_BY == 'a.postalCode'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
  <td class="table_header" width="150" onclick="document.forms['overview'].x{$BASEID}_order_by.value='a.city';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.city'}DESC{else}ASC{/if}';document.forms['overview'].submit();">{"City"|translate} {if $ORDER_BY == 'a.city'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
 </tr>
 {foreach from=$ADDRESSES item=ADDRESS}
 <tr class="{cycle values=row_a,row_b}">
  <td class="row" style="color: #999999;">
  <a href="#" onclick="window.opener.document.getElementById('{$field|default:"address"}').value={$ADDRESS.id};window.opener.document.getElementById('{$field|default:"address"}_title').value='{$ADDRESS.title},{$ADDRESS.street}, {$ADDRESS.postalCode} {$ADDRESS.city}';window.close();">
  <img src="{$XT_IMAGES}icons/check_small.png" width="12" height="12" alt="&nbsp;" /></a></td>
  <td class="row" style="color: #999999;">{$ADDRESS.id}&nbsp;</td>
  <td class="row">{$ADDRESS.title}&nbsp;</td>
  <td class="row">{$ADDRESS.street|truncate:25:"...":true}&nbsp;</td>
  <td class="row">{$ADDRESS.postalCode}&nbsp;</td>
  <td class="row">{$ADDRESS.city|truncate:20:"...":true} {if $ADDRESS.regioncode != ''}({$ADDRESS.regioncode}){/if}&nbsp;</td>
 </tr>
 {/foreach}
</table>
{include file="includes/navigator.tpl" form="overview"}
<input type="hidden" name="x{$BASEID}_address_id" />
<input type="hidden" name="x{$BASEID}_order_by" />
<input type="hidden" name="x{$BASEID}_order_by_dir" />
<input type="hidden" name="x{$BASEID}_action" />
</form>