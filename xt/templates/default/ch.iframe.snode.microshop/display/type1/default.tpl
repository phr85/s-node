{XT_load_js file="jquery-plugins/jquery.qtip.js"}
{foreach from=$PRODUCTS item=PRODUCT name=L}
<div class="product" style="background: transparent url(/download.php?file_id={$PRODUCT.image}&amp;file_version=orig) no-repeat right bottom;">
	<div class="description">
		<h2>{$PRODUCT.title}</h2>
		<p>{$PRODUCT.text}</p>
	</div>
	<div class="price">
	{$PRODUCT.price|round0}<span>{$DISPLAY.currency}</span><br />
	<input{if $ERRORS[$PRODUCT.id]} class="error"{/if} type="text" name="x9200_prod[{$PRODUCT.id}]" id="x9200_prod[{$PRODUCT.id}]" value="{$FORMVALUES.products[$PRODUCT.id]}" />
	<label{if $ERRORS[$PRODUCT.id]} class="error"{/if} for="x9200_prod[{$PRODUCT.id}]">Bestellmenge</label>
	{if $ERRORS[$PRODUCT.id]}<div class="erroricon_products"><img src="/images/ch.iframe.snode.microshop/error.png" alt="Fehler" /></div>{/if}
	</div>
</div>
{/foreach}

{literal}
<script type="text/javascript">
<!--
$('.erroricon_products').qtip({
	content: 'In diesem Feld sind nur Zahlen erlaubt',
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