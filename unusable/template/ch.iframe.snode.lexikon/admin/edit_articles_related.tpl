<br>
{inline_navigator_top anchor ="related_articles"}<br>
{include file="includes/buttons.tpl" data=$RELATED_ARTICLES_BUTTONS withouthidden="1" nobr="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
   <td class="admin_title" colspan="4">{"Related articles"|translate}
   <input type="hidden" name="x{$BASEID}_related_article_id" value="">
   </td>
 </tr>
 <tr>
   <td class="table_header" width="80">{"options"|translate}</td>
   <td class="table_header" width="70">{"image"|translate}</td>
   <td class="table_header" width="60">{"art_nr"|translate}</td>
   <td class="table_header" width="*">{"title"|translate}</td>
  </tr>
  {foreach from=$RELATED_ARTICLES item=ENTRY}
  <tr class="{cycle values="row_a,row_b"}">
   <td class="button">
   {actionIcon
     action  = "removeRelatedArticleFromArticle"
     ask     = "Are you sure to remove this article?"
     icon    = "delete.png"
     form    = "editArticle"
     title   = "remove Article"
     yoffset = "1"
     related_article_id = $ENTRY.article_id
   }
   </td>
   <td class="row">{if $ENTRY.image_id != ''}{image
       id = $ENTRY.image_id
       version = 0
       }{else}&nbsp;{/if}</td>
   <td class="row">
   {$ENTRY.art_nr}
   </td>
   <td class="row">
   <b>{$ENTRY.title|default:"?"}</b><br>
   {$ENTRY.lead|default:"?"}
   </td>
  </tr>
 {/foreach}
</table>
