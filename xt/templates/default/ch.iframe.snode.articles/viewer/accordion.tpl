{XT_load_js file="jquery-ui/ui.accordion.js"}
{literal}
  <script>
  $(document).ready(function(){
    $("#accordion{/literal}{$ARTICLE.id}{literal}").accordion({
   alwaysOpen: false,
   active: true,
   header: ".ui-accordion-header",
						clearStyle: true

});
  });
</script>
{/literal}


<div class="articlewrapper">
	<div class="article">
		{if !$ARTICLE.hide_title}<h1 class="title">{$ARTICLE.title} {if "edit"|permcheck}<a href="javascript:popup('/index.php?TPL=119&amp;x270_id={$ARTICLE.id}&amp;x270_action=editArticle&amp;x270_liveedit=true',800,600,'editarticle')"><img src="/images/icons/edit_small.png" alt="" /></a> {/if}</h1>{else}{if "edit"|permcheck}<a href="javascript:popup('/index.php?TPL=119&amp;x270_id={$ARTICLE.id}&amp;x270_action=editArticle&amp;x270_liveedit=true',800,600,'editor')"><img src="/images/icons/edit_small.png" alt="" /></a> {/if}{/if}
	    {if $ARTICLE.subtitle !=''}<h2 class="subtitle">{$ARTICLE.subtitle}</h2>{/if}
	    {if $ARTICLE.introduction !=''}<div class="introduction">{$ARTICLE.introduction}</div>{/if}


<div id="accordion{$ARTICLE.id}" >
    {foreach from=$CHAPTERCONTENT item="CHAPTER"}
        <div class="ui-accordion-group">
            <h3 class="ui-accordion-header"><a href='#'>{$CHAPTER.title}</a></h3>
            <div class="ui-accordion-content">
                {$CHAPTER.rendered}
            </div>
        </div>
    {/foreach}
</div>


	</div>
</div>