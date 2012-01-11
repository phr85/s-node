 {include file="includes/buttons.tpl" data=$BUTTONS}
<form method="POST" name="usertable">
 {include file="includes/charfilter.tpl" form="usertable"}
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="81">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header">{"Username"|translate}</td>
   <td class="table_header" width="100">{"Last name"|translate}</td>
   <td class="table_header" width="100">{"First name"|translate}</td>
  </tr>
  {foreach from=$DATA item=USER name=USERTABLE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">{if $USER.active == 1}{
       actionIcon
           action="deactivateUser"
           form="usertable"
           icon="active.png"
           title="deactivate this user"
           perm="user"
           id=$USER.id
           yoffset=1
       }{else}{
       actionIcon
           action="activateUser"
           form="usertable"
           icon="inactive.png"
           title="Activate this user"
           perm="user"
           id=$USER.id
           yoffset=1
       }{/if}{
       actionIcon
           action="clickOnUser"
           form="0"
           target="slave1"
           icon="view.png"
           title="View this user"
           perm="user"
           user_id = $USER.id
           principal_id=$USER.id
       }{
       actionIcon 
           action="s1EditUser"
           icon="pencil.png"
           form="0"
           target="slave1"
           user_id = $USER.id
           principal_id=$USER.id
           title="Edit this user"
       }{if $USER.active == 0}{
       actionIcon
           action="deleteUser"
           icon="delete.png"
           title="Delete this user"
           perm="user"
           id=$USER.id
           ask="Are you sure to delete this user?"
           form="usertable"
           yoffset=1
       }{/if}</td>
       <td class="row">{$USER.id}&nbsp;</td>
       <td class="row">{$USER.username}&nbsp;</td>
       <td class="row">{$USER.lastName}&nbsp;</td>
       <td class="row">{$USER.firstName}&nbsp;</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="usertable"}
</form>