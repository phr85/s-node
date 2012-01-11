<form method="POST" name="article">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 {include file="includes/lang_selector_simple.tpl" form="article"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">&nbsp;</td>
   <td class="table_header" width="40">{actionIcon action="NULL" label="ID" form=article sort=$sort.0.value icon=$sort.0.icon}</td>
   <td class="table_header">{actionIcon action="NULL" form=article label="Title" sort=$sort.1.value icon=$sort.1.icon}</td>
   <td class="table_header" width="44">{actionIcon action="NULL" form=article label="Rev" sort=$sort.2.value icon=$sort.2.icon}</td>
   <td class="table_header" width="40">{actionIcon action="NULL" form=article label="Pub" sort=$sort.3.value icon=$sort.3.icon}</td>
  </tr>
  {foreach from=$DATA item=ARTICLE name=ARTICLETABLE}
  <tr class="{cycle values="row_a,row_b"}" {if $ARTICLE.locked_user == $USER_ID}style="background-image: url({$XT_IMAGES}admin/gfx/naventry_active.gif);"{/if}>
   <td class="button">{if $ARTICLE.locked != 1 || $ARTICLE.locked_user == $USER_ID}{if $ARTICLE.active
   }{actionIcon 
        action="deactivate"
        icon="active.png"
        form="article"
        perm="statuschange"
        id=$ARTICLE.id
        title="Deactivate this article entry"
   }{else
   }{actionIcon 
        action="activate"
        icon="inactive.png"
        form="article"
        perm="statuschange"
        id=$ARTICLE.id
        title="Activate this article entry"
   }{/if
   }{actionIcon 
        action="view"
        icon="view.png"
        form="article"
        perm="view"
        id=$ARTICLE.id
        title="Preview this article entry"
   }{actionIcon 
        action="editArticle"
        icon="pencil.png"
        form="0"
        target="slave1"
        id=$ARTICLE.id
        perm="edit"
        title="Edit this article entry"
   }{actionIcon 
        action="deleteArticle"
        icon="delete.png"
        form="article"
        id=$ARTICLE.id
        perm="delete"
        title="Delete this article entry"
        ask="Are you sure you want to delete this article entry?"
   }{else}{"In edit"|translate}{/if}</td>
   <td class="row">{$ARTICLE.id}</td>
   <td class="row">{
   actionLink
       action="editArticle"
       form="0"
       target="slave1"
       perm="view"
       id=$ARTICLE.id
       text=$ARTICLE.title|truncate:40:"...":true
   }&nbsp;</td>
   <td class="row">{$ARTICLE.rid}&nbsp;</td>
   <td class="button">{if $ARTICLE.published == 1}<img src="{$XT_IMAGES}icons/document_green.png" alt="{'Published'|translate}" title="{'Published'|translate}"/>{else}{actionIcon 
        action="publish"
        icon="document_red.png"
        form="article"
        perm="statuschange"
        id=$ARTICLE.id
        title="Publish this article"
   }{/if}</td>
  </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="article"}
 <input type="hidden" name="x{$BASEID}_id" value="">
 <input type="hidden" name="x{$BASEID}_sort" value="" />
 <input type="hidden" name="module" value="l">
</form>