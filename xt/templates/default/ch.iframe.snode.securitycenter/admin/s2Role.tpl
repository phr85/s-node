<form method="POST" name="users">
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header_small">
<span class="title">{"Users in role"|translate} "{$ROLE.title}"</span>
  </td>
 </tr>
</table>

 {include file="includes/charfilter.tpl" form="users"}

<table cellspacing="0" cellpadding="0" width="100%">
  {foreach from=$DATA item=USER}
  <tr class="{cycle values="row_a,row_b"}" colspan="2">
   <td>
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="row" style="padding-left: 5px; width: 1px;padding-right: 0px;"><img src="{$XT_IMAGES}icons/user1.png" width="16" /></td>
      <td class="row">{actionLink
      action= "clickOnUser"
      target="slave1"
      form="0"
      yoffset=1
      text=$USER.username
      title= $USER.id
      principal_id=$USER.id
      } {if $USER.lastName || $USER.firstName}({$USER.firstName}{if $USER.lastName} {$USER.lastName}{/if}){/if}</td>
     <td class="row" align="right">{actionIcon
                action="s1EditUser"
                icon="pencil.png"
                form="0"
                target="slave1"
                user_id = $USER.id
                principal_id=$USER.id
                title="Edit this user"
          }{actionIcon
                action="s2RemoveUserFromRole"
                icon="delete.png"
                form="users"
                node_id=$NODE
                user_id = $USER.id
                perm="user"
                title="remove this user"
                yoffset = 1
          }
     </td>
      </tr>
    </table>
   </td>
  </tr>
  {/foreach}
</table>
{include file="includes/navigator.tpl" form="users"}
</form>