{if !$ARTICLE.hide_title}<h1>{$ARTICLE.title} {if "edit"|permcheck}<a href="javascript:popup('/index.php?TPL=119&amp;x270_id={$ARTICLE.id}&amp;x270_action=editArticle&amp;x270_liveedit=true',800,600,'editarticle')"><img src="/images/icons/edit_small.png" alt="" /></a> {/if}</h1>{else}{if "edit"|permcheck}<a href="javascript:popup('/index.php?TPL=119&amp;x270_id={$ARTICLE.id}&amp;x270_action=editArticle&amp;x270_liveedit=true',800,600,'editor')" /><img src="/images/icons/edit_small.png" alt="" /></a> {/if}{/if}
{if $ARTICLE.subtitle !=''}<h2>{$ARTICLE.subtitle}</h2>{/if}
{if $ARTICLE.introduction !=''}<div class="introduction">{$ARTICLE.introduction}</div>{/if}

<div class="tabs">
	<ul class="tabs" id="tab_group_{$ARTICLE.id}">
		{foreach from=$CHAPTERCONTENT item="CHAPTER" name="C"}
			<li><a href="#tab_{$ARTICLE.id}_{$smarty.foreach.C.iteration}">{$CHAPTER.title}</a></li>
		{/foreach}
	</ul>
	{foreach from=$CHAPTERCONTENT item="CHAPTER" name="C"}
		<div style="display:none;" id="tab_{$ARTICLE.id}_{$smarty.foreach.C.iteration}">
		  <div class="tabchapter">
			{if $CHAPTER.layout == "image_left.tpl"}{image id=$CHAPTER.image version=$CHAPTER.image_version title=$CHAPTER.image_description alt=$CHAPTER.image_description class="left"}{/if}
			{if $CHAPTER.layout == "image_right.tpl"}{image id=$CHAPTER.image version=$CHAPTER.image_version title=$CHAPTER.image_description alt=$CHAPTER.image_description class="right"}{/if}
			{if $CHAPTER.layout == "image_top.tpl"}{image id=$CHAPTER.image version=$CHAPTER.image_version title=$CHAPTER.image_description alt=$CHAPTER.image_description}<br />{/if}
            {$CHAPTER.maintext}
          </div>
		</div>
	{/foreach}
</div>

<script type="text/javascript">
    new Control.Tabs('tab_group_{$ARTICLE.id}');
</script>