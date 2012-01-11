{if count($IMAGES) > 0}
<div class="rviewr_imagebox">
{foreach from=$IMAGES item=IMAGE}
<div class="rimages">
<a href="/download.php?file_id={$IMAGE.id}&amp;file_version=4&amp;lw=is.jpg" class="thickbox"  rel="lightbox-art{$DATA.recipe.id}" title="{$IMAGE.description}">
{image
      id=$IMAGE.id
      version=$VERSION
      title=$IMAGE.description
      alt=$IMAGE.description
      }
</a>
</div>
{/foreach}
</div>
{/if}