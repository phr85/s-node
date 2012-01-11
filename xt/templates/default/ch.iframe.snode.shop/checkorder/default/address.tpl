<br />
<div>
<div style="width:50%;float:left">
<div class="titlebar">{"Billing address"|translate}</div><br />
{$ADDRESS.billing.0.firstName}
{$ADDRESS.billing.0.lastName}<br />
{$ADDRESS.billing.0.street}<br />
{$ADDRESS.billing.0.postalCode} {$ADDRESS.0.city}<br />
</div>

<div style="width:50%;float:left">
<div class="titlebar">{"Shipping address"|translate}</div><br />
{$ADDRESS.shipping.0.firstName}
{$ADDRESS.shipping.0.lastName}<br />
{$ADDRESS.shipping.0.street}<br />
{$ADDRESS.shipping.0.postalCode} {$ADDRESS.0.city}<br />
</div>
</div>
<input type="hidden" name="x{$BASEID}_action" />
<input type="hidden" name="x{$BASEID}_person_id" value="{$ADDRESS.id}" />