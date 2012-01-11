<form method="POST" name="article">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 {include file="includes/lang_selector_simple.tpl" form="article"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="30">ID</td>
   <td class="table_header">{"Title"|translate}</td>
   <td class="table_header" width="30">{"Rev"|translate}</td>
   <td class="table_header" width="30">{"Pub"|translate}</td>
  </tr>
  {foreach from=$DATA item=NEWS}
  <tr class="{cycle values="row_a,row_b"}" {if $NEWS.locked_user == $USER_ID}style="background-image: url({$XT_IMAGES}admin/gfx/naventry_active.gif);"{/if}>
   <td class="button">{if $NEWS.locked != 1 || $NEWS.locked_user == $USER_ID}{if $NEWS.active
   }{actionIcon 
        action="deactivate"
        icon="active.png"
        form="article"
        perm="statuschange"
        id=$NEWS.id
        title="Deactivate this news entry"
   }{else
   }{actionIcon 
        action="activate"
        icon="inactive.png"
        form="article"
        perm="statuschange"
        id=$NEWS.id
        title="Activate this news entry"
   }{/if
   }{actionIcon 
        action="view"
        icon="view.png"
        form="article"
        perm="view"
        id=$NEWS.id
        title="Preview this news entry"
   }{actionIcon 
        action="editNews"
        icon="pencil.png"
        form="0"
        target="slave1"
        id=$NEWS.id
        perm="edit"
        title="Edit this news entry"
   }{actionIcon 
        action="deleteNews"
        icon="delete.png"
        form="article"
        id=$NEWS.id
        perm="delete"
        title="Delete this news entry"
        ask="Are you sure you want to delete this news entry?"
   }{else}{"In edit"|translate}{/if}</td>
   <td class="row">{$NEWS.id}</td>
   <td class="row">{$NEWS.title|truncate:40:"...":true}&nbsp;</td>
   <td class="row">{$NEWS.rid}&nbsp;</td>
   <td class="button">{if $NEWS.published == 1}<img src="{$XT_IMAGES}icons/document_green.png" alt="{'Published'|translate}" title="{'Published'|translate}"/>{else}{actionIcon 
        action="publish"
        icon="document_red.png"
        form="article"
        perm="statuschange"
        id=$NEWS.id
        title="Publish this article"
   }{/if}</td>
  </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="article"}
 <input type="hidden" name="x{$BASEID}_id" value="">
 <input type="hidden" name="module" value="l">
</form>