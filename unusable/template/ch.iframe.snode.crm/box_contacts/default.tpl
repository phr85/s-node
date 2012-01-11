<div class="crm_box_container">
<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div class="crm_box">
<h1>{"Contacts"|translate} - <span style="color: red;">1 {"New"|translate}</span></h1>
<div class="crm_box_search">
<table cellpadding="0" cellspacing="4" width="100%">
 <tr>
  <td>
   <select name="x{$BASEID}_status">
    <option>Newest contacts</option>
    <option>Today</option>
    <option>Yesterday</option>
    <option>This week</option>
    <option>Last week</option>
   </select>&nbsp;
   <select name="x{$BASEID}_status">
    <option>All types</option>
    <option>By Phone</option>
    <option>By Mail</option>
    <option>Other</option>
   </select>&nbsp;
   <select name="x{$BASEID}_status">
    <option>All statuses</option>
    <option>Open</option>
    <option>Closed</option>
    <option>In Progress</option>
   </select>
  </td>
 </tr>
</table>
</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$CONTACTS item=CONTACT}
 <tr>
  <td class="row">
  {if $CONTACT.status == 0}
  <img src="/images/admin/red_pixel.gif" width="9" />
  {else}
  <img src="/images/admin/orange_pixel.gif" width="9" />
  {/if}
  &nbsp;&nbsp;{if $CONTACT.status == 0}<b>{/if}{$CONTACT.title}{if $CONTACT.status == 0}</b>{/if}{if $CONTACT.addon != ''}, {$CONTACT.addon}{/if}
  </td>
  <td class="row" style="padding: 4px;" align="right"><input type="checkbox" name="x{$BASEID}_contact_change" {if $CONTACT.status == 1}checked disabled{/if}/></td>
 </tr>
 {/foreach}
 <tr>
  <td class="row_links">
   &raquo; <b><a href="#">New contact</a></b><br />
   &raquo; <a href="#">Show all entries</a><br />
   &raquo; <a href="#">Show reports</a><br />
  </td>
 </tr>
</table>
</form>
</div>