{if !$AUTH}
<br /><div class="titlebar">{"Login"|translate}</div>
<div class="subtitlebar">Falls Sie bereits in unserem Shop registriert sind...</div><br />
{subplugin package="ch.iframe.snode.usermanager" module="loginbox" target="`$smarty.server.PHP_SELF`?TPL=$TPL"}
<br /><div class="titlebar">{"New customer"|translate}</div>
<div class="subtitlebar">Sie sind noch nicht registriert? Mit untenstehendem Formular können Sie sich schnell und einfach anmelden.</div><br />
{subplugin package="ch.iframe.snode.securitycenter" module="register"}
{else}
<form name="address" method="POST">
<table caption="{"address list"|translate}">
<tr>
	<th>Lieferadresse</th>
	<th>Rechnungsadresse</th>
	<th>Adressinformation</th>
</tr>

{foreach from=$xt2400_addressdata.addresses item=AD name="addresslist"}
	<tr>
		<td><input type="radio" name="x{$BASEID}_shipping_address" value="{$AD.id}" {if $smarty.foreach.addresslist.first && $xt2400_addressdata.shipping_address == ""}checked{/if}{if $xt2400_addressdata.shipping_address == $AD.id}checked{/if}></td>
		<td><input type="radio" name="x{$BASEID}_billing_address" value="{$AD.id}" {if $smarty.foreach.addresslist.first && $xt2400_addressdata.billing_address == ""}checked{/if}{if $xt2400_addressdata.billing_address == $AD.id}checked{/if}></td>
		<td>{$AD.firstName} {$AD.lastName}<br>
			{$AD.street}<br/>
			{$AD.PLZ} {$AD.city}
		</td>
	</tr>
{/foreach}
</table>
<input type="hidden" name="x{$BASEID}_action" />
</form>
{/if}