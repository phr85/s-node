{* Set the siize of the content. If this size is reached it will be wrapped*}
{assign var="maxwidth" value="2000"}
{* Set the temporary width to zero *}
{if $tmpwidth == ""}{assign var="tmpwidth" value="0"}{/if}
{* Add the new image width to the  temporary width*}
{math equation="x + y" x=$tmpwidth y="`$CHAPTER.image`,`$CHAPTER.image_version`"|xt_imagewidth assign="tmpwidth"}
{* Wrap the content if the maxwidth is reached*}
{if $tmpwidth > $maxwidth}{assign var="tmpwidth" value="`$CHAPTER.image`,`$CHAPTER.image_version`"|xt_imagewidth}<br style="clear: both;">{/if}
<div class="art_float" style="width: {"`$CHAPTER.image`,`$CHAPTER.image_version`"|xt_imagewidth}px;">
{if $CHAPTER.title !=''}<h2>{$CHAPTER.title}<a name="chapter{$CHAPTER.level}">&nbsp;</a></h2>{/if}
{if $CHAPTER.subtitle !=''}<h3>{$CHAPTER.subtitle}</h3>{/if}
	{if $CHAPTER.image_zoom == 1}
			<a href="/download.php?file_id={$CHAPTER.image}&amp;file_version=5&amp;lw=is.jpeg" class="thickbox" rel="rel{$ARTICLE.id}" title="{$CHAPTER.image_description}">
	{else}
			{if $CHAPTER.image_link != ''}<a target="{$CHAPTER.image_link_target}" href="{$CHAPTER.image_link}">{/if}
	{/if}
	{if $CHAPTER.image_type == 2}
		<div class="left">
			<object type="application/x-shockwave-flash" data="{$XT_WEB_ROOT}download.php?file_id={$CHAPTER.image}">
				<param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$CHAPTER.image}" />
			</object>
		</div>
	{else}
		{image
		 id=$CHAPTER.image
		 version=$CHAPTER.image_version
		 title=$CHAPTER.image_description
		 alt=$CHAPTER.image_description
		 class="left"}
	{/if}
	{if $CHAPTER.image_zoom == 1 || $CHAPTER.image_link != ''}</a>{/if}
	{$CHAPTER.maintext}
</div>