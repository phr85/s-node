 {include file="includes/buttons.tpl" data=$BUTTONS}
<form method="POST" name="roletable">
 {include file="includes/charfilter.tpl" form="roletable"}
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header">{"Title"|translate}</td>
   <td class="table_header" width="100">{"Description"|translate}</td>
  </tr>
  {foreach from=$DATA item=ROLE name=ROLESTABLE}
      <tr class="{cycle values="row_a,row_b"}">
      
       <td class="button">{if $ROLE.active == 1}{
       actionIcon
           action="deactivateRole"
           form="roletable"
           icon="active.png"
           title="deactivate this role"
           id=$ROLE.id
           yoffset=1
       }{else}{
       actionIcon
           action="activateRole"
           form="roletable"
           icon="inactive.png"
           title="Activate this role"
           id=$ROLE.id
           yoffset=1
       }{/if}{
       actionIcon
           action="clickOnRole"
           form="roletable"
           
           icon="view.png"
           title="View this role"
           role_id = $ROLE.id
           principal_id=$ROLE.id
       }{actionIcon 
                action="s1editRole"
                icon="pencil.png"
                form="0"
                target="slave1"
                role_id=$ROLE.id
                title="Edit this role"
          }{if $ROLE.active == 0}{
       actionIcon
           action="deleteRole"
           icon="delete.png"
           title="Delete this role"
           id=$ROLE.id
           ask="Are you sure to delete this role?"
           form="roletable"
           yoffset=1
       }{/if}</td> 
       <td class="row">{$ROLE.id}&nbsp;</td>
       <td class="row">{$ROLE.title}&nbsp;</td>
       <td class="row">{$ROLE.description}&nbsp;</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="roletable"}
</form>