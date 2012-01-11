<table  border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td colspan="2" align="left" valign="top" style="font-size:20px;">Ihr Promogeschenk
</td>
</td>
</tr>
{foreach from=$GIVENPROMO item=PROMO}
<tr>
 <td class="catbasketrow"><b>{$PROMO.quantity} x</b> {$PROMO.title}<br />{$PROMO.lead}</td>
 <td class="catbasketrow" align="right">{if $PROMO.image > 0}{image id=$PROMO.image version=0}{/if}</td>
</tr>
{/foreach}
</table>