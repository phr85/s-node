<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
{foreach from=$PRODUCTS name=p item=PRODUCT}
{cycle values="prod_even,prod_odd" assign="rowclass"}

{if $smarty.foreach.p.first}
<tr>
<td class="prod_top" width="68">&nbsp;</td>
<td class="prod_top">{"Hersteller"|translate}</td>
<td class="prod_top" width="100">{"Modell"|translate}</td>
<td class="prod_top" width="100">{"Baujahr"|translate}</td>
<td class="prod_top" width="100">{$FIELDS[$PRODUCT.id].23.title}&nbsp;</td>
<td class="prod_top" width="100">{$FIELDS[$PRODUCT.id].24.title}&nbsp;</td>
<td class="prod_top" width="100">{$FIELDS[$PRODUCT.id].21.title}{$FIELDS[$PRODUCT.id].25.title}&nbsp;</td>
</tr>
{/if}

    <tr>
        <td colspan="1" rowspan="2" valign="top" class="{$rowclass}_image">
        <a href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&x{$BASEID}_article_id={$PRODUCT.id}">
        {image id=$PRODUCT.image_id
               version=0
               title=$PRODUCT.field_text
               alt=$PRODUCT.field_text
               class="prodimage"
         }<br /></a></td>
         <td class="{$rowclass}">{$FIELDS[$PRODUCT.id].1.display}</td>
         <td class="{$rowclass}">{$FIELDS[$PRODUCT.id].2.display}</td>
         <td class="{$rowclass}">{$FIELDS[$PRODUCT.id].5.display}</td>
         <td class="{$rowclass}">{$FIELDS[$PRODUCT.id].23.display}</td>
         <td class="{$rowclass}">{$FIELDS[$PRODUCT.id].24.display}</td>
         <td class="{$rowclass}"><span title="{$FIELDS[$PRODUCT.id].21.title}{$FIELDS[$PRODUCT.id].25.title}">{$FIELDS[$PRODUCT.id].25.display}{$FIELDS[$PRODUCT.id].21.display}</span></td>
         </tr>
        <tr>
      <td colspan="6" rowspan="1" align="left" class="{$rowclass}_footer">
      <a href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&x{$BASEID}_article_id={$PRODUCT.id}">
    {$PRODUCT.title}</a>  
        {$PRODUCT.field_text}
    
      </td>

    </tr>
{/foreach}
</table>

<form name="navigator" method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{if $PAGE_START <= $PAGE_END && $PAGE_START >= 0}
  <table cellspacing="0" cellpadding="0" width="100%">
   <tr>
    <td class="subhead_bottom" colspan="{$PAGE_COUNT+1}" style="width: 200px;">{"Showing entries"|translate} <b>{$PAGE_START}</b> {"to"|translate} <b>{$PAGE_END}</b> {"from"|translate} <b>{$TOTAL_COUNT}</b></td>
    {foreach from=$PAGES name=NAVIGATOR item=PAGE}
    <td class="pages{if $ACTIVE_PAGE == $smarty.foreach.NAVIGATOR.iteration}_active{/if}" style="width: 10px;cursor:hand; cursor:pointer;" 
        onclick="document.forms['navigator'].x{$BASEID}_page.value='{$smarty.foreach.NAVIGATOR.iteration}';document.forms['navigator'].submit();">{$smarty.foreach.NAVIGATOR.iteration}
    </td>
    {/foreach}
    <td class="subhead_bottom">&nbsp;</td>
   </tr>
  </table>
  {/if}
 {if !$withouthidden}
 <input type="hidden" name="x{$BASEID}_page" value="{$ACTIVE_PAGE}">
 {/if}
 </form>