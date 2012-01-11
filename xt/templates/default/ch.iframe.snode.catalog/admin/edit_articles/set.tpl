<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="3">
   <span class="title"> {"Sets"|translate}</span>{inline_navigator_top anchor ="set_articles"}
   <input type="hidden" name="x{$BASEID}_set_article_id" value="">
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="3"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$SET_ARTICLES_BUTTONS withouthidden="1" nobr="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
   <td class="table_header" width="80">{"options"|translate}</td>
   <td class="table_header" width="70">{"image"|translate}</td>
   <td class="table_header" width="60">{"art_nr"|translate}</td>
   <td class="table_header">{"title"|translate}</td>
  </tr>
  {foreach from=$SET_ARTICLES item=ENTRY}
  <tr class="{cycle values="row_a,row_b"}">
   <td class="button">
   {actionIcon
     action  = "removeSetArticleFromArticle"
     ask     = "Are you sure to remove this article?"
     icon    = "delete.png"
     form    = "editArticle"
     title   = "remove Article"
     yoffset     = "1"
     set_article_id = $ENTRY.article_id
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
   <b>{$ENTRY.title|default:"?"}</b><br />
   {$ENTRY.lead|default:"?"}
   </td>
  </tr>
 {/foreach}
</table>
