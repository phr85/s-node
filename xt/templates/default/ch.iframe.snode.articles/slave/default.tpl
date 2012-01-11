{if !$xt270_slave.hide_title}<h1>{$xt270_slave.title} {if "edit"|permcheck}<a href="javascript:popup('/index.php?TPL=119&amp;x270_id={$xt270_slave.id}&amp;x270_action=editArticle&amp;x270_liveedit=true',800,600,'editarticle')"><img src="/images/icons/edit_small.png" alt="" /></a> {/if}</h1>{else}{if "edit"|permcheck}<a href="javascript:popup('/index.php?TPL=119&amp;x270_id={$xt270_slave.id}&amp;x270_action=editArticle&amp;x270_liveedit=true',800,600,'editor')"><img src="/images/icons/edit_small.png" alt="" /></a> {/if}{/if}
    {if $xt270_slave.subtitle !=''}<h2>{$xt270_slave.subtitle}</h2>{/if}
    {if $xt270_slave.introduction !=''}<div class="introduction">{$xt270_slave.introduction}</div>{/if}
    {foreach from=$xt270_slave.CHAPTERCONTENT item="CHAPTER"}
       {print_data array=$CHAPTER}
    {/foreach}
<br clear="all" />