<h1>{$TPL_REAL_TITLE}</h1>
<p>{$TPL_DESC}</p>
{foreach from=$CATEGORIES item=CATEGORY name=C}
<h2>{$smarty.foreach.C.iteration} {$CATEGORY.title}</h2>
<ul class="article_list">
{foreach from=$ARTICLES[$CATEGORY.id] item=ARTICLE name=A}
<li><a href="#">{$smarty.foreach.C.iteration}.{$smarty.foreach.A.iteration} {$ARTICLE.title}</a></li>
{/foreach}
</ul>
{/foreach}