<form method="post" name="search">
 <h2>{"Search articles"|translate}</h2>
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="left">{"Search term"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_term" size="42" value="{$SEARCHTERM}" />&nbsp;{
   actionIcon
       action="getSearchResults"
       icon="view.png"
       form="0"
       target="slave1"
       title="Start search"
   }</td>
  </tr>
  <tr>
   <td class="left">{"Language"|translate}</td>
   <td class="right">
    <select name="x{$BASEID}_lang_filter">
    {foreach from=$LANGS key=KEY item=LANG}
    <option value="{$KEY}" {if $ACTIVE_LANG == $KEY}selected{/if}>{$LANG.name|translate}</option>
    {/foreach}
    </select>
   </td>
  </tr>
 </table>
 {if sizeof($ARTICLES) > 0}
 <h2>{"Search results"|translate}</h2>
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="45">&nbsp;</td>
   <td class="table_header">{"Title"|translate}</td>
  </tr>
  {foreach from=$ARTICLES item=ARTICLE}
  <tr class="{cycle values=row_a,row_b}">
   <td class="button">{
   actionIcon
       icon="pencil.png"
       action="editArticle"
       form="0"
       id=$ARTICLE.id
       target="slave1"
       title="Edit this article entry"
   }{actionIcon 
       action="view"
       icon="view.png"
       form="0"
       target="slave1"
       perm="view"
       id=$ARTICLE.id
       title="Preview this article entry"
   }</td>
   <td class="row">{
   actionLink
       action="editArticle"
       form="0"
       id=$ARTICLE.id
       target="slave1"
       text=$ARTICLE.title|truncate:70:"...":true
   }</td>
  </tr>
  {/foreach}
 </table>
 {else}
 {if $SEARCHTERM != ''}
 <div style="padding: 10px; color: red;">{"No results found"|translate}</div>
 {/if}
 {/if}
 <input type="hidden" name="x{$BASEID}_action" />
 <input type="hidden" name="x{$BASEID}_id" />
 <input type="hidden" name="x{$BASEID}_article_id" value="" />
 <input type="hidden" name="x{$BASEID}_node_pid" value="" />
 <input type="hidden" name="x{$BASEID}_node_id" value="" />
 <input type="hidden" name="x{$BASEID}_position" value="" />
 <input type="hidden" name="module" value="search" />
</form>
