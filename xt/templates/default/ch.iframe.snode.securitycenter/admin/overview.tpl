<form method="POST" name="o">
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}

{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS withouthidden=1}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$NODES item=NODE}
 {if $NODE.l != 1 || $CTRL !=0}
  <tr class="{cycle values="row_a,row_b"}" colspan="2">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0}{if $NODE.itw}<a href="javascript:document.forms['navigation'].x{$BASEID}_open.value={$NODE.pid};document.forms['navigation'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt="" /></a>{else}<a href="javascript:document.forms['navigation'].x{$BASEID}_open.value={$NODE.id};document.forms['navigation'].submit();" /><img src="{$XT_IMAGES}icons/plus.gif" alt="" /></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" height="9" alt="" />{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:document.forms[1].x{$BASEID}_action.value='';document.forms[1].x{$BASEID}_open.value={$NODE.id};document.forms[1].submit();">{
        if $NODE.itw}{
            if $NODE.subs > 0}{
                if $NODE.level == 2
                    }<img src="{$XT_IMAGES}icons/data.png" alt="" />{
                else
                    }<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{
                /if
            }{else
                }{
                if $NODE.level == 2
                    }<img src="{$XT_IMAGES}icons/data.png" alt="" />{
                else
                    }<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{
                /if
            }{
            /if}{
        else}<img src="{$XT_IMAGES}icons/data.png" alt="" />{
        /if}</a><br />
      </td>
      <td class="row">{if $NODE.itw}{actionLink
      action= "clickOnNode"
      form="o"
      yoffset=1
      text=$NODE.title
      open=$NODE.id
      style="color:black; font-weight:bold"
      principal_type=4
      }{else}{actionLink
      action= "clickOnNode"
      form="o"
      yoffset=1
      text=$NODE.title
      open=$NODE.id
      principal_type=4
      }{/if}&nbsp;</a></td>
      <td class="button" align="right">
      {if $CTRL
          }{if $NODE.id != 1}{actionIcon
                action="insertNode"
                icon="explorer/arrow_down_green.png"
                form="0"
                perm="pools"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="after"
                title="Insert after this node"
          }{actionIcon
                action="insertNode"
                icon="explorer/arrow_up_green.png"
                form="0"
                perm="pools"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="before"
                title="Insert before this node"
          }{/if}{actionIcon
                action="insertNode"
                icon="explorer/folder_into.png"
                form="0"
                perm="pools"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="into"
                title="Insert into this node"
      }{else
          }{if $NODE.id != 1}{actionIcon
                action="editNode"
                icon="pencil.png"
                form="0"
                target="slave1"
                node_id=$NODE.id
                node_pid=$NODE.pid
                perm="pools"
                title="Edit this page"
          }{actionIcon
                action="cutNode"
                icon="cut.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                perm="pools"
                title="Cut this page node"
          }{actionIcon
                action="deleteNode"
                icon="delete.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                perm="pools"
                title="Delete this page node"
                ask="Are you sure you want to delete this node?"
          }{else} &nbsp;{/if}
      {/if}
      </td>
     </tr>
    </table>
   </td>
  </tr>
  {foreach from=$ROLES[$NODE.id] item=ROLE}
  <tr class="{cycle values="row_a,row_b"}" colspan="2">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="row" style="padding-left: {$NODE.level*20+5}px; width: 1px;padding-right: 0px;"><img src="{$XT_IMAGES}icons/role.png" width="16" /></td>
      <td class="row">{if $PRINCIPAL_ID == $ROLE.id && $PRINCIPAL_TYPE == 3 && $ROLE.node_id == $OPEN}{actionLink
      action= "clickOnRole"
      form="o"
      yoffset=1
      text=$ROLE.title
      open=$NODE.id
      principal_id=$ROLE.id
      principal_type=3
      style="color:black; font-weight:bold"
      }{else}{actionLink
      action= "clickOnRole"
      form="o"
      yoffset=1
      text=$ROLE.title
      open=$NODE.id
      principal_id=$ROLE.id
      principal_type=3
      }{/if}</td>
     <td class="row" align="right">{actionIcon
                action="s1editRole"
                icon="pencil.png"
                form="0"
                target="slave1"
                role_id=$ROLE.id
                title="Edit this role"
          }{
          actionIcon
                action="removeRoleFromPool_o"
                icon="delete.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                principal_id = $ROLE.id
                perm="roles"
                title="remove this role"
                yoffset = 1
          }
     </td>
      </tr>
    </table>
   </td>
  </tr>

  {if $PRINCIPAL_ID == $ROLE.id && $PRINCIPAL_TYPE == 3 && $ROLE.node_id == $OPEN}

      {foreach from=$GROUPSINROLES item=GIR}
      <tr class="{cycle values="row_a,row_b"}" colspan="2">
       <td>
        <table cellspacing="0" cellpadding="0" width="100%">
         <tr>
          <td class="row" style="padding-left: {$NODE.level*20+25}px; width: 1px;padding-right: 0px;"><img src="{$XT_IMAGES}icons/group.png" width="16" /></td>
      <td class="row">{if $GROUP_ID == $GIR.id && $PRINCIPAL_TYPE == 3 && $ROLE.node_id == $OPEN}{actionLink
      action="clickOnGroup"
      form="o"
      yoffset=1
      text=$GIR.title
      open=$NODE.id
      group_id=$GIR.id
      group_selected=1
      style="color:black; font-weight:bold"
      }{else}{actionLink
      action= "clickOnGroup"
      form="o"
      yoffset=1
      text=$GIR.title
      open=$NODE.id
      group_id=$GIR.id
      group_selected=1
      }{/if}</td>

      <td class="row" align="right">{actionIcon
                action="s1EditGroup"
                icon="pencil.png"
                form="0"
                target="slave1"
                group_id=$GIR.id
                title="Edit this group"
          }{actionIcon
                action="removeGroupFromRole"
                icon="delete.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                role_id = $ROLE.id
                group_id = $GIR.id
                perm="roles"
                title="remove this group"
                yoffset = 1
          }
     </td>
     </tr>
    </table>
       </td>
      </tr>
      {/foreach}


  {/if}
  {/foreach}
  {foreach from=$GROUPS[$NODE.id] item=GROUP}
  <tr class="{cycle values="row_a,row_b"}" colspan="2">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="row" style="padding-left: {$NODE.level*20+5}px; width: 1px;padding-right: 0px;"><img src="{$XT_IMAGES}icons/group.png" width="16" /></td>
      <td class="row">{if $PRINCIPAL_ID == $GROUP.id && $PRINCIPAL_TYPE == 2 && $GROUP.node_id == $OPEN}{actionLink
      action= "clickOnGroup"
      form="o"
      yoffset=1
      text=$GROUP.title
      open=$NODE.id
      principal_id=$GROUP.id
      group_id=$GROUP.id
      principal_type=2
      style="color:black; font-weight:bold"
      }{else}{actionLink
      action= "clickOnGroup"
      form="o"
      yoffset=1
      text=$GROUP.title
      open=$NODE.id
      principal_id=$GROUP.id
      group_id=$GROUP.id
      principal_type=2
      }{/if}</td>

      <td class="row" align="right">{actionIcon
                action="s1EditGroup"
                icon="pencil.png"
                form="0"
                target="slave1"
                group_id=$GROUP.id
                title="Edit this group"
          }{actionIcon
                action="removeGroupFromPool_o"
                icon="delete.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                principal_id = $GROUP.id
                perm="roles"
                title="remove this group"
                yoffset = 1
          }
     </td>
     </tr>
    </table>
   </td>
  </tr>
  {/foreach}
  {/if}
 {/foreach}
</table>
</form>
