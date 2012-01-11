{if $FIRSTITEM == 1}<h2>{"Buy"|translate}</h2>{/if}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="directbuy{$PRODUCT.id}">
<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
 <tr>
 <td colspan="1" rowspan="2" valign="top" align="left" width="66" style="padding-right:6px;">
{image
   id=$PRODUCT.image_id
   version=0
   title=$PRODUCT.field_text
   alt=$PRODUCT.field_text
   }</td>
  <td colspan="2" rowspan="1" valign="top">
   <b>{$PRODUCT.title}</b>
   {$PRODUCT.lead}
   {if $PRODUCT.field_text != ""}
   <br />
   {$PRODUCT.field_text}
   {/if}
  </td>
 </tr>
 <tr>
  <td valign="bottom"  align="right">{$BASECURRENCY} {$PRODUCT.price|round5}</td>
  <td valign="bottom" width="80" align="right">
  {actionIcon
         action  = "buy"
         icon    = "../default/basket.gif"
         form    = $FORMNAME
         title   = "buy article"
       }
<input type="hidden" name="x{$BASEID}_product_id" value="{$PRODUCT.id}" />
<input type="hidden" name="x{$BASEID}_buy" value="1" />
<input type="hidden" name="x{$BASEID}_price" value="{$PRODUCT.price}" />
<input type="hidden" name="x{$BASEID}_image_id" value="{$PRODUCT.image_id}" />
<input type="hidden" name="x{$BASEID}_image_version" value="0" />
<input type="hidden" name="x{$BASEID}_action" value="" />
  </td>
 </tr>
</table>
</form>