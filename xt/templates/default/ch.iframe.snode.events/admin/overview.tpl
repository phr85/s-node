<form method="post" name="o" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="o"}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$NODES item=NODE}
  <tr class="{cycle values="row_a,row_b"}">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0 || $EVENTS[$NODE.id] > 0}{if $NODE.itw}<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.pid};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt="" /></a>{else}<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();"><img src="{$XT_IMAGES}icons/plus.gif" alt="" /></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" />{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:window.parent.frames['master'].document.forms[1].x{$BASEID}_action.value='';window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$NODE.id};window.parent.frames['master'].document.forms[1].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{/if}{/if}</a><br />
      </td>
      <td class="row"><a href="javascript:window.parent.frames['master'].document.forms[1].x{$BASEID}_action.value='';window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$NODE.id};window.parent.frames['master'].document.forms[1].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}&nbsp;</a></td>
      <td class="button" align="right">{if $NODE.id > 1}
      {if $CTRL
          }{if $NODE.id != 1 && $CTRLENTRY == 0}{actionIcon
                action="insertNode"
                icon="explorer/arrow_down_green.png"
                form="0"
                perm="addEvents"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="after"
                title="Insert after this node"

          }{actionIcon

                action="insertNode"
                icon="explorer/arrow_up_green.png"
                form="0"
                perm="addEvents"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="before"
                title="Insert before this category"

          }{/if}{if $CTRLENTRY}{actionIcon

                action="insertEntry"
                icon="explorer/folder_into.png"
                form="1"
                perm="addEvents"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="master"
                position="into"
                title="Insert into this category"

          }{else}{actionIcon

                action="insertNode"
                icon="explorer/folder_into.png"
                form="0"
                perm="edit"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="slave1"
                position="into"
                title="Insert into this category"

          }{/if
      }{else
          }{if $NODE.active == 1
              }{actionIcon

                    action="deactivateLang"
                    icon="active.png"
                    form="o"
                    perm="edit"
                    node_pid=$NODE.pid
                    id=$NODE.id
                    node_id=$NODE.id
                    title="Deactivate this category in this language"

          }{else
              }{actionIcon

                    action="activateLang"
                    icon="inactive.png"
                    form="o"
                    perm="edit"
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
                perm="edit"
                title="Edit this category"

          }{actionIcon

                action="cutNode"
                icon="cut.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                perm="edit"
                title="Cut this category"

          }{actionIcon
                action="copyNode"
                icon="copy.png"
                form="o"
                source_node_id=$NODE.id
                title="Copy this category"

          }{actionIcon

                action="deleteNode"
                icon="delete.png"
                form="o"
                node_id=$NODE.id
                node_pid=$NODE.pid
                perm="edit"
                title="Delete this category"
                ask="Are you sure you want to delete this category?"

          }{
       /if}{else}{$ICONSPACER}{/if}</td>
     </tr>
    </table>
   </td>
  </tr>
  {if $NODE.itw && $CTRL ==0}
  {foreach from=$EVENTS[$NODE.id] item=EVENT}
  <tr>
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="row" style="padding-left: {$NODE.level*20-12}px; width: 1px;">{if $EVENT.timer == 'ready'}<img src="{$XT_IMAGES}icons/alarmclock_pause.png" alt="" width="16" />{/if
      }{if $EVENT.timer == 'expired'}<img src="{$XT_IMAGES}icons/alarmclock_stop.png" alt="" width="16" />{/if
      }{if $EVENT.timer == 'running'}<img src="{$XT_IMAGES}icons/alarmclock_run.png" alt="" width="16" />{/if
      }{if $EVENT.timer == 'unused'}<img src="{$XT_IMAGES}spacer.gif" alt="" width="16" />{/if}</td>
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px"><img src="{$XT_IMAGES}icons/document.png" width="16" height="16" /></td>
      <td class="row" style="width: 50%;">{actionLink
            action="editEvent"
            form="0"
            target="slave1"
            id=$EVENT.id
            perm="edit"
            title="Edit this event entry"
            text=$EVENT.title|truncate:45:"...":true
       }
       </td>
      <td class="row">({$EVENT.from_date|date_format:"%d.%m.%Y"})</td>
      <td class="button" width="120" align="right">{if $EVENT.registrations > 0}{actionIcon
            action="showRegistrations"
            icon="users1.png"
            form=0
            perm="edit"
            id=$EVENT.id
            target="slave1"
            title="Show registrations"
       }{else}{actionIcon
            action="showRegistrations"
            icon="users1_na.png"
            form=0
            perm="edit"
            id=$EVENT.id
            target="slave1"
            title="Show registrations"
       }{/if}{if $EVENT.locked != 1 || $EVENT.locked_user == $USER_ID}{if $EVENT.active
       }{actionIcon
            action="deactivate"
            icon="active.png"
            form="o"
            perm="edit"
            id=$EVENT.id
            title="Deactivate this event entry"
       }{else
       }{actionIcon
            action="activate"
            icon="inactive.png"
            form="o"
            perm="edit"
            id=$EVENT.id
            title="Activate this event entry"
       }{/if}{actionIcon
            action="editEvent"
            icon="pencil.png"
            form="0"
            target="slave1"
            id=$EVENT.id
            perm="edit"
            title="Edit this event entry"
       }{actionIcon
                action="cutEntry"
                icon="cut.png"
                form="o"
                id=$EVENT.id
                node_id=$NODE.id
                perm="edit"
                title="Cut this entry"
          }{actionIcon
                action="copyEntry"
                icon="copy.png"
                form="o"
                id=$EVENT.id
                node_id=$NODE.id
                title="Copy this entry"
          }{actionIcon
            action="deleteEvent"
            icon="delete.png"
            form="o"
            id=$EVENT.id
            perm="edit"
            title="Delete this event entry"
            ask="Are you sure you want to delete this event entry?"
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
    node_perm="edit"
    node_id=$NODE.id
    node_pid=$NODE.pid
    title="Edit page node permissions"
}{if $CTRL}{actionIcon
    action="insertNode"
    icon="explorer/folder_into.png"
    form="0"
    perm="edit"
    node_pid=0
    node_id=1
    target="slave1"
    position="into"
    title="Insert into this node"
}{/if}
{include file="ch.iframe.snode.events/admin/hiddenValues.tpl"}
</form>