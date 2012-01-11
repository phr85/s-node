<form method="post" name="o" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="o"}

<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td class="lang_tab">User: 
<select name="x{$BASEID}_current_user" onchange="submit();">
{foreach from=$USERFOLDERS item=user}
<option value="{$user.id}" {if $CURRENT_USER==$user.id} selected="selected"{/if}>{$user.username}</option>
{/foreach}
</select>
</td>
</tr>

 {foreach from=$NODES item=NODE}
  <tr class="{cycle values="row_a,row_b"}">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0}{if $NODE.itw}<a href="javascript:window.parent.frames['slave2'].document.forms[0].x{$BASEID}_action.value='';window.parent.frames['slave2'].document.forms[0].x{$BASEID}_pid.value={$NODE.pid};window.parent.frames['slave2'].document.forms[0].x{$BASEID}_open.value={$NODE.pid};window.parent.frames['slave2'].document.forms[0].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.pid};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt="" /></a>{else}<a href="javascript:window.parent.frames['slave2'].document.forms[0].x{$BASEID}_action.value='';window.parent.frames['slave2'].document.forms[0].x{$BASEID}_open.value={$NODE.id};window.parent.frames['slave2'].document.forms[0].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/plus.gif" alt="" /></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" alt="" width="9" />{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:window.parent.frames['slave2'].document.forms[0].x{$BASEID}_action.value='';window.parent.frames['slave2'].document.forms[0].x{$BASEID}_open.value={$NODE.id};window.parent.frames['slave2'].document.forms[0].x{$BASEID}_pid.value={$NODE.pid};window.parent.frames['slave2'].document.forms[0].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{/if}{/if}</a><br />
      </td>
      <td class="row"><a href="javascript:window.parent.frames['slave2'].document.forms[0].x{$BASEID}_action.value='';window.parent.frames['slave2'].document.forms[0].x{$BASEID}_pid.value={$NODE.pid};document.forms[0].x{$BASEID}_action.value='';window.parent.frames['slave2'].document.forms[0].x{$BASEID}_open.value={$NODE.id};window.parent.frames['slave2'].document.forms[0].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}&nbsp;</a></td>
      <td class="button" align="right">
      {if $NODE.id > 1}{if $CTRL
          } {if $NODE.pid !=0}{actionIcon
                action="insertNode"
                icon="explorer/arrow_down_green.png"
                form="0"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="after"
                title="Insert after this folder"
          }{actionIcon
                action="insertNode"
                icon="explorer/arrow_up_green.png"
                form="0"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="before"
                title="Insert before this folder"
          }{/if}{actionIcon
                action="insertNode"
                icon="explorer/folder_into.png"
                form="0"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="into"
                title="Insert into this node"
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
                    title="Deactivate this folder in this language"
          }{else
              }{actionIcon
                    action="activateLang"
                    icon="inactive.png"
                    form="o"
                    node_perm="changeStatus"
                    node_pid=$NODE.pid
                    id=$NODE.id
                    node_id=$NODE.id
                    title="Activate this folder in this language"
          }{/if
          }{actionIcon
                action="editNode"
                icon="pencil.png"
                form="0"
                target="slave1"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="editFiles"
                title="Edit this folder"
          }
          {if ($HOME_DIRS != $NODE.tree_id) OR $HOME_DIRS == ""}
          {actionIcon
                action="cutNode"
                icon="cut.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="deleteFiles"
                title="Cut this folder"
          }{actionIcon
                action="copyNode"
                icon="copy.png"
                form="o"
                source_node_id=$NODE.id
                title="Copy this folder structure"
          }
          {/if}
          {actionIcon
                action="editNodePerms"
                icon="lock.png"
                form="o"
                node_perm="manageFilePermissions"
                node_id=$NODE.id
                node_pid=$NODE.pid
                title="Edit folder permissions"
          }
          {if $NODE.pid !=0}
          {actionIcon
                action="deleteNode"
                icon="delete.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="deleteFiles"
                title="Delete this folder"
                ask="Are you sure you want to delete this folder?"
          }
          {/if}
      {/if}{else}{actionIcon
            action="editNodePerms"
            icon="lock.png"
            form="o"
            node_perm="manageFilePermissions"
            node_id=$NODE.id
            node_pid=$NODE.pid
            title="Edit folder permissions"
        }{if $CTRL}{actionIcon
            action="insertNode"
            icon="explorer/folder_into.png"
            form="0"
            node_perm="manageFilePermissions"
            node_pid=0
            node_id=1
            target="slave1"
            position="into"
            title="Insert into root folder"
        }{else}{$ICONSPACER}{/if}{/if}
      </td>
     </tr>
    </table>
   </td>
  </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_file_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_open" value="" />
<input type="hidden" name="x{$BASEID}_pid" value="" />
<input type="hidden" name="module" value="{$ADMINMODUL}" />
<input type="hidden" name="x{$BASEID}_source_node_id" value="" />
{yoffset}
</form>