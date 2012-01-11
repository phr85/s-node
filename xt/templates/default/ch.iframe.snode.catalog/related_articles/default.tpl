{if sizeof($RELATIONS) > 0}
<div class="variantentitle">
Weiter Objekte</div>
<div class="dllistimages">
{foreach from=$RELATIONS item=ARTICLE}
 <div style="float:left; width:120px;margin:2px;">
 <a href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_article_id={$ARTICLE.0.id}&amp;x{$BASEID}_node={$ARTICLE.0.node}">   
 {image id=$ARTICLE.0.image_id version=2}<br />
    {$ARTICLE.0.title}
    </a>
        </div>

{/foreach}
{/if}