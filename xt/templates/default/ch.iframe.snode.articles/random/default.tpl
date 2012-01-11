{*$xt270_random contains all data*}
{foreach from=$xt270_random item=RANDOM}
<div class="newslistitem">
  {if $LINK2DETAILS == 'yes'}
  <h2 class="newslisttitle"><a href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&amp;x{$BASEID}_id={$RANDOM.id}">{$RANDOM.title}</a></h2>
  {else}
  <h2 class="newslisttitle">{$RANDOM.title}</h2>
  {/if}
    <h3 class="newslistsubtitle">
    {if $RANDOM.subtitle != ""}{$RANDOM.subtitle} -{/if}
    {$RANDOM.creation_date|date_format:"%d.%m.%Y %H:%I"}
  </h3>
  {if $RANDOM.introduction != ""}
    <div class="newslist">
              {image
                	id=$RANDOM.image
                	version=2
                	title=$RANDOM.img_description
                	alt=$RANDOM.img_alt
                	class="newslist"
               }
         {$RANDOM.introduction}
         <br clear="all" />
    </div>
  {/if}

</div>
{/foreach}