<div style="padding: 20px; padding-top: 0px;">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr style="height: 60px;">
  <td width="60"><img src="{$XT_IMAGES}icons/big/shoppingcart.png" alt="" /></td>
  <td style="color:white;"><span class="admin_title">{"Shop"|translate}</span><br />{"Information about your shop activity"|translate}</td>
 </tr>
</table>
<br />
<table cellspacing="0" cellpadding="0" width="100%" style="background-color: #4271C5;">
 <tr>
  <td style="padding: 10px; color: #FFFFFF;" valign="top">
   <table cellpadding="0" cellspacing="0" width="100%">
    <tr class="{cycle values=desktop_row_a,desktop_row_b}">
     <td class="desktop_row" align="center" style="padding-right: 0px;" width="16"><img src="{$XT_IMAGES}icons/shoppingcart_full.png" alt="" /></td>
     <td class="desktop_row">{"Last order"|translate} #{$LAST_ORDER.id}: <b>{$LAST_ORDER.creation_date|date_format:"%d.%m.%Y %H:%I"}</b></td>
    </tr>
    <tr class="{cycle values=desktop_row_a,desktop_row_b}">
     <td class="desktop_row" align="center" style="padding-right: 0px;" width="16"><img src="{$XT_IMAGES}icons/shoppingcart_full.png" alt="" /></td>
     <td class="desktop_row">{"New orders"|translate}: <b>{$NEW_ORDER_COUNT}</b></td>
    </tr>
    <tr class="{cycle values=desktop_row_a,desktop_row_b}">
     <td class="desktop_row" align="center" style="padding-right: 0px;" width="16"><img src="{$XT_IMAGES}icons/shoppingcart_full.png" alt="" /></td>
     <td class="desktop_row">{"Total order count"|translate}: <b>{$TOTAL_ORDER_COUNT}</b></td>
    </tr>
    <tr class="{cycle values=desktop_row_a,desktop_row_b}">
     <td class="desktop_row" align="center" style="padding-right: 0px;" width="16"><img src="{$XT_IMAGES}icons/shoppingcart_full.png" alt="" /></td>
     <td class="desktop_row">{"Total revenue"|translate}: <b>{$TOTAL_PRICE_COUNT|round5} CHF</b></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
</div>
