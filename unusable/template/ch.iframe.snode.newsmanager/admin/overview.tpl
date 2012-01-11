<form method="POST" name="o">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="o"}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$NODES item=NODE}
  <tr class="{cycle values="row_a,row_b"}" colspan="2">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0 || $NEWS[$NODE.id] > 0}{if $NODE.itw}<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.pid};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt=""></a>{else}<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/plus.gif" alt=""></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9">{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:window.parent.frames['master'].document.forms[1].x{$BASEID}_action.value='';window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$NODE.id};window.parent.frames['master'].document.forms[1].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="">{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="">{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="">{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="">{/if}{/if}</a><br>
      </td>
      <td class="row"><a href="javascript:window.parent.frames['master'].document.forms[1].x{$BASEID}_action.value='';window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$NODE.id};window.parent.frames['master'].document.forms[1].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}&nbsp;</a></td>
      <td class="button" align="right">
      {if $CTRL
          }{if $NODE.id != 1 && $CTRLENTRY == 0}{actionIcon 
                action="insertNode"
                icon="explorer/arrow_down_green.png"
                form="0"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="after"
                title="Insert after this node"
                
          }{actionIcon 
          
                action="insertNode"
                icon="explorer/arrow_up_green.png"
                form="0"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="before"
                title="Insert before this category"
                
          }{/if}{actionIcon 
          
                action="insertNode" 
                icon="explorer/folder_into.png"
                form="0"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="into"
                title="Insert into this category"
                
      }{else
          }{if $NODE.active == 1
              }{actionIcon
              
                    action="deactivateLang"
                    icon="active.png"
                    form="o"
                    node_perm="changeStatus"
                    node_pid=$NODE.pid
                    id=$NODE.id
                    node_id=$NODE.id
                    title="Deactivate this category in this language"
                    
          }{else
              }{actionIcon 
              
                    action="activateLang"
                    icon="inactive.png"
                    form="o"
                    node_perm="changeStatus"
                    node_pid=$NODE.pid
                    id=$NODE.id
                    node_id=$NODE.id
                    title="Activate this category in this language"
                    
          }{/if
          }{actionIcon 
          
                action="editNode"
                icon="pencil.png"
                form="0"
                target="slave1"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="editFiles"
                title="Edit this category"
                
          }{actionIcon 
          
                action="cutNode"
                icon="cut.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="deleteFiles"
                title="Cut this category"
                
          }{actionIcon 
          
                action="copyNode"
                icon="copy.png"
                form="o"
                source_node_id=$NODE.id
                title="Copy this category"
                
          }{actionIcon 
          
                action="editNodePerms"
                icon="lock.png"
                form="o"
                node_perm="manageFilePermissions"
                node_id=$NODE.id
                node_pid=$NODE.pid
                title="Edit category permissions"
                
          }{actionIcon 
          
                action="deleteNode"
                icon="delete.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="deleteFiles"
                title="Delete this category"
                ask="Are you sure you want to delete this category?"
          
          }
      {/if}
      </td>
     </tr>
    </table>
   </td>
  </tr>
  {if $NODE.itw && $CTRL==0}
  {foreach from=$NEWS[$NODE.id] item=NEWS}
  <tr>
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="row" style="padding-left: {$NODE.level*20-12}px; width: 1px;"><img src="{$XT_IMAGES}spacer.gif" alt="" width="9" /></td>
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">{if $NEWS.published == 1}<img class="icon" src="{$XT_IMAGES}icons/document_green.png" alt="{'Published'|translate}" title="{'Published'|translate}"/>{else}{actionIcon 
        action="publish"
        icon="document_red.png"
        form="o"
        perm="statuschange"
        id=$NEWS.id
        title="Publish this news"
      }{/if}</td>
      <td class="row">{actionLink 
            action="editNews"
            form="0"
            target="slave1"
            id=$NEWS.id
            perm="edit"
            title="Edit this news entry"
            text=$NEWS.title
       }</td>
      <td class="button" width="120" align="right">{if $NEWS.locked != 1 || $NEWS.locked_user == $USER_ID}{if $NEWS.active
       }{actionIcon 
            action="view"
            icon="view.png"
            form="o"
            perm="view"
            id=$NEWS.id
            title="Preview this news entry"
       }{actionIcon 
            action="deactivate"
            icon="active.png"
            form="o"
            perm="statuschange"
            id=$NEWS.id
            title="Deactivate this news entry"
       }{else
       }{actionIcon 
            action="activate"
            icon="inactive.png"
            form="o"
            perm="statuschange"
            id=$NEWS.id
            title="Activate this news entry"
       }{/if
       }{actionIcon 
            action="editNews"
            icon="pencil.png"
            form="0"
            target="slave1"
            id=$NEWS.id
            perm="edit"
            title="Edit this news entry"
       }{actionIcon 
                action="cutEntry"
                icon="cut.png"
                form="o"
                id=$NEWS.id
                node_id=$NODE.id
                node_perm="deleteFiles"
                title="Cut this entry"
          }{actionIcon 
                action="copyEntry"
                icon="copy.png"
                form="o"
                id=$NEWS.id
                node_id=$NODE.id
                title="Copy this entry"
                
          }{actionIcon 
            action="deleteNews"
            icon="delete.png"
            form="o"
            id=$NEWS.id
            perm="delete"
            title="Delete this news entry"
            ask="Are you sure you want to delete this news entry?"
       }{else}{"In edit"|translate}{/if
       }</td>
     </tr>
    </table>
   </td>
  </tr>
  {/foreach}
  {/if}
 {/foreach}
</table>
{actionIcon 
    action="editNodePerms"
    icon="lock.png"
    form="o"
    node_perm="manageFilePermissions"
    node_id=$NODE.id
    node_pid=$NODE.pid
    title="Edit page node permissions"
}
<input type="hidden" name="x{$BASEID}_id" value="">
<input type="hidden" name="x{$BASEID}_position" value="">
<input type="hidden" name="x{$BASEID}_node_id" value="">
<input type="hidden" name="x{$BASEID}_node_pid" value="">
<input type="hidden" name="x{$BASEID}_open" value="">
<input type="hidden" name="x{$BASEID}_source_node_id" value="">
{yoffset}
</form>