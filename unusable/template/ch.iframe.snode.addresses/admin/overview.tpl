<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{include file="includes/buttons.tpl" data=$BUTTONS}
</form>
<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="overview">
<h2>{"Search / Filter"|translate}</h2>
<table cellspacing="0" cellpadding="0" width="100%">
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
<h2>{"List"|translate}</h2>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" width="60">{"Options"|translate}</td>
  <td class="table_header" width="30" onclick="document.forms['overview'].x{$BASEID}_order_by.value='a.id';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.id'}DESC{else}ASC{/if}';document.forms['overview'].submit();">{"ID"|translate} {if $ORDER_BY == 'a.id'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
  <td class="table_header" width="20" onclick="document.forms['overview'].x{$BASEID}_order_by.value='a.status';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.status'}DESC{else}ASC{/if}';document.forms['overview'].submit();">&nbsp;{if $ORDER_BY == 'a.status'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
  <td class="table_header" width="20" onclick="document.forms['overview'].x{$BASEID}_order_by.value='a.type';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.type'}DESC{else}ASC{/if}';document.forms['overview'].submit();">&nbsp;{if $ORDER_BY == 'a.type'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
  <td class="table_header" width="180" onclick="document.forms['overview'].x{$BASEID}_order_by.value='a.title';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.title'}DESC{else}ASC{/if}';document.forms['overview'].submit();">{"Organization / Name"|translate} {if $ORDER_BY == 'a.title'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
  <td class="table_header" width="150" onclick="document.forms['overview'].x{$BASEID}_order_by.value='a.street';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.street'}DESC{else}ASC{/if}';document.forms['overview'].submit();">{"Street"|translate} {if $ORDER_BY == 'a.street'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
  <td class="table_header" width="40" onclick="document.forms['overview'].x{$BASEID}_order_by.value='a.postalCode';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.postalCode'}DESC{else}ASC{/if}';document.forms['overview'].submit();">{"Postal code"|translate} {if $ORDER_BY == 'a.postalCode'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
  <td class="table_header" width="150" onclick="document.forms['overview'].x{$BASEID}_order_by.value='a.city';document.forms['overview'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.city'}DESC{else}ASC{/if}';document.forms['overview'].submit();">{"City"|translate} {if $ORDER_BY == 'a.city'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
  <td class="table_header" width="20">&nbsp;</td>
  <td class="table_header" width="20">&nbsp;</td>
  <td class="table_header">{"Telephone"|translate}</td>
 </tr>
 {foreach from=$ADDRESSES item=ADDRESS}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{
  actionIcon
      action="editAddress"
      icon="pencil.png"
      form="overview"
      title="Edit address"
      address_id=$ADDRESS.id
  }{
  actionIcon
      action="deleteAddress"
      icon="delete.png"
      form="overview"
      title="Delete address"
      address_id=$ADDRESS.id
      ask="Are you sure, you want to delete this address?"
  }{if $ADDRESS.timer == 'ready'}<img src="{$XT_IMAGES}icons/alarmclock_pause.png" alt="" width="16" />{/if
      }{if $ADDRESS.timer == 'expired'}<img src="{$XT_IMAGES}icons/alarmclock_stop.png" alt="" width="16" />{/if
      }{if $ADDRESS.timer == 'running'}<img src="{$XT_IMAGES}icons/alarmclock_run.png" alt="" width="16" />{/if
      }{if $ADDRESS.timer == 'unused'}<img src="{$XT_IMAGES}spacer.gif" alt="" width="16" />{/if}</td>
  <td class="row" style="color: #999999;">{$ADDRESS.id}&nbsp;</td>
  <td class="button">{if $ADDRESS.status == 1}<img src="{$XT_IMAGES}icons/pin_yellow.png" alt=""/>{else}{if $ADDRESS.status == 2}<img src="{$XT_IMAGES}icons/pin_green.png" width="16" />{else}{if $ADDRESS.status == 3}<img src="{$XT_IMAGES}icons/pin_red.png" width="16" />{else}<img src="{$XT_IMAGES}icons/pin_grey.png" width="16" />{/if}{/if}{/if}</td>
  <td class="button">{if $ADDRESS.type == 1}<img src="{$XT_IMAGES}icons/factory.png" alt="" />{/if}{if $ADDRESS.type == 3}<img src="{$XT_IMAGES}icons/user2.png" alt="" />{/if}{if $ADDRESS.type == 2}<img src="{$XT_IMAGES}icons/users1.png" alt="" />{/if}</td>
  <td class="row">{
  actionLink
      action="editAddress"
      form="overview"
      title="Edit address"
      address_id=$ADDRESS.id
      text=$ADDRESS.title
  }{if $ADDRESS.type == 2}, {
  actionLink
      action="editAddress"
      form="overview"
      title="Edit address"
      address_id=$ADDRESS.company_id
      text=$ADDRESS.company
  }{/if}</td>
  <td class="row">{$ADDRESS.street|truncate:25:"...":true}&nbsp;</td>
  <td class="row">{$ADDRESS.postalCode}&nbsp;</td>
  <td class="row">{$ADDRESS.city|truncate:20:"...":true} {if $ADDRESS.regioncode != ''}({$ADDRESS.regioncode}){/if}&nbsp;</td>
  <td class="row" style="padding: 3px;padding-top: 4px;">{if $ADDRESS.email != ''}<a href="mailto:{$ADDRESS.email}"><img src="{$XT_IMAGES}icons/mail2.png" alt="" /></a>{else}&nbsp;{/if}</td>
  <td class="row" style="padding: 3px;padding-top: 4px;">{if $ADDRESS.website != ''}<a target="_blank" href="{$ADDRESS.website}"><img src="{$XT_IMAGES}icons/earth2.png" alt="" /></a>{else}&nbsp;{/if}</td>
  <td class="row">{$ADDRESS.tel}&nbsp;</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_address_id" />
<input type="hidden" name="x{$BASEID}_order_by" />
<input type="hidden" name="x{$BASEID}_order_by_dir" />
<input type="hidden" name="x{$BASEID}_action" />
{include file="includes/navigator.tpl" form="overview"}
</form>

