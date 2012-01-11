<h1>{$xt5300_viewer.title}</h1>
{if $xt5300_viewer.image > 0}
		<a href="/download.php?file_id={$xt5300_viewer.image}&amp;file_version=5&amp;lw=is.jpg" class="thickbox" rel="lightbox[art{$ARTICLE.id}]" title="{$CHAPTER.image_description}">
		{image
		 id=$xt5300_viewer.image
		 version=$xt5300.image_version
		 title=$xt5300.image_description
		 alt=$xt5300.image_description
		 class="left"}
		 </a>
	{/if}
{$xt5300_viewer.content_html}
<br clear="all" />
{foreach from=$xt5300_viewer.chapters item=CHAPTER}
	<h2>{$CHAPTER.title}</h2><br />
	{if $CHAPTER.image > 0}
		<a href="/download.php?file_id={$CHAPTER.image}&amp;file_version=5&amp;lw=is.jpg" class="thickbox" rel="lightbox[art{$ARTICLE.id}]" title="{$CHAPTER.image_description}">
		{image
		 id=$CHAPTER.image
		 version=$CHAPTER.image_version
		 title=$CHAPTER.image_description
		 alt=$CHAPTER.image_description
		 class="right"}
		 </a>
	{/if}
	{$CHAPTER.maintext}
	<a href="{$CHAPTER.link}" target="_blank">{$CHAPTER.link}</a>
	<br clear="all" />
{/foreach}
<br clear="all" />ss