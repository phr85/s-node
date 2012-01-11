{XT_load_js file="jquery-plugins/jquery.qtip.js"}
	<div class="ordercolumnleft">
		<h2>Lieferadresse</h2>
		<div class="form_element">
			<label for="name">Name</label>
			<input type="text" id="name" name="x9200_address[name]" value="{$FORMVALUES.address.name}" />
			{if $ADDRESSERRORS.name}
			<div class="erroricon_order required"><img src="/images/ch.iframe.snode.microshop/error.png" alt="Fehler" /></div>
			{/if}
			<br />
		</div>
		<div class="form_element">
			<label for="streetnr">Strasse / Nr.</label>
			<input type="text" id="streetnr" name="x9200_address[streetnr]" value="{$FORMVALUES.address.streetnr}" />
			{if $ADDRESSERRORS.streetnr}
			<div class="erroricon_order required"><img src="/images/ch.iframe.snode.microshop/error.png" alt="Fehler" /></div>
			{/if}
			<br />
		</div>
		<div class="form_element">
			<label for="zipcity">PLZ / Ort</label>
			<input type="text" id="zipcity" name="x9200_address[zipcity]" value="{$FORMVALUES.address.zipcity}" />
			{if $ADDRESSERRORS.zipcity}
			<div class="erroricon_order required"><img src="/images/ch.iframe.snode.microshop/error.png" alt="Fehler" /></div>
			{/if}
			<br />
		</div>
		<div class="form_element">
			<label for="country">Land</label>
			<input type="text" id="country" name="x9200_address[country]" value="{$FORMVALUES.address.country}" />
			{if $ADDRESSERRORS.country}
			<div class="erroricon_order required"><img src="/images/ch.iframe.snode.microshop/error.png" alt="Fehler" /></div>
			{/if}
			<br />
		</div>
		<div class="form_element">
			<label for="email">E-Mail</label>
			<input type="text" id="email" name="x9200_address[email]" value="{$FORMVALUES.address.email}" />
			{if $ADDRESSERRORS.email}
			<div class="erroricon_order email"><img src="/images/ch.iframe.snode.microshop/error.png" alt="Fehler" /></div>
			{/if}
			<br />
		</div>
		<div class="ordercolumnleft">
		<h2>Dental Depot</h2>
		<div class="form_element">
			<label for="depot_name">Name</label>
			<input type="text" id="depot_name" name="x9200_address[depot_name]" value="{$FORMVALUES.address.depot_name}" />
			{if $ADDRESSERRORS.depot_name}
			<div class="erroricon_order required"><img src="/images/ch.iframe.snode.microshop/error.png" alt="Fehler" /></div>
			{/if}
			<br />
		</div>
		<div class="form_element">
			<label for="depot_city">Ort</label>
			<input type="text" id="depot_city" name="x9200_address[depot_city]" value="{$FORMVALUES.address.depot_city}" />
			{if $ADDRESSERRORS.depot_city}
			<div class="erroricon_order required"><img src="/images/ch.iframe.snode.microshop/error.png" alt="Fehler" /></div>
			{/if}
			<br />
		</div>
	</div>
	</div>
	<div class="ordercolumnright">
		<h2>Bestellung</h2>
		{foreach from=$PRODUCTS item=PRODUCT name=L}
		{if $FORMVALUES.products[$PRODUCT.id]}
		<div class="form_element">
			{$FORMVALUES.products[$PRODUCT.id]} x {$PRODUCT.title} <div class="pricelist">{$PRODUCTSUM[$PRODUCT.id]|round0} {$DISPLAY.currency}</div>
		</div>
		{/if}
		{/foreach}
		{foreach from=$PRODUCTS item=PRODUCT name=L}
		{if $PRODUCT.freeproducts}
		<div class="form_element freeproduct">
			{$PRODUCT.freeproducts} x {$PRODUCT.title} <div class="pricelist">0 {$DISPLAY.currency}</div>
		</div>
		{/if}
		{/foreach}
	</div>
	{if $SUM > 0}
	<div class="ordercolumnright">
		<h2 class="total">Total<span>{$SUM} {$DISPLAY.currency}</span></h2>
	</div>
	{else}
	<div class="ordercolumnright">
		<h2 class="total">Keine Produkte ausgewählt.</h2>
	</div>
	{/if}
	<div class="ordercolumnright agb">
		{$DISPLAY.agb}
	</div>
	<div class="ordercolumnright buttons">
		<input type="image" name="x9200_change" value="change" src="/images/ch.iframe.snode.microshop/change.png" />
		{if $SUM > 0}
		<input type="image" name="x9200_send" value="send" src="/images/ch.iframe.snode.microshop/send.png" />
		{/if}
	</div>

{literal}
<script type="text/javascript">
<!--
$('.required').qtip({
	content: 'Bitte füllen Sie dieses Feld aus',
	show: 'mouseover',
	hide: 'mouseout',
	position: {
		corner: {target: 'topMiddle', tooltip: 'bottomMiddle'}
	},
	style: {
		background: '#9d162a',
        width: 150,
        color: '#ffffff',
        padding: 5,
        border: 0,
        tip: { // Now an object instead of a string
            corner: 'bottomMiddle', // We declare our corner within the object using the corner sub-option
            color: '#9d162a',
            size: {
               x: 20, // Be careful that the x and y values refer to coordinates on screen, not height or width.
               y : 8 // Depending on which corner your tooltip is at, x and y could mean either height or width!
            }
		}
	}
})
$('.email').qtip({
	content: 'Bitte geben Sie eine gültige E-Mail Adresse ein',
	show: 'mouseover',
	hide: 'mouseout',
	position: {
		corner: {target: 'topMiddle', tooltip: 'bottomMiddle'}
	},
	style: {
		background: '#9d162a',
        width: 150,
        color: '#ffffff',
        padding: 5,
        border: 0,
        tip: { // Now an object instead of a string
            corner: 'bottomMiddle', // We declare our corner within the object using the corner sub-option
            color: '#9d162a',
            size: {
               x: 20, // Be careful that the x and y values refer to coordinates on screen, not height or width.
               y : 8 // Depending on which corner your tooltip is at, x and y could mean either height or width!
            }
		}
	}
})
//-->
</script>
{/literal}