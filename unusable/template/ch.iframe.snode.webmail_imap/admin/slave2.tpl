<form method="POST" name="tree">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="o"}
<select name="x{$BASEID}_account">
{foreach from=$ACCOUNTS item=ACCOUNT}
    <option value="{$ACCOUNT.id}" onclick="document.forms[0].submit();">{$ACCOUNT.mail_adress}</option>
{/foreach}
</select>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" colspan="3">{"Folder structure"|translate}</td>
 </tr>
 {foreach from=$NODES item=NODE}
  <tr class="{cycle values="row_a,row_b"}" colspan="2">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      {if $NODE.l != 1}<td class="row" style="padding-left: {$NODE.level*20-32}px; width: 1px;">
      {if $NODE.subs > 0}
          {if $NODE.itw}
              {actionIcon 
                 action="clickOnPlusMinus"
                 icon="minus.gif" 
                 form="tree" 
                 open=$NODE.pid
              }
          {else}
              {actionIcon 
                 action="clickOnPlusMinus"
                 icon="plus.gif" 
                 form="tree" 
                 open=$NODE.id
                 target="slave2"
              }
          {/if}
      {else}<img src="{$XT_IMAGES}spacer.gif" width="9">{/if}</td>{/if}
      <td class="row" style="padding: 5px; padding-right: 0px;width: 16px">
       <a href="javascript:window.parent.frames['slave2'].document.forms[0].x{$BASEID}_action.value='';window.parent.frames['slave2'].document.forms[0].x{$BASEID}_open.value={$NODE.id};window.parent.frames['slave2'].document.forms[0].submit();document.forms['o'].x{$BASEID}_open.value={$NODE.id};document.forms['o'].submit();">{if $NODE.itw}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{else}<img src="{$XT_IMAGES}icons/explorer/folder.png" alt="" />{/if}{else}{if $NODE.subs > 0}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="">{else}<img src="{$XT_IMAGES}icons/explorer/folder_closed.png" alt="">{/if}{/if}</a><br>
      </td>
<td class="row">
      {if $NODE.itw && !$NODE.selected}
          {actionLink
          action= "clickOnNode"
          form="overview"
          yoffset=1
          folder=$NODE.title
          target="master"
          text=$NODE.title
          open=$NODE.id
          style="color:black;"}
      {elseif $NODE.selected}
          {actionLink
          action= "clickOnNode"
          form="overview"
          yoffset=1
          folder=$NODE.title
          target="master"
          text=$NODE.title
          open=$NODE.id
          style="color:black; font-weight:bold"
          }
      {else}
          {actionLink
          action= "clickOnNode"
          form="overview"
          yoffset=1
          text=$NODE.title
          open=$NODE.id
          folder=$NODE.title
          target="master"
          }
      {/if}&nbsp;</a></td>
      <td class="button" align="right">
      {if $CTRL
          }{if $NODE.id != 1}{actionIcon 
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
                title="Insert before this node"
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
      }{else}&nbsp;
      {/if}
      </td>
     </tr>
    </table>
   </td>
  </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_id" value="">
<input type="hidden" name="x{$BASEID}_position" value="">
<input type="hidden" name="x{$BASEID}_node_id" value="">
<input type="hidden" name="x{$BASEID}_node_pid" value="">
<input type="hidden" name="x{$BASEID}_open" value="">
<input type="hidden" name="x{$BASEID}_source_node_id" value="">
{yoffset}
</form>

<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="folders">
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$FOLDERS item=FOLDER}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" style="width: 16px;"><a href="javascript:document.forms[0].x{$BASEID}_open.value={$FOLDER.id};document.forms[0].submit();window.parent.frames['master'].document.forms['o'].x{$BASEID}_open.value={$FOLDER.id};window.parent.frames['master'].document.forms['o'].submit();"><img src="/images/icons/explorer/folder_closed.png" alt=""></a></td>
  <td class="row" colspan="3"><a href="javascript:document.forms[0].x{$BASEID}_open.value={$FOLDER.id};document.forms[0].submit();window.parent.frames['master'].document.forms['o'].x{$BASEID}_open.value={$FOLDER.id};window.parent.frames['master'].document.forms['o'].submit();">{$FOLDER.title}</a>&nbsp;</td>
 </tr>
 {/foreach}
</table>
</form>