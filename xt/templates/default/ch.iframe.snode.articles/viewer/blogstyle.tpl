{if !$ARTICLE.hide_title}<h1>{$ARTICLE.title} {if "edit"|permcheck}<a href="javascript:popup('/index.php?TPL=119&amp;x270_id={$ARTICLE.id}&amp;x270_action=editArticle&amp;x270_liveedit=true',800,600,'editarticle')"><img src="/images/icons/edit_small.png" alt="" /></a> {/if}</h1>{else}{if "edit"|permcheck}<a href="javascript:popup('/index.php?TPL=119&amp;x270_id={$ARTICLE.id}&amp;x270_action=editArticle&amp;x270_liveedit=true',800,600,'editor')"><img src="/images/icons/edit_small.png" alt="" /></a> {/if}{/if}
    {if $ARTICLE.subtitle !=''}<h2>{$ARTICLE.subtitle}</h2>{/if}
    {if $ARTICLE.introduction !=''}<div class="introduction">{$ARTICLE.introduction}</div>{/if}
    {foreach from=$CHAPTERCONTENT item="CHAPTER"}
        {$CHAPTER.rendered}
    {/foreach}
    {if $DISPLAY.trackback == true}
    <a href="trackback.php?ctype=270&amp;cid={$ARTICLE.id}"><img src="images/icons/trackback.png" alt="{"Trackback URI"|translate}" title="{"Trackback URI"|translate}" /></a>
    <br clear="all" />
    {subplugin package="ch.iframe.snode.blog" module="trackback_viewer" content_type="270" content_id=$ARTICLE.id}
    {/if}
<br clear="all" />