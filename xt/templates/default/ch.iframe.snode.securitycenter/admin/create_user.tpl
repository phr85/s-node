<form method="POST" name="edit">
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}

<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Create new user"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left" valign="top">{"Username"|translate}</td>
  <td class="right">
    <input type="text" name="x{$BASEID}_username" value="{$xt100_admin.username}" size="25">
  </td>
 </tr>

 <tr>
  <td class="left" valign="top">{"Password"|translate}</td>
  <td class="right">
    <input type="password" name="x{$BASEID}_password" value="" size="25">
  </td>
 </tr>
 <tr>
  <td class="left" valign="top">{"Confirm password"|translate}</td>
  <td class="right">
    <input type="password" name="x{$BASEID}_password_confirm" value="" size="25">
  </td>
 </tr>
  <tr>
  <td class="left" valign="top">{"E-Mail"|translate}</td>
  <td class="right">
    <input type="text" name="x{$BASEID}_email" value="{$xt100_admin.email}" size="25">
  </td>
 </tr>
 </tr>
 <tr>
  <td class="left" valign="top">{"Add to groups"|translate}</td>
  <td class="right">
    {foreach from=$xt100_admin.groups item=group}
    	<input type="checkbox" name="x{$BASEID}_groups[]" value="{$group.id}"{if $group.selected == 1} checked{/if} /> {$group.title}<br/>
    {/foreach}
  </td>
 </tr>
 <tr>
  <td class="left" valign="top">{"Add to roles"|translate}</td>
  <td class="right">
    {foreach from=$xt100_admin.roles item=role}
    	<input type="checkbox" name="x{$BASEID}_roles[]" value="{$role.id}"{if $role.selected == 1} checked{/if} /> {$role.title}<br/>
    {/foreach}
  </td>
 </tr>
</table>
</form>
