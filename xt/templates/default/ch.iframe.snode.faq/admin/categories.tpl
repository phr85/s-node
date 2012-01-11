<form method="post" name="faq_cat" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS withouthidden=1}
{include file="includes/lang_selector_simple.tpl" form="faq_cat"}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$NODES item=NODE}
  <tr class="{cycle values="row_a,row_b"}">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0 || $FAQS[$NODE.id] > 0}{if $NODE.itw}<a href="javascript:document.forms['o'].x{$BASEID}_open.value={$NODE.pid};document.forms['faq_cat'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt="" /></a>{else}<a href="javascript:document.forms['faq_cat'].x{$BASEID}_open.value={$NODE.id};document.forms['faq_cat'].submit();"><img src="{$XT_IMAGES}icons/plus.gif" alt="" /></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" />{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:window.parent.frames['master'].document.forms[1].x{$BASEID}_active.value='{$NODE.node_id}';window.parent.frames['master'].document.forms[1].x{$BASEID}_action.value='openNode';window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$NODE.id};window.parent.frames['master'].document.forms[1].submit();document.forms['faq_cat'].x{$BASEID}_open.value={$NODE.id};document.forms['faq_cat'].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="" />{/if}{/if}</a><br />
      </td>
      <td class="row"><a href="javascript:window.parent.frames['master'].document.forms[1].x{$BASEID}_action.value='';window.parent.frames['master'].document.forms[1].x{$BASEID}_open.value={$NODE.id};window.parent.frames['master'].document.forms[1].submit();document.forms['faq_cat'].x{$BASEID}_open.value={$NODE.id};document.forms['faq_cat'].submit();">{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.title}</b>{else}{$NODE.title}{/if}</span>{else}{$NODE.title}{/if}&nbsp;</a></td>
      <td class="button" align="right">{if $NODE.id > 2}
      {if $CTRL}
      		{if $NODE.id != 1 && $CTRLENTRY == 0}{actionIcon
                action="insertNode"
                icon="explorer/arrow_down_green.png"
                form="faq_cat"
                node_perm="add"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="master"
                target_module="categories"
                position="after"
                title="Insert after this category"
          }{actionIcon
                action="insertNode"
                icon="explorer/arrow_up_green.png"
                form="faq_cat"
                node_perm="add"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="master"
                target_module="categories"
                position="before"
                title="Insert before this category"
          }{/if}{if $CTRLENTRY}{actionIcon
                action="insertNode"
                icon="explorer/folder_into.png"
                form="faq_cat"
                node_perm="add"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="master"
                target_module="categories"
                position="into"
                title="Insert into this category"
          }{else}{actionIcon
                action="insertNode"
                icon="explorer/folder_into.png"
                form="faq_cat"
                node_perm="add"
                node_pid=$NODE.pid
                node_id=$NODE.id
                target="master"
                target_module="categories"
                position="into"
                title="Insert into this category"
          }{/if}
          {else}
          {if $NODE.active == 1
              }{actionIcon
                    action="deactivateNode"
                    icon="active.png"
                    form="faq_cat"
                    node_perm="statuschange"
                    node_pid=$NODE.pid
                    id=$NODE.id
                    node_id=$NODE.id
                    title="Deactivate this category"
          }{else
              }{actionIcon
                    action="activateNode"
                    icon="inactive.png"
                    form="faq_cat"
                    node_perm="statuschange"
                    node_pid=$NODE.pid
                    id=$NODE.id
                    node_id=$NODE.id
                    title="Activate this category"
          }{/if
          }{actionIcon
                action="editNode"
                icon="pencil.png"
                form="0"
                target="slave1"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="edit"
                title="Edit this category"
          }{actionIcon

                action="cutNode"
                icon="cut.png"
                form="faq_cat"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="delete"
                title="Cut this category"

          }{actionIcon
                action="copyNode"
                icon="copy.png"
                form="faq_cat"
                source_node_id=$NODE.id
                node_id=$NODE.id
                node_pid=$NODE.pid
                title="Copy this category"
          }{actionIcon
                action="editNodePerms"
                icon="lock.png"
                form="faq_cat"
                node_perm="manageNodePermissions"
                node_id=$NODE.id
                node_pid=$NODE.pid
                title="Edit category permissions"
          }{actionIcon
                action="deleteNode"
                icon="delete.png"
                form="faq_cat"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="delete"
                title="Delete this category"
                ask="Are you sure you want to delete this category?"
          }{/if}
      {else}{$ICONSPACER}{/if}</td>
     </tr>
    </table>
   </td>
  </tr>
  {if $NODE.itw && $CTRL ==0 && $NODE.id != 1}
  {foreach from=$xt1400_ITEMS item=FAQ}
  {if $NODE.id == $FAQ.node_id}
  <tr>
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="row" style="padding-left: {$NODE.level*20-12}px; width: 1px;">{if $FAQ.timer == 'ready'}<img src="{$XT_IMAGES}icons/alarmclock_pause.png" alt="" width="16" />{/if
      }{if $FAQ.timer == 'expired'}<img src="{$XT_IMAGES}icons/alarmclock_stop.png" alt="" width="16" />{/if
      }{if $FAQ.timer == 'running'}<img src="{$XT_IMAGES}icons/alarmclock_run.png" alt="" width="16" />{/if
      }{if $FAQ.timer == 'unused'}<img src="{$XT_IMAGES}spacer.gif" alt="" width="16" />{/if}</td>
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">{if $FAQ.published == 1}<img class="icon" src="{$XT_IMAGES}icons/document_green.png" alt="{'Published'|translate}" title="{'Published'|translate}"/>{else}{actionIcon
        action="editFaq"
        icon="help.png"
        form="0"
        target="slave1"
        perm="statuschange"
        id=$FAQ.id
        title="Edit this FAQ Item"
      }{/if}</td>
      <td class="row">{actionLink
            action="editFaq"
            form="0"
            target="slave1"
            id=$FAQ.id
            perm="edit"
            title="Edit this FAQ item"
            text=$FAQ.title|truncate:45:"...":true
       }
       </td>
      <td class="button" width="120" align="right">{if $FAQ.locked != 1 || $FAQ.locked_user == $USER_ID}{if $FAQ.active
       }{actionIcon
            action="deactivateFaq"
            icon="active.png"
            form="faq_cat"
            node_perm="statuschange"
            id=$FAQ.id
            node_pid=$NODE.pid
            node_id=$NODE.id
            title="Deactivate this faq"
       }{else
       }{actionIcon
            action="activateFaq"
            icon="inactive.png"
            form="faq_cat"
            node_perm="statuschange"
            node_pid=$NODE.pid
            node_id=$NODE.id
            id=$FAQ.id
            title="Activate this faq"
       }{/if
       }{actionIcon
	        action="editFaq"
	        icon="pencil.png"
	        form="0"
	        target="slave1"
	        id=$FAQ.id
	        perm="edit"
	        title="Edit this faq"
       }{actionIcon
                action="cutEntry"
                icon="cut.png"
                form="faq_cat"
                id=$FAQ.id
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="delete"
                title="Cut this FAQ item"
          }{actionIcon
                action="copyEntry"
                icon="copy.png"
                form="faq_cat"
                id=$FAQ.id
                title="Copy this FAQ item"
                node_perm="add"
                node_pid=$NODE.pid
                node_id=$NODE.id
          }{actionIcon
            action="moveUpFaq"
            icon="explorer/arrow_up_green.png"
            form="faq_cat"
            node_perm="statuschange"
            node_pid=$NODE.pid
            node_id=$NODE.id
            id=$FAQ.id
            title="move position up"
       }{actionIcon
            action="moveDownFaq"
            icon="explorer/arrow_down_green.png"
            form="faq_cat"
            node_perm="statuschange"
            node_pid=$NODE.pid
            node_id=$NODE.id
            id=$FAQ.id
            title="move position down"
       }{actionIcon
	        action="deleteFaqCat"
	        icon="delete.png"
	        form="faq_cat"
	        id=$FAQ.id
            node_id=$NODE.id
            node_pid=$NODE.pid
            node_perm="delete"
	        perm="delete"
	        title="Delete this faq"
	        ask="Are you sure you want to delete this faq?"
       }{else}{"In edit"|translate}{/if
       }</td>
     </tr>
    </table>
    </td>
  </tr>
  {/if}
  {/foreach}
  {/if}
 {/foreach}
</table>
{actionIcon
    action="editNodePerms"
    icon="lock.png"
    form="faq_cat"
    node_perm="managePermissions"
    node_id=1
    node_pid=0
    title="Edit page node permissions"
}{if $CTRL}{actionIcon
    action="insertNode"
    icon="explorer/folder_into.png"
    form="0"
    node_perm="managePermissions"
    node_pid=0
    node_id=1
    target="slave1"
    position="into"
    title="Insert into this node"
}{/if}
	<input type="hidden" name="showtabs" value="1" />
	{include file="ch.iframe.snode.faq/admin/hiddenValues.tpl"}
{yoffset}
</form>