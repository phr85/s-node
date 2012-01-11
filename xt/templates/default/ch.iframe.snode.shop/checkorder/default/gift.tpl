<br /><div class="titlebar">{"Your gifts"|translate}</div>
<div class="subtitlebar">{"Als Dank f�r Ihren Einkauf erhalten Sie die folgenden Dankesch�ngeschenke <b>kostenlos</b> dazu"|translate}</div>
<table style="width: 100%; text-align: left;" border="0" cellpadding="0" cellspacing="1">
<tr>
<td valign="bottom" style="padding:5px;">
</td>
</tr>

{foreach from=$SELECTEDGIFTS key=key item=PRODUCT}
<tr>
 <td class="basket_borderbottom"><b>1 x</b> {$PRODUCT.title}</td>
</tr>
{/foreach}

</table>