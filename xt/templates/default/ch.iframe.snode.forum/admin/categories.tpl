<form method="post" id="o" name="o" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" onSubmit="window.document.forms['o'].x{$BASEID}_yoffset.value=window.pageYOffset;">
{include file="includes/buttons.tpl" data=$CATEGORY_BUTTONS withouthidden=true}
{include file="includes/lang_selector_simple.tpl" form="o"}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$NODES item=NODE}
  <tr class="{cycle values="row_a,row_b"}">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0 || $ARTICLES[$NODE.id] > 0}{if $NODE.itw}<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.pid};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt="" /></a>{else}<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/plus.gif" alt="" /></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" />{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:window.parent.frames['master'].document.forms[1].x{$BASEID}_active.value='{$NODE.node_id}';window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$NODE.id};window.parent.frames['master'].document.forms[1].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{/if}{/if}</a><br />
      </td>
      <td class="row"><a href="javascript:window.parent.frames['master'].document.forms[1].x{$BASEID}_active.value='{$NODE.node_id}';window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$NODE.id};window.parent.frames['master'].document.forms[1].submit();">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}&nbsp;</a></td>
      <td class="button" align="right">{if $NODE.id > 1}
      {get_session_value baseid=$BASEID value="ctrl_cut" assign="local_target"}

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

                action="editcategories"
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

          }{
       /if}{else}{$ICONSPACER}{/if}</td>
     </tr>


  {if $NODE.id == $OPEN && $CTRL ==0}
  {foreach from=$FORUMS item=FORUM}
  <tr>
  <td class="row" colspan="2" style="font-size:9px;">T{$FORUM.topic_count} P{$FORUM.posting_count}</td>

 <td class="row">{$FORUM.title}</td>
  <td class="button" align="right">{if $FORUM.active == 1
              }{actionIcon
                    action="deactivateforum"
                    icon="active.png"
                    form="o"
                    id=$FORUM.id
                    title="Deactivate this forum"
          }{else
              }{actionIcon

                    action="activateforum"
                    icon="inactive.png"
                    form="o"
                    id=$FORUM.id
                    title="Activate this forum"
          }{/if
          }{actionIcon
                action="editforum"
                icon="pencil.png"
                form="0"
                target="slave1"
                id=$FORUM.id
                title="Edit this forum"
          } {actionIcon
                action="cutforum"
                icon="cut.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                id=$FORUM.id
                title="Cut this forum"
          }{actionIcon
                action="deleteforum"
                icon="delete.png"
                form="o"
                id=$FORUM.id
                title="Delete this forum"
                ask="Are you sure you want to delete this forum?"

          }</td>
  </tr>
  {/foreach}
  {/if}

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
 {include file="ch.iframe.snode.forum/admin/hiddenValues.tpl"}

</form>