<form method="POST" name="edit_perms">
<input type="hidden" name="x{$BASEID}_lang" value="{$ACTIVE_LANG}" />
 {include file="includes/lang_selector_simple.tpl"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" colspan="2">{"Page permissions (for this node)"|translate}</td>
  </tr>
  <tr>
   <td class="left">{"Edit permissions for"|translate}</td>
   {if $PERM_MODE == 'user'}
   <td class="right">{"User"|translate}: {$ACTIVE_PERM_ID}</td>
   {/if}
   {if $PERM_MODE == 'group'}
   <td class="right">{"Group"|translate}: {$ACTIVE_PERM_ID}</td>
   {/if}
   {if $PERM_MODE == 'role'}
   <td class="right">{"Role"|translate}: {$ACTIVE_PERM_ID}</td>
   {/if}
  </tr>
  {if !$NO_SELECTION}
  {foreach from=$PERMS key=KEY item=PERM}
  {if !in_array($KEY, $NOT_PERMS)}
  <tr>
   <td class="left">{$PERM.description}</td>
   <td class="right">
    {if $RIGHTS[$KEY] == 1}
     <input type="hidden" name="x{$BASEID}_perms[{$PERM.id}]" value="1">
     <img style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/check.png" alt="" onclick="switchPerm(this, 'x{$BASEID}_perms[{$PERM.id}]');" />
    {else}
     <input type="hidden" name="x{$BASEID}_perms[{$PERM.id}]" value="0">
     <img style="cursor: hand; cursor: pointer;" src="{$XT_IMAGES}icons/forbidden.png" alt="" onclick="switchPerm(this, 'x{$BASEID}_perms[{$PERM.id}]');" />
    {/if}
   </td>
  </tr>
  {/if}
  {/foreach}
  {/if}
 </table>
 <input type="hidden" name="x{$BASEID}_perm_id" value="{$ACTIVE_PERM_ID}">
<br />
<table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td>
    <input type="hidden" name="x{$BASEID}_action" value="savePagePermissions">
    {foreach from=$BUTTONS item=BUTTON}
    <input type="submit" value="{$BUTTON.label}" name="submit_{$BUTTON.action}" class="{$BUTTON.class}" onclick="document.forms['edit_perms'].x{$BASEID}_action.value='{$BUTTON.action}'">&nbsp;
    {/foreach}
   </td>
  </tr>
 </table>
<br />
</form>
<table cellspacing="0" cellpadding="0">
 <tr style="cursor: hand; cursor: pointer;">
  <td onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-9) != 'perm_mode'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_perm_mode=user'" class="lang_tab{if $PERM_MODE == 'user'}_active{/if}"><img src="{$XT_IMAGES}icons/user1.png" alt="{'Users'|translate}" title="{'Users'|translate}" /></td>
  <td onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-9) != 'perm_mode'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_perm_mode=user'" class="lang_tab{if $PERM_MODE == 'user'}_active{/if}" style="text-transform: none; padding-right: 10px;">{'Users'|translate}</td>

  <td onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-9) != 'perm_mode'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_perm_mode=group'" class="lang_tab{if $PERM_MODE == 'group'}_active{/if}"><img src="{$XT_IMAGES}icons/group.png" alt="{'Groups'|translate}" title="{'Groups'|translate}" /></td>
  <td onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-9) != 'perm_mode'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_perm_mode=group'" class="lang_tab{if $PERM_MODE == 'group'}_active{/if}" style="text-transform: none; padding-right: 10px;">{'Groups'|translate}</td>

  <td onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-9) != 'perm_mode'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_perm_mode=role'" class="lang_tab{if $PERM_MODE == 'role'}_active{/if}"><img src="{$XT_IMAGES}icons/worker.png" alt="{'Roles'|translate}" title="{'Roles'|translate}" /></td>
  <td onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-9) != 'perm_mode'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_perm_mode=role'" class="lang_tab{if $PERM_MODE == 'role'}_active{/if}" style="text-transform: none; padding-right: 10px;">{'Roles'|translate}</td>
 </tr>
</table>
<form method="POST" name="usertable">
 {include file="includes/charfilter.tpl" form="edit_perms"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="100">{"Name"|translate}</td>
   <td class="table_header">{"Description"|translate}</td>
  </tr>
  {foreach from=$USERS item=USER name=USERTABLE}
      <tr class="{cycle values="row_a,row_b"}" {if $ACTIVE_PERM_ID == $USER.id}style="background-color: #6E8297;"{/if}>
       <td class="button">
       {if "managePagePermissions"|allowed}<a href="javascript:ask('{'Are you sure to remove this users permissions?'|translate}','{$INDEX_PHP}?TPL={$TPL}&x{$BASEID}_action=removePagePermission&x{$BASEID}_perm_id={$USER.id}');"><img src="images/icons/delete.png" alt="{'Delete this permission'|translate}" title="{'Delete this permissions'|translate}" /></a>{else}{$ICONSPACER}{/if}<br />
       </td>
       <td class="row" {if $ACTIVE_PERM_ID == $USER.id}style="color: white;"{/if}>{$USER.id}&nbsp;</td>
       <td class="row" {if $ACTIVE_PERM_ID == $USER.id}style="color: white;"{/if}>{if $ACTIVE_PERM_ID != $USER.id}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&module={$smarty.get.module}&x{$BASEID}_perm_mode={$PERM_MODE}&x{$BASEID}_perm_id={$USER.id}">{/if}{$USER.title}{if $ACTIVE_PERM_ID != $USER.id}</a>{/if}&nbsp;</td>
       <td class="row" {if $ACTIVE_PERM_ID == $USER.id}style="color: white;"{/if}>{$USER.description}&nbsp;</td>
      </tr>
      {if $ACTIVE_PERM_ID == $USER.id}
      {assign var="ACTIVE_TITLE" value=$USER.title}
      {/if}
  {/foreach}
 </table>
 <br />
 {include file="includes/navigator.tpl" form="edit_perms"}
</form>
<form method="POST" name="addperms">
<input type="hidden" name="x{$BASEID}_action" value="" />
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Add permissions"|translate}</td>
 </tr>
 {if $PERM_MODE == 'user'}
 <tr>
  <td class="left">{"Username"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_username">&nbsp;<input type="submit" class="button" value="Add user permissions" onclick="document.forms['addperms'].x{$BASEID}_action.value='addUserPermission'"></td>
 </tr>
 {/if}
 {if $PERM_MODE == 'group'}
 <tr>
  <td class="left">{"Group"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_group_title">&nbsp;<input type="submit" class="button" value="Add group permissions" onclick="document.forms['addperms'].x{$BASEID}_action.value='addGroupPermission'"></td>
 </tr>
 {/if}
 {if $PERM_MODE == 'role'}
 <tr>
  <td class="left">{"Role"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_role_title">&nbsp;<input type="submit" class="button" value="Add role permissions" onclick="document.forms['addperms'].x{$BASEID}_action.value='addRolePermission'"></td>
 </tr>
 {/if}
</table>
</form>