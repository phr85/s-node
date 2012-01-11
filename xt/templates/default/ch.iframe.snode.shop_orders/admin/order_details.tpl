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
  <td class="left">Rechnungsadresse</td>
  <td class="right">
    {$ADDRESS.billing.0.position}<br />
    {if $ADDRESS.billing.0.gender ==1}{"Herr"|translate}{/if}
    {if $ADDRESS.billing.0.gender ==2}{"Frau"|translate}{/if}
    {$ADDRESS.billing.0.firstName}
    {$ADDRESS.billing.0.lastName}<br />
    {$ADDRESS.billing.0.street}<br />
    {$ADDRESS.billing.0.postalCode} {$ADDRESS.billing.0.city}<br /><br />
    {if $ADDRESS.billing.0.email != ""}{"E-Mail"|translate}: <a href="mailto:{$ADDRESS.billing.0.email}">{$ADDRESS.billing.0.email}</a><br />{/if}
    {if $ADDRESS.billing.0.tel != ""}{"Tel"|translate}: {$ADDRESS.billing.0.tel}<br />{/if}
    {if $ADDRESS.billing.0.tel_mobile != ""}{"Mobile"|translate}: {$ADDRESS.billing.0.tel_mobile}<br />{/if}
  </td>
 </tr>
 <tr>
  <td class="left">Lieferadresse</td>
  <td class="right">
{$ADDRESS.shipping.0.position}<br />
    {if $ADDRESS.shipping.0.gender ==1}{"Herr"|translate}{/if}
    {if $ADDRESS.shipping.0.gender ==2}{"Frau"|translate}{/if}
    {$ADDRESS.shipping.0.firstName}
    {$ADDRESS.shipping.0.lastName}<br />
    {$ADDRESS.shipping.0.street}<br />
    {$ADDRESS.shipping.0.postalCode} {$ADDRESS.shipping.0.city}<br /><br />
    {if $ADDRESS.shipping.0.email != ""}{"E-Mail"|translate}: <a href="mailto:{$ADDRESS.shipping.0.email}">{$ADDRESS.shipping.0.email}</a><br />{/if}
    {if $ADDRESS.shipping.0.tel != ""}{"Tel"|translate}: {$ADDRESS.shipping.0.tel}<br />{/if}
    {if $ADDRESS.shipping.0.tel_mobile != ""}{"Mobile"|translate}: {$ADDRESS.shipping.0.tel_mobile}<br />{/if}
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
  <td class="left">{$PRODUCT.art_nr}</td>
  <td class="right">{$PRODUCT.quantity} x {$PRODUCT.title}{if $PRODUCT.subtitle != ""} - {$PRODUCT.subtitle}{/if} à  {$PRODUCT.realprice|round5} ==> <b>{$PRODUCT.realprice*$PRODUCT.quantity|round5}</b></td>
 </tr>
 {/foreach}

 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></td>
 </tr>

 <tr>
  <td class="left">{"transport"|translate}</td>
  <td class="right">{$DATA.order.transport|round5}
  </td>
 </tr>
 <tr>
  <td class="left">{"Total"|translate}</td>
  <td class="right"><b>{$DATA.total|round5}</b></td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt=""></td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><br /></td>
 </tr>

 </table>

 <input type="hidden" name="x{$BASEID}_id" value="">
<input type="hidden" name="x{$BASEID}_action" value="">
</form>