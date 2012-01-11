
<h1>{"Objekte die mit Ihrem Suchabo Übereinstimmen"}</h1>
<br />
<table style="width: 600px;" border="0" cellpadding="0" cellspacing="0">
{foreach from=$DATA name=p item=PRODUCT}
<tr>
<td colspan="2">
<h2><a href="http://{$smarty.server.SERVER_NAME}{$smarty.server.PHP_SELF}?TPL=10064&x{$BASEID}_article_id={$PRODUCT.id}">{$PRODUCT.title}</a></h2>
<br />
</td>
</tr>
<tr>
<td width="150" valign="top">
{if $PRODUCT.image_id > 0}
<div style="width:142px; border: 1px solid black; height:86px; padding:1px;"><img src="http://{$smarty.server.SERVER_NAME}/download.php?file_id={$PRODUCT.image_id}&file_version=7" alt="" width="140" height="84" /></div>
{/if}
&nbsp;
</td>
<td valign="top">
{$PRODUCT.description}
<br />
</td>
</tr>
{/foreach}
</table>