{if $CHAPTER.title !=''}<h2>{$CHAPTER.title}<a name="chapter{$CHAPTER.level}">&nbsp;</a></h2>{/if}
{if $CHAPTER.subtitle !=''}<h3>{$CHAPTER.subtitle}</h3>{/if}
	{if $CHAPTER.image_zoom == 1}
			<a href="/download.php?file_id={$CHAPTER.image}&amp;file_version=5&amp;lw=is.jpeg" class="thickbox" rel="rel{$ARTICLE.id}" title="{$CHAPTER.image_description}">
	{else}
			{if $CHAPTER.image_link != ''}<a target="{$CHAPTER.image_link_target}" href="{$CHAPTER.image_link}">{/if}
	{/if}
	{if $CHAPTER.image_type == 2}
		<div class="right">
			<object type="application/x-shockwave-flash" width="200" height="{math equation=200/floor((width/height)) width=$CHAPTER.width height=$CHAPTER.height}" data="{$XT_WEB_ROOT}download.php?file_id={$CHAPTER.image}">
				<param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$CHAPTER.image}" />
			</object>
		</div>
	{else}
		{image
		 id=$CHAPTER.image
		 version=$CHAPTER.image_version
		 title=$CHAPTER.image_description
		 alt=$CHAPTER.image_description
		 class="right"}
	{/if}
	{if $CHAPTER.image_zoom == 1 || $CHAPTER.image_link != ''}</a>{/if}
	{$CHAPTER.maintext}
<br clear="all" />