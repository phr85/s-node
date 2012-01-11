{if $CHAPTER.title !=''}<h2>{$CHAPTER.title}<a name="chapter{$CHAPTER.level}">&nbsp;</a></h2>{/if}
{if $CHAPTER.subtitle !=''}<h3>{$CHAPTER.subtitle}</h3>{/if}
	{if $CHAPTER.image_zoom == 1}
			<a href="/download.php?file_id={$CHAPTER.image}&amp;file_version=4&amp;lw=is.jpeg" class="thickbox" rel="rel{$ARTICLE.id}" title="{$CHAPTER.image_description}">
	{else}
			{if $CHAPTER.image_link != ''}<a target="{$CHAPTER.image_link_target}" href="{$CHAPTER.image_link}">{/if}
	{/if}
		{image
		 id=$CHAPTER.image
		 version=$CHAPTER.image_version
		 title=$CHAPTER.image_description
		 alt=$CHAPTER.image_description
		 class="left"}
	{if $CHAPTER.image_zoom == 1 || $CHAPTER.image_link != ''}</a>{/if}
	{$CHAPTER.maintext|bbdecode}
<br clear="all" /><br />