{foreach from=$xt5300_list.data item=NEWSLETTER}
{if $NEWSLETTER.status >= 1}
<div class="newslistitem">
  
  <h2 class="newslisttitle"><a href="{$smarty.server.PHP_SELF}?TPL={$xt5300_list.target_tpl}&amp;x{$BASEID}_id={$NEWSLETTER.id}">{$NEWSLETTER.title}</a></h2>
    <h3 class="newslistsubtitle">
    [{foreach from=$NEWSLETTER.categories item=CATEGORY name=C}{$CATEGORY.title}{if !$smarty.foreach.C.last},{/if}{/foreach}] {"sent at"|translate} {$NEWSLETTER.sent_date|date_format:"%d.%m.%Y %H:%I"}
  </h3>
  {if $NEWSLETTER.description != ""}
    <div class="newslist">
              {image
                	id=$NEWSLETTER.image
                	version=2
                	title=$NEWSLETTER.title
                	alt=$NEWSLETTER.title
                	class="newslist"
               }
         {$NEWSLETTER.description}
         <br clear="all" />
    </div>
  {/if}

</div>
  {/if}
{/foreach}