<form method="post" name="navigation" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" onSubmit="window.document.forms['navigation'].x{$BASEID}_yoffset.value=window.pageYOffset;">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS yoffset=true}
<input type="hidden" name="x{$BASEID}_lang_filter" value="{$ACTIVE_LANG}" />
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$NODES item=NODE}
  {if $NODE.allowed.view == 1}
  <tr class="{cycle values="row_a,row_b"}">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">{if $NODE.subs > 0}{if $NODE.itw}<a href="javascript:document.forms['navigation'].x{$BASEID}_open.value={$NODE.pid};document.forms['navigation'].submit();"><img src="{$XT_IMAGES}icons/minus.gif" alt="" /></a>{else}<a href="javascript:document.forms['navigation'].x{$BASEID}_open.value={$NODE.id};document.forms['navigation'].submit();"><img src="{$XT_IMAGES}icons/plus.gif" alt="" /></a>{/if}{else}<img src="{$XT_IMAGES}spacer.gif" width="9" height="9" alt="" />{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:document.forms['navigation'].x{$BASEID}_open.value={$NODE.id};document.forms['navigation'].submit();">{if $NODE.itw}{if $NODE.subs > 0}{if $NODE.level == 2}<img src="{$XT_IMAGES}icons/data.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}{else}<img src="{$XT_IMAGES}icons/document.png" alt="" />{/if}{else}{if $NODE.subs > 0}{if $NODE.level == 2}<img src="{$XT_IMAGES}icons/data.png" alt="" />{else}<img src="{$XT_IMAGES}icons/folder_document.png" alt="" />{/if}{else}<img src="{$XT_IMAGES}icons/document.png" alt="" />{/if}{/if}</a><br />
      </td>
      <td class="row">{if !$NODE.lang_na}{if $NODE.subs > 0}<a href="#" onClick="javascript:document.forms['navigation'].x{$BASEID}_yoffset.value=window.pageYOffset;document.forms['navigation'].x{$BASEID}_open.value={$NODE.id};document.forms['navigation'].submit();">{/if}{/if}{if $NODE.itw}<span style="color: black;">{if $NODE.selected}<b>{$NODE.id}: {$NODE.title}</b>{if $NODE.subs > 0}&nbsp;({$NODE.subs}){/if}{else}{$NODE.id}: {$NODE.title}{if $NODE.subs > 0}&nbsp;({$NODE.subs}){/if}{/if}</span>{else}{$NODE.id}: {$NODE.title}{if $NODE.subs > 0}&nbsp;({$NODE.subs}){/if}{/if}{if !$NODE.lang_na}{if $NODE.subs > 0}</a>{/if}{/if}</td>
      <td class="button" align="right">
      {if $NODE.id > 1}{if $CTRL
          }{actionIcon

                action="insertNode"
                icon="explorer/arrow_down_green.png"
                node_perm="addPages"
                node_pid=$NODE.pid
                node_id=$NODE.id
                position="after"
                form=$CTRL_FORM
                target=$CTRL_TARGET
                target_module="e"
                title="Insert after this node"

          }{actionIcon

                action="insertNode"
                icon="explorer/arrow_up_green.png"
                form=$CTRL_FORM
                target=$CTRL_TARGET
                node_perm="addPages"
                node_pid=$NODE.pid
                node_id=$NODE.id
                position="before"
                target_module="e"
                title="Insert before this node"

          }{actionIcon

                action="insertNode"
                icon="explorer/folder_into.png"
                form=$CTRL_FORM
                target=$CTRL_TARGET
                node_perm="addPages"
                node_pid=$NODE.pid
                node_id=$NODE.id
                position="into"
                target_module="e"
                title="Insert into this node"

      }{else
          }{if $NODE.active == 1
              }{actionIcon

                    action="deactivateLang"
                    icon="active.png"
                    form="0"
                    node_perm="changeStatus"
                    node_pid=$NODE.pid
                    id=$NODE.id
                    node_id=$NODE.id
                    target="slave1"
                    title="Deactivate this page in this language"
                    yoffset="1"

          }{else
              }{actionIcon

                    action="activateLang"
                    icon="inactive.png"
                    form="0"
                    node_perm="changeStatus"
                    node_pid=$NODE.pid
                    id=$NODE.id
                    node_id=$NODE.id
                    target="slave1"
                    title="Activate this page in this language"
                    yoffset="1"

          }{/if
          }{if !$NODE.lang_na}<a href="#" onclick="window.open('{$smarty.server.PHP_SELF}?TPL={$NODE.id}&amp;tmp_lang={$ACTIVE_LANG}','Preview');"><img src="{$XT_IMAGES}icons/view.png" alt="{'Preview this page'|translate}" title="{'Preview this page'|translate}" style="padding-right: 4px;"
          /></a>{else}{$ICONSPACER}{/if}{actionIcon

                action="editPage"
                icon="pencil.png"
                form="0"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="editPages"
                target="slave1"
                title="Edit this page"
                target_tpl=$TPL

          }
          {if $NODE.id != 10000}
          {actionIcon
				action="cutNode"
                icon="cut.png"
                form="navigation"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="deletePages"
                title="Cut this page node"}
          {actionIcon
				action="copyNode"
                icon="copy.png"
                form="navigation"
                source_node_id=$NODE.id
                title="Copy this page node"}
          {/if}
          {actionIcon
				action="editNodePerms"
                icon="lock.png"
                form="navigation"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="manageNodePermissions"
                title="Edit page node permissions"

          }
 		  {* remove this statement to delete nodes in the system *}
          {if $NODE.pid != 106 AND $nodel != "1" AND $NODE.id != 10000}
          {actionIcon
                action="deleteNode"
                icon="delete.png"
                form="navigation"
                node_id=$NODE.id
                node_pid=$NODE.pid
                node_perm="deletePages"
                title="Delete this page node"
                ask="Are you sure you want to delete this node?"
                yoffset="1"

          }
          {else}
          {assign var="nodel" value="1"}
          {/if}
      {/if}{else}{$ICONSPACER}{/if}
      </td>
     </tr>
    </table>
   </td>
  </tr>
  {/if}
 {/foreach}
</table>
{actionIcon
    action="editNodePerms"
    icon="lock.png"
    form="navigation"
    node_perm="manageNodePermissions"
    node_id=1
    node_pid=0
    title="Edit page node permissions"
}{if $CTRL}{actionIcon
    action="insertNode"
    icon="explorer/folder_into.png"
    form=$CTRL_FORM
    target=$CTRL_TARGET
    node_perm="manageNodePermissions"
    node_pid=0
    node_id=1
    position="into"
    title="Insert into this node"

}
{/if}
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_open" value="" />
<input type="hidden" name="x{$BASEID}_target_module" value="" />
<input type="hidden" name="x{$BASEID}_source_node_id" value="" />
<input type="hidden" name="module" value="oa" />
{yoffset}
</form>
</td>
</tr>
</table>
