<form method="post" id="o" name="o" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" onSubmit="window.document.forms['o'].x{$BASEID}_yoffset.value=window.pageYOffset;">
{include file="includes/buttons.tpl" data=$BROWSER_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="o"}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$NODES item=NODE}
  <tr class="{cycle values="row_a,row_b"}">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0 || $ARTICLES[$NODE.id] > 0}{if $NODE.itw}<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.pid};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt="" /></a>{else}<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/plus.gif" alt="" /></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" />{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:window.parent.frames['master'].document.forms[1].x{$BASEID}_active.value='{$NODE.node_id}';window.parent.frames['master'].document.forms[1].x{$BASEID}_action.value='openNode';window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$NODE.id};window.parent.frames['master'].document.forms[1].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{/if}{/if}</a><br />
      </td>
      <td class="row"><a href="javascript:window.parent.frames['master'].document.forms[1].x{$BASEID}_active.value='{$NODE.node_id}';window.parent.frames['master'].document.forms[1].x{$BASEID}_action.value='openNode';window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$NODE.id};window.parent.frames['master'].document.forms[1].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}&nbsp;</a></td>
      <td class="button" align="right">{if $NODE.id > 1}
      {get_session_value baseid=$BASEID value="ctrl_cut" assign="local_target"}
      {get_session_value baseid=$BASEID value="ctrl_copy" assign="local_target"}
      {if $CTRL
          }{if $NODE.id != 1 && $CTRLENTRY == 0}
          {if $local_target}
          {actionIcon
                action="insertNode"
                icon="explorer/arrow_down_green.png"
                form="o"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id

                position="after"
                title="Insert after this node"
          }{actionIcon
                action="insertNode"
                icon="explorer/arrow_up_green.png"
                form="o"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id

                position="before"
                title="Insert before this category"
          }
          {else}{actionIcon
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
          }{/if}{/if}
          {if $local_target}{actionIcon
                action="insertNode"
                icon="explorer/folder_into.png"
                form="o"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id

                position="into"
                title="Insert into this category"
      }{else}{actionIcon
                action="insertNode"
                icon="explorer/folder_into.png"
                form="0"
                node_perm="addFiles"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="into"
                title="Insert into this category"
      }{/if}{else
          }{if $NODE.active == 1
              }{actionIcon

                    action="deactivateNodeLang"
                    icon="active.png"
                    form="o"
                    node_perm="changeStatus"
                    node_pid=$NODE.pid
                    id=$NODE.id
                    node_id=$NODE.id
                    title="Deactivate this category in this language"

          }{else
              }{actionIcon

                    action="activateNodeLang"
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
                node_perm="manageStructure"
                title="Edit this category"

          }
          {actionIcon
                action="openNode"
                icon="table_sql_add.png"
                form="1"
                target="master"
                active=$NODE.id
                open=$NODE.id
                title="Edit this category"

          }
          {actionIcon
                action="cutNode"
                icon="cut.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="manageStructure"
                title="Cut this category"
          }{actionIcon
                action="copyNode"
                icon="copy.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="manageStructure"
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
                node_perm="manageStructure"
                title="Delete this category"
                ask="Are you sure you want to delete this category?"

          }{
       /if}{else}{$ICONSPACER}{/if}</td>
     </tr>
    </table>
   </td>
  </tr>

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
}{if $CTRL}{actionIcon
    action="insertNode"
    icon="explorer/folder_into.png"
    form="0"
    node_perm="manageFilePermissions"
    node_pid=0
    node_id=1
    target="slave1"
    position="into"
    title="Insert into this node"
}{/if}
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_save_lang" value="" />
<input type="hidden" name="x{$BASEID}_active" />
<input type="hidden" name="x{$BASEID}_position" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_open" value="" />
<input type="hidden" name="showtabs" value="1" />
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}" />
    {yoffset}
</form>