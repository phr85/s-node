<form method="POST" name="article" onSubmit="window.document.forms['editArticle'].x{$BASEID}_yoffset.value= window.pageYOffset;">
{include file="includes/lang_selector_simple.tpl" form="article"}
{include file="includes/charfilter.tpl" form="article"}
    <input type="hidden" name="x{$BASEID}_article_id" value="">
    <input type="hidden" name="x{$BASEID}_id" value="">
    <input type="hidden" name="x{$BASEID}_node_id" value="">
    <input type="hidden" name="x{$BASEID}_action" value="">

<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td colspan="3" class="admin_title">{"node_title"|translate}: <b>{$NODE_TITLE} </b></td>
      </tr>
      <tr>
       <td class="table_header" width="80">{"options"|translate}</td>
       <td class="table_header" width="20"><b>ID</b></td>
       <td class="table_header" width="*">{"title"|translate}</td>
      </tr>

      {foreach from=$DATA item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if $ENTRY.article_id == $ENTRY.id}{actionIcon
       action     = "removeArticleFromTree"
       icon       = "check.png"
       perm       = "articleSelector"
       form       = "article"
       title      = "remove article from tree"
       article_id =$ENTRY.id
       node_id    ={$ENTRY.node_id
       yoffset    = "1"
       }{else}{actionIcon
       action     = "addArticleToTree"
       icon       = "folder_add.png"
       perm       = "articleSelector"
       form       = "article"
       title      = "add article to tree"
       id         =$ENTRY.id
       node_id    ={$ENTRY.node_id
       yoffset    = "1"
       }{/if}
       </td>
       <td class="row">
       {$ENTRY.id}
       </td>
       <td class="row">
       {$ENTRY.title|default:"?"}
       </td>
      </tr>
     {/foreach}
    </table>
    <br>
 {include file="includes/navigator.tpl" form="article"}
 {yoffset}
</form>