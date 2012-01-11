<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
  

{if $NODE.use_description == true}
<tr>
<td colspan="1" rowspan="2" valign="middle" align="center" style="border-bottom: 1px solid #B8CFE8; padding:5px; border-right: 1px solid #D6E8F7;">
<b>{$NODE.subtitle}</b><br /><br />
{$NODE.description|nl2br}
<br />
</td>
{/if}

{foreach from=$PRODUCTS name=p item=PRODUCT}
{if $smarty.foreach.p.iteration == 1 && $NODE.use_description == true}
<td valign="bottom" style="border-bottom: 1px solid #B8CFE8; padding:5px; border-left: 1px solid #D6E8F7;">
            <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0"><tr>
            <td colspan="1" rowspan="2" style="padding-right: 6px;" align="left" valign="bottom" width="66">
            <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&amp;x{$BASEID}_article_id={$PRODUCT.id}">{image
                           id=$PRODUCT.image_id
                           version=0
                           title=$PRODUCT.field_text
                           alt=$PRODUCT.field_text }</a></td>
             <td colspan="1" rowspan="1" class="overviewbox" width="*">{$PRODUCT.title}</td>
            </tr><tr>
             <td style="height:40px;" align="left" valign="bottom">
             <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="products_tpl"}&amp;x{get_param param="products_baseid"}_lexikon_id={$PRODUCT.id}">Produkte mit {$PRODUCT.title}</a>
             <br />
              <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&amp;x{$BASEID}_article_id={$PRODUCT.id}">{"Details"|translate}</a><br />
             </td>
            </tr>
            </table>
        </td>
{elseif $smarty.foreach.p.iteration == 2 && $NODE.use_description == true}
    <tr>
        <td valign="bottom" style="border-bottom: 1px solid #B8CFE8; padding:5px; border-left: 1px solid #D6E8F7;">
            <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0"><tr>
            <td colspan="1" rowspan="2" style="padding-right: 6px;" align="left" valign="bottom" width="66">
            <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&amp;x{$BASEID}_article_id={$PRODUCT.id}">{image
                           id=$PRODUCT.image_id
                           version=0
                           title=$PRODUCT.field_text
                           alt=$PRODUCT.field_text }</a></td>
             <td colspan="1" rowspan="1" class="overviewbox" width="*">{$PRODUCT.title}</td>
            </tr><tr>
             <td style="height:40px;" align="left" valign="bottom">
             <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="products_tpl"}&amp;x{get_param param="products_baseid"}_lexikon_id={$PRODUCT.id}">Produkte mit {$PRODUCT.title}</a>
             <br />
              <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&amp;x{$BASEID}_article_id={$PRODUCT.id}">{"Details"|translate}</a><br />
             </td>
            </tr>
            </table>
        </td>
    </tr>
{else}
    {if $smarty.foreach.p.iteration is odd}
      <tr>
        <td valign="bottom" style="border-bottom: 1px solid #B8CFE8;border-right: 1px solid #D6E8F7; padding:5px;">
            <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0"><tr>
            <td colspan="1" rowspan="2" style="padding-right: 6px;" align="left" valign="bottom" width="66">
            <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&amp;x{$BASEID}_article_id={$PRODUCT.id}">{image
                           id=$PRODUCT.image_id
                           version=0
                           title=$PRODUCT.field_text
                           alt=$PRODUCT.field_text }</a></td>
             <td colspan="1" rowspan="1" class="overviewbox" width="*">{$PRODUCT.title}</td>
            </tr><tr>
             <td style="height:40px;" align="left" valign="bottom">
             <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="products_tpl"}&amp;x{get_param param="products_baseid"}_lexikon_id={$PRODUCT.id}">Produkte mit {$PRODUCT.title}</a>
             <br />
              <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&amp;x{$BASEID}_article_id={$PRODUCT.id}">{"Details"|translate}</a><br />
             </td>
            </tr>
            </table>
        </td>
    {else}
        <td valign="bottom" style="border-bottom: 1px solid #B8CFE8;border-left: 1px solid #D6E8F7; padding:5px;">
            <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0"><tr>
            <td colspan="1" rowspan="2" style="padding-right: 6px;" align="left" valign="bottom" width="66">
            <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&amp;x{$BASEID}_article_id={$PRODUCT.id}">{image
                           id=$PRODUCT.image_id
                           version=0
                           title=$PRODUCT.field_text
                           alt=$PRODUCT.field_text }</a></td>
             <td colspan="1" rowspan="1" class="overviewbox" width="*">{$PRODUCT.title}</td>
            </tr><tr>
             <td style="height:40px;" align="left" valign="bottom">
             <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="products_tpl"}&amp;x{get_param param="products_baseid"}_lexikon_id={$PRODUCT.id}">Produkte mit {$PRODUCT.title}</a>
             <br />
              <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&amp;x{$BASEID}_article_id={$PRODUCT.id}">{"Details"|translate}</a><br />
             </td>
            </tr>
            </table>
</td>
    </tr>
    {/if}
{/if}
{/foreach}

{if $smarty.foreach.p.iteration is odd}
<td valign="bottom" style="border-bottom: 1px solid #B8CFE8; padding:5px; border-left: 1px solid #D6E8F7;"><br /></td></tr>
{/if}


</table>

