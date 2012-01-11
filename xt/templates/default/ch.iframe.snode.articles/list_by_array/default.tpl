{foreach from=$DATA item=NEWS}
<div class="newslistitem">
  {if $LINK2DETAILS == 'yes'}
  <h2 class="newslisttitle"><a href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&amp;x{$BASEID}_id={$NEWS.id}">{$NEWS.title}</a></h2>
  {else}
  <h2 class="newslisttitle">{$NEWS.title}</h2>
  {/if}
  <h3 class="newslistsubtitle">
    {if $NEWS.subtitle != ""}{$NEWS.subtitle} -{/if}
    {$NEWS.creation_date|date_format:"%d.%m.%Y %H:%I"}
  </h3>
  {if $NEWS.introduction != ""}
    <div class="newslist">
              {image
                	id=$NEWS.image
                	version=2
                	title=$NEWS.img_description
                	alt=$NEWS.img_alt
                	class="newslist"
               }
         {$NEWS.introduction}
         <br clear="all" />
    </div>
  {/if}
</div>
{/foreach}