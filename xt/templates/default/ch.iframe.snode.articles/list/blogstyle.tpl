{xt_count_comments assign="COMMENTS_COUNT" content_type="270"}
{if $AUTH == 1}{if "blog"|permcheck}
<a href="#" onclick="window.open('/index.php?TPL=237&amp;x{$BASEID}_category={$CATEGORY}','','scrollbars=1,width=900,height=600,top=200,left=200');"><img src="{$XT_IMAGES}/icons/plus.gif" alt="{"new article"|translate}" /></a>
{/if}{/if}

{foreach from=$DATA item=NEWS}
<div class="newslistitem">
  {if $LINK2DETAILS == 'yes'}
  <h2 class="newslisttitle"><a href="{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&amp;x{$BASEID}_id={$NEWS.id}">{$NEWS.title}</a></h2>
  {else}
  <h2 class="newslisttitle">{$NEWS.title}</h2>
  {/if}
  {if "blog"|permcheck}<a href="javascript:popup('/index.php?TPL=119&amp;x270_id={$NEWS.id}&amp;x270_action=editArticle&amp;x270_liveedit=true',800,600,'editarticle')"><img src="/images/icons/edit_small.png" alt="" /></a> {/if}
  <h3 class="newslistsubtitle">
    {if $NEWS.subtitle != ""}{$NEWS.subtitle} -{/if}
    {$NEWS.creation_date|date_format:"%d.%m.%Y %H:%I"}
  </h3>
  {if $NEWS.introduction != ""}
    <div class="newslist">
              {image
                	id=$NEWS.image
                	version=2
                	title=$NEWS.img_description
                	alt=$NEWS.img_alt
                	class="newslist"
               }
         {$NEWS.introduction}
       </div>
       <br clear="all" />
       Anzahl Kommentare: {assign var='LOOP_COUNT' value='0'}{foreach from=$COMMENTS_COUNT item=COUNT key=CONTENT_ID}{if $CONTENT_ID == $NEWS.id}{assign var='LOOP_COUNT' value=$COUNT}{/if}{/foreach}{$LOOP_COUNT}

  {/if}

</div>
{/foreach}