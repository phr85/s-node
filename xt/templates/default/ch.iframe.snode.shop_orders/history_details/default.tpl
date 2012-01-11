<form name="order_details" method="post">


<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">Bestellung:</span><span class="title"> {$DATA.customer.title} {$DATA.order.creation_date|date_format:"%d.%B %Y  %H:%I"}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></td>
 </tr>
 <tr>
  <td class="adleft">Adresse</td>
  <td class="adright">{$DATA.customer.title}<br />
  {$DATA.customer.street}<br />
  {$DATA.customer.postalCode} {$DATA.customer.city}<br /><br />
  </td>
 </tr>
<tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><br /></td>
 </tr>
  {foreach from=$DATA.order_details item=PRODUCT}
 <tr>
  <td class="adleft">&nbsp; </td>
  <td class="adright">{$PRODUCT.quantity} x  {$PRODUCT.title} a  {$PRODUCT.realprice|round5} ==> <b>{$PRODUCT.realprice*$PRODUCT.quantity|round5}</b></td>
 </tr>
 {/foreach}

 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></td>
 </tr>

 <tr>
  <td class="adleft">Versandkosten</td>
  <td class="adright">{$DATA.order.transport|round5}
  </td>
 </tr>
 <tr>
  <td class="adleft">{"total"|translate}</td>
  <td class="adright"><b>{$DATA.total|round5}</b></td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><br /></td>
 </tr>

 </table>
 {actionIcon title="Bestellung in Warenkorb uebertragen" action="reorder" id=$DATA.id form="order_details"}
 <input type="hidden" name="x{$BASEID}_id" value="">
<input type="hidden" name="x{$BASEID}_action" value="">
</form>