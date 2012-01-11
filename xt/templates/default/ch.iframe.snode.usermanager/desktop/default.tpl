<div style="padding: 20px;">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr style="height: 60px;">
  <td width="60"><img src="{$XT_IMAGES}icons/big/users2.png" alt="" /></td>
  <td style="color:white;"><span class="admin_title">{"Online users"|translate}</span></td>
 </tr>
</table>
<br />
<table cellspacing="0" cellpadding="0" width="100%" style="background-color: #4271C5;">
 <tr>
  <td style="padding: 10px; color: #FFFFFF;" valign="top">
   <table cellspacing="0" cellpadding="0" width="100%">
   {foreach from=$USERS item=USER}
    <tr class="{cycle values=desktop_row_a,desktop_row_b}">
     <td class="desktop_row" align="center" style="padding-right: 0px;" width="16"><img src="{$XT_IMAGES}icons/user1.png" alt="" /></td>
     <td class="desktop_row">{$USER.username|truncate:37:"...":true}</td>
    </tr>
   {/foreach}
   <tr class="{cycle values=desktop_row_a,desktop_row_b}">
     <td class="desktop_row" align="center" style="padding-right: 0px;" width="16"><img src="{$XT_IMAGES}icons/user1.png" alt="" /></td>
     <td class="desktop_row">{"Guests"|translate}: {$GUESTS}</td>
    </tr>
   </table>
  </td>
 </tr>
</table>
</div>
