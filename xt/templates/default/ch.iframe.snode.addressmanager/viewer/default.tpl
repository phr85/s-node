{foreach from=$xt7400_viewer.data item=ADDRESS}
<div class="address_view">
<b>{$ADDRESS.title}</b><br />
{$ADDRESS.street}<br />
{$ADDRESS.postalCode} {$ADDRESS.city}<br />
Tel. {$ADDRESS.tel}<br />
Fax {$ADDRESS.fax}<br />
{$ADDRESS.email}
</div>
{/foreach}