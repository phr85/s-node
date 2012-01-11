{if $NODE.subtitle != ''}
<div class="rlist_nodesubtitle"><b>{$NODE.subtitle}</b></div>
<div class="rlist_nodedescription">{$NODE.description|nl2br}</div>
<br />
{/if}

{foreach from=$PRODUCTS name=p item=PRODUCT}
 <div class="rlist">
  {if $PRODUCT.image_id > 0}
   <div class="rlist_image">
      <a href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_recipe_id={$PRODUCT.id}">
        {image id=$PRODUCT.image_id
               version=0
               title=$PRODUCT.field_text
               alt=$PRODUCT.field_text
         }</a>
   </div>
  {/if}
  <div class="rlist_rtitle"> <a href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_recipe_id={$PRODUCT.id}">{$PRODUCT.title}</a></div>
  <div class="rlist_rsubtitle">{$PRODUCT.subtitle}</div>
  {$PRODUCT.description}<br clear="all" />
        

 </div>
{/foreach}


<form name="navigator" method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
 {if $PAGE_START <= $PAGE_END && $PAGE_START >= 0}
  <div>{"Showing entries"|translate} <b>{$PAGE_START}</b> {"to"|translate} <b>{$PAGE_END}</b> {"from"|translate} <b>{$TOTAL_COUNT}</b></div>
  {foreach from=$PAGES name=NAVIGATOR item=PAGE}
    <a class="rlist_pages{if $ACTIVE_PAGE == $smarty.foreach.NAVIGATOR.iteration}_active{/if}" href="javascript:document.forms['navigator'].x{$BASEID}_page.value='{$smarty.foreach.NAVIGATOR.iteration}';document.forms['navigator'].submit();">{$smarty.foreach.NAVIGATOR.iteration}</a>
  {/foreach}
 {/if}
 <input type="hidden" name="x{$BASEID}_page" value="{$ACTIVE_PAGE}" />
 <br clear="all" />
</form>