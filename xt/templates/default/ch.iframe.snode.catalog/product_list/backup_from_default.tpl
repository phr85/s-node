<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="49%" ><div class="titlebar">Produkte</div></td>
    <td width="6">&nbsp;</td><td width="6">&nbsp;</td>
    <td style="font-size:16px;" align="center"><img src="{$XT_IMAGES}default/products.gif" alt="" /></td>
  </tr>

{if $NODE.use_description == true}
<tr>
<td colspan="1" rowspan="2" valign="middle" align="center" style="border-bottom: 1px solid #3AA9C4;">
<b>{$NODE.subtitle}</b><br /><br />
{$NODE.description|nl2br}
<br />
</td>
{/if}

{foreach from=$PRODUCTS name=p item=PRODUCT}
{if $smarty.foreach.p.iteration == 1 && $NODE.use_description == true}
<td style="border-right: 1px solid #3AA9C4;">&nbsp;</td><td>&nbsp;</td>
<td valign="bottom" style="border-bottom: 1px solid #3AA9C4;">
            <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
             <tr>
             <td colspan="1" rowspan="2" valign="bottom" align="left" width="66" style="padding-bottom:4px;"><a
             href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&x{$BASEID}_article_id={$PRODUCT.id}">{image
               id=$PRODUCT.image_id
               version=0
               title=$PRODUCT.field_text
               alt=$PRODUCT.field_text }</a></td>
              <td colspan="2" rowspan="1" valign="bottom" style="padding-top:10px;">
               <span style="font-style: italic; font-size: 12px; font-weight: bold;">{$PRODUCT.title}</span>
               <br />
               {$PRODUCT.field_text|nl2br} <br />
               {$PRODUCT.quantity} {$PRODUCT.unit}
              </td>
             </tr>
             <tr>
              <td valign="bottom" style="padding-bottom:4px;">{"art_nr"|translate}:{$PRODUCT.art_nr}</td>
              <td valign="bottom" width="80" style="padding-bottom:4px;">
              <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&x{$BASEID}_article_id={$PRODUCT.id}">{"Details"|translate}</a><br />
              </td>
             </tr>
            </table>
        </td>
{elseif $smarty.foreach.p.iteration == 2 && $NODE.use_description == true}
    <tr>
    <td style="border-right: 1px solid #3AA9C4;">&nbsp;</td><td>&nbsp;</td>
        <td valign="bottom" style="border-bottom: 1px solid #3AA9C4;">
            <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
             <tr>
              <td colspan="1" rowspan="2" valign="bottom" align="left" width="66" style="padding-bottom:4px;"><a
              href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&x{$BASEID}_article_id={$PRODUCT.id}">{image
               id=$PRODUCT.image_id
               version=0
               title=$PRODUCT.field_text
               alt=$PRODUCT.field_text }</a></td>
              <td colspan="2" rowspan="1" valign="bottom" style="padding-top:10px;">
               <span style="font-style: italic; font-size: 12px; font-weight: bold;">{$PRODUCT.title}</span>
               <br />
               {$PRODUCT.field_text|nl2br} <br />
               {$PRODUCT.quantity} {$PRODUCT.unit}
              </td>
             </tr>
             <tr>
              <td valign="bottom" style="padding-bottom:4px;">{"art_nr"|translate}:{$PRODUCT.art_nr}</td>
              <td valign="bottom" width="80" style="padding-bottom:4px;">
              <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&x{$BASEID}_article_id={$PRODUCT.id}">{"Details"|translate}</a><br />
              </td>
             </tr>
            </table>
        </td>
    </tr>
{else}
    {if $smarty.foreach.p.iteration is odd}
      <tr>
        <td valign="bottom" style="border-bottom: 1px solid #3AA9C4;">
            <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
             <tr>
              <td colspan="1" rowspan="2" valign="bottom" align="left" width="66" style="padding-bottom:4px;"><a
              href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&x{$BASEID}_article_id={$PRODUCT.id}">{image
               id=$PRODUCT.image_id
               version=0
               title=$PRODUCT.field_text
               alt=$PRODUCT.field_text }</a></td>
              <td colspan="2" rowspan="1" valign="bottom" style="padding-top:10px;">
               <span style="font-style: italic; font-size: 12px; font-weight: bold;">{$PRODUCT.title}</span>
               <br />
               {$PRODUCT.field_text|nl2br} <br />
               {$PRODUCT.quantity} {$PRODUCT.unit}
              </td>
             </tr>
             <tr>
              <td valign="bottom" style="padding-bottom:4px;">{"art_nr"|translate}:{$PRODUCT.art_nr}</td>
              <td valign="bottom" width="80" style="padding-bottom:4px;">
              <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&x{$BASEID}_article_id={$PRODUCT.id}">{"Details"|translate}</a><br />
              </td>
             </tr>
            </table>
        </td>
        <td style="border-right: 1px solid #3AA9C4;">&nbsp;</td><td>&nbsp;</td>
    {else}
        <td valign="bottom" style="border-bottom: 1px solid #3AA9C4;">
            <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
             <tr>
             <td colspan="1" rowspan="2" valign="bottom" align="left" width="66" style="padding-bottom:4px;"><a
             href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&x{$BASEID}_article_id={$PRODUCT.id}">{image
               id=$PRODUCT.image_id
               version=0
               title=$PRODUCT.field_text
               alt=$PRODUCT.field_text
               }</a></td>
              <td colspan="2" rowspan="1" valign="bottom" style="padding-top:10px;">
               <span style="font-style: italic; font-size: 12px; font-weight: bold;">{$PRODUCT.title}</span>
               <br />
               {$PRODUCT.field_text|nl2br} <br />
               {$PRODUCT.quantity} {$PRODUCT.unit}
              </td>
             </tr>
             <tr>
              <td valign="bottom" style="padding-bottom:4px;">{"art_nr"|translate}:{$PRODUCT.art_nr}</td>
              <td valign="bottom" width="80" style="padding-bottom:4px;">
              <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&x{$BASEID}_article_id={$PRODUCT.id}">{"Details"|translate}</a><br />
              </td>
             </tr>
            </table>
        </td>
    </tr>
    {/if}
{/if}
{/foreach}

{if $smarty.foreach.p.iteration is odd}
<td valign="bottom" style="border-bottom: 1px solid #3AA9C4;"><br /></td></tr>
{/if}

  <tr>
    <td>&nbsp;</td>
    <td style="border-right: 1px solid #3AA9C4;">&nbsp;</td><td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

</table>

