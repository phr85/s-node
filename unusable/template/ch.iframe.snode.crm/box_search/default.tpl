<div class="crm_box_container">
<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div class="crm_box">
<h1>{"Search"|translate}</h1>
<div class="crm_box_search">
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td width="130">By <b>Organization / Name</b></td>
  <td align="right">
   <input type="text" name="x{$BASEID}_search_by_name" size="20"/>&nbsp;
   <input type="submit" value="Search" />
  </td>
 </tr>
 <tr>
  <td>By <b>Telephone Nr.</b></td>
  <td align="right">
   <input type="text" name="x{$BASEID}_search_by_tel" size="20"/>&nbsp;
   <input type="submit" value="Search" />
  </td>
 </tr>
</table>
</div>
</div>
</form>
<br />
<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div class="crm_box">
<h1>{"Addresses"|translate}</h1>
<div class="crm_box_search">
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td width="130">By <b>Address type</b></td>
  <td align="right">
   <select name="x{$BASEID}_status">
    <option>All Adresses</option>
    <option>Address only</option>
    <option>Client</option>
    <option>Lead Client</option>
    <option>Friend Client</option>
   </select>
  </td>
 </tr>
</table>
</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$ADDRESSES item=ADDRESS}
 <tr>
  <td class="row"><img src="/images/admin/orange_pixel.gif" width="9" />&nbsp;&nbsp;
  <a href="#">{$ADDRESS.title}</a>{if $ADDRESS.addon != ''}, <a href="#" style="color: black;">{$ADDRESS.addon}</a>{/if}</td>
 </tr>
 {/foreach}
</table>
</form>
</div>