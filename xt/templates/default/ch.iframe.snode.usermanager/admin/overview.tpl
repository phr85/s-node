<form method="POST" name="usertable">
 {include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
 {include file="includes/charfilter.tpl" form="usertable"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header" width="100">{"Username"|translate}</td>
   <td class="table_header" width="100">{"Last name"|translate}</td>
   <td class="table_header">{"First name"|translate}</td>
  </tr>
  {foreach from=$DATA item=USER name=USERTABLE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">{if $USER.active == 1}{
       actionIcon
           action="deactivate"
           form="usertable"
           icon="active.png"
           title="Activate this user"
           perm="statuschange"
           id=$USER.id
       }{else}{
       actionIcon
           action="activate"
           form="usertable"
           icon="inactive.png"
           title="Deactivate this user"
           perm="statuschange"
           id=$USER.id
       }{/if}{
       actionIcon
           action="view"
           form="usertable"
           icon="view.png"
           title="View this user"
           perm="view"
           id=$USER.id
       }{
       actionIcon
           action="editUser"
           form="usertable"
           icon="pencil.png"
           title="Edit this user"
           perm="edit"
           id=$USER.id
       }{
       actionIcon
           action="deleteUser"
           icon="delete.png"
           title="Delete this user"
           perm="delete"
           id=$USER.id
           ask="Are you sure to delete this user?"
           form="usertable"
       }</td>
       <td class="row">{$USER.id}&nbsp;</td>
       <td class="row">{$USER.username}&nbsp;</td>
       <td class="row">{$USER.lastName}&nbsp;</td>
       <td class="row">{$USER.firstName}&nbsp;</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="usertable"}
 <input type="hidden" name="x{$BASEID}_id">
</form>