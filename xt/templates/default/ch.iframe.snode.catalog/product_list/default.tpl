<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
{if $NODE.subtitle != ''}
<tr>
<td>
<span style="font-size:14px; font-style:italic;"><b>{$NODE.subtitle}</b></span><br /><br />
{$NODE.description|nl2br}
<br />
</td>
</tr>
{/if}
{foreach from=$PRODUCTS name=p item=PRODUCT}
    <tr>
        <td valign="bottom" style="border-bottom: 1px solid #444444; padding:5px;">
        <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&x{$BASEID}_article_id={$PRODUCT.id}">
        {image id=$PRODUCT.image_id
               version=0
               title=$PRODUCT.field_text
               alt=$PRODUCT.field_text
         }</a>
        {$PRODUCT.title}
            <br />
        {$PRODUCT.field_text}
        {$PRODUCT.quantity} {$PRODUCT.unit}<br />{"art_nr"|translate}: {$PRODUCT.art_nr}
         <a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&x{$BASEID}_article_id={$PRODUCT.id}">{"Details"|translate}</a><br />
        {foreach from=$FIELDS[$PRODUCT.id] item=FIELD}
        {if $FIELD.type == 4}
            <b>{$FIELD.title} :</b>
            {if $FIELD.data != ""}
            <ul>
                {foreach from=$FIELD.data item=ITEM}
                <li>{$ITEM.label}></li> 
                {/foreach}
            </ul>
            {/if}
        {else}
            <b>{$FIELD.title} :</b> {$FIELD.display}<br />
        {/if}
        {/foreach}
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