{if "edit"|permcheck}
	{XT_load_js file="tiny_mce/tiny_mce.js"}
	{XT_load_js file="jquery-plugins/jquery.jeditable.js"}
	{XT_load_js file="ch.iframe.snode.liveedit/liveedit.js"}
	{XT_load_css file="ch.iframe.snode.liveedit.css"}
{/if}
{if "edit"|permcheck}
<a class="article_edit" href="javascript:popup('/index.php?TPL=119&amp;x270_id={$ARTICLE.id}&amp;x270_action=editArticle&amp;x270_liveedit=true',800,600,'editarticle')"><img src="/images/icons/edit_small.png" alt="" /></a>
{/if}
{if !$ARTICLE.hide_title}
<h1{if "edit"|permcheck} class="xt_liveedit_articletitle"{/if} id="{$SYSTEM_LANG}_{$ARTICLE.id}_articletitle">{$ARTICLE.title}{if "edit"|permcheck}{/if}</h1>
{/if}
{if $ARTICLE.subtitle !=''}
<h2{if "edit"|permcheck} class="xt_liveedit_articlesubtitle"{/if} id="{$SYSTEM_LANG}_{$ARTICLE.id}_articlesubtitle">{$ARTICLE.subtitle}</h2>
{/if}
{if $ARTICLE.introduction !=''}
<div id="{$SYSTEM_LANG}_{$ARTICLE.id}" class="introduction{if "edit"|permcheck} xt_liveedit_articleintroduction{/if}">
	{$ARTICLE.introduction}
</div>
{/if}
{foreach from=$CHAPTERCONTENT item="CHAPTER" name="C"}
	{$CHAPTER.rendered}
    {if $CHAPTER.layout != "image_float.tpl" && !$smarty.foreach.C.last}
        <br class="clear" />
    {/if}
{/foreach}