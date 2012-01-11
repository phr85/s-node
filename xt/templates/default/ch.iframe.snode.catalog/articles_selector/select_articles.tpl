<form method="POST" name="article" onSubmit="window.document.forms['editArticle'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td colspan="4"><h2>{"Last 5 Entries"|translate}:</h2></td>
      </tr>
       <tr>
        <td colspan="4">{include file="includes/lang_selector_simple.tpl" form="article"}</td>
      </tr>
      <tr>
       <td class="table_header" width="30">&nbsp;</td>
       <td class="table_header" width="40">ID</td>
       <td class="table_header" width="80">{"art_nr"|translate}</td>
       <td class="table_header">{"title"|translate}</td>
      </tr>
      {foreach from=$DATA_LAST item=LASTENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if $LASTENTRY.article_id == $LASTENTRY.id}{actionIcon
       action     = "removeArticleFromTree"
       icon       = "check.png"
       perm       = "articleSelector"
       form       = "article"
       title      = "remove article from tree"
       article_id =$LASTENTRY.id
       node_id    =$LASTENTRY.node_id
       yoffset    = "1"
       }{else}{actionIcon
       action     = "addArticleToTree"
       icon       = "folder_add.png"
       perm       = "articleSelector"
       form       = "article"
       title      = "add article to tree"
       id         =$LASTENTRY.id
       node_id    =$LASTENTRY.node_id
       yoffset    = "1"
       }{/if}
       </td>
       <td class="row">
       {$LASTENTRY.id}
       </td>
       <td class="row">
       {$LASTENTRY.art_nr|default:"&nbsp;"}
       </td>
       <td class="row">
       {$LASTENTRY.title|default:"?"}
       </td>
      </tr>
     {/foreach}
</table>
<h2>{"Search"|translate}</h2>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="search_box">
   {"Search for"|translate}&nbsp;
   <input type="text" id="x{$BASEID}_search" name="x{$BASEID}_search" value="{$SEARCH_TERM}" />&nbsp;
   {"in"|translate}&nbsp;
   <select name="x{$BASEID}_search_field">
    <option value="d.title" {if $SEARCH_BY == "d.title"}selected{/if}>{"Title"|translate}</option>
    <option value="d.lead" {if $SEARCH_BY == "d.lead"}selected{/if}>{"lead"|translate}</option>
    <option value="d.description" {if $SEARCH_BY == "d.description"}selected{/if}>{"Description"|translate}</option>
    <option value="a.id" {if $SEARCH_BY == "a.id"}selected{/if}>{"ID"|translate}</option>
    <option value="a.art_nr" {if $SEARCH_BY == "a.art_nr"}selected{/if}>{"Article nr."|translate}</option>
   </select>
   <input type="submit" value="{'Search'|translate}" />
   <img src="{$XT_IMAGES}spacer.gif" onload="document.getElementById('x{$BASEID}_search').focus();" />
  </td>
 </tr>
</table>
    <input type="hidden" name="x{$BASEID}_article_id" value="">
    <input type="hidden" name="x{$BASEID}_id" value="">
    <input type="hidden" name="x{$BASEID}_node_id" value="">
    <input type="hidden" name="x{$BASEID}_action" value="">
    <input type="hidden" name="x{$BASEID}_order_by" value="">
    <input type="hidden" name="x{$BASEID}_order_by_dir" value="">
<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td colspan="4"><h2>{"List"|translate}</h2></td>
      </tr>
      <tr>
        <td colspan="4">{include file="includes/charfilter.tpl" form="article"}</td>
      </tr>
      <tr>
       <td class="table_header" width="30">&nbsp;</td>
       <td class="table_header" width="40" onclick="document.forms['article'].x{$BASEID}_order_by.value='a.id';document.forms['article'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.id'}DESC{else}ASC{/if}';document.forms['article'].submit();">ID {if $ORDER_BY == 'a.id'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
       <td class="table_header" width="80" onclick="document.forms['article'].x{$BASEID}_order_by.value='a.art_nr';document.forms['article'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'a.art_nr'}DESC{else}ASC{/if}';document.forms['article'].submit();">{"art_nr"|translate} {if $ORDER_BY == 'a.art_nr'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
       <td class="table_header" onclick="document.forms['article'].x{$BASEID}_order_by.value='d.title';document.forms['article'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC' && $ORDER_BY == 'd.title'}DESC{else}ASC{/if}';document.forms['article'].submit();">{"Title"|translate} {if $ORDER_BY == 'd.title'}<img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/>{/if}</td>
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
       {$ENTRY.art_nr|default:"&nbsp;"}
       </td>
       <td class="row">
       {$ENTRY.title|default:"?"}
       </td>
      </tr>
     {/foreach}
    </table>
 {include file="includes/navigator.tpl" form="article"}
 {yoffset}
</form>

<script language="javascript" type="text/javascript">
<!--
window.focus();
// -->
</script>
