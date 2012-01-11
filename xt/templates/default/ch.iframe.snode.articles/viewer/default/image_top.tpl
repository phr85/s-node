{if $CHAPTER.title !=''}
<h2{if "edit"|permcheck} class="xt_liveedit_chaptertitle" id="{$SYSTEM_LANG}_{$ARTICLE.id}_{$CHAPTER.level}_chaptertitle"{/if}>{$CHAPTER.title}</h2>
{/if}
{if $CHAPTER.subtitle !=''}
<h3{if "edit"|permcheck} class="xt_liveedit_chaptersubtitle" id="{$SYSTEM_LANG}_{$ARTICLE.id}_{$CHAPTER.level}_chaptersubtitle"{/if}>{$CHAPTER.subtitle}</h3>
{/if}
{if $CHAPTER.image_zoom == 1}
<a href="/download.php?file_id={$CHAPTER.image}&amp;file_version=5&amp;lw=is.jpeg" class="thickbox" rel="rel{$ARTICLE.id}" title="{$CHAPTER.image_description}">
{elseif $CHAPTER.image_link != ''}
<a target="{$CHAPTER.image_link_target}" href="{$CHAPTER.image_link}">
{/if}
{if $CHAPTER.image_type == 2}
<div class="top">
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
		class="top"
	}
{/if}
{if $CHAPTER.image_zoom == 1 || $CHAPTER.image_link != ''}</a>{/if}
{if $CHAPTER.maintext != ""}
<div id="{$SYSTEM_LANG}_{$ARTICLE.id}_{$CHAPTER.level}_chaptermaintext" class="paragraph{if "edit"|permcheck} xt_liveedit_chaptermaintext{/if}">
	{$CHAPTER.maintext}
</div>
{/if}