 {include file="includes/buttons.tpl" data=$BUTTONS}
<form method="POST" name="grouptable">
{include file="includes/charfilter.tpl" form="grouptable"}
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header">{"Title"|translate}</td>
   <td class="table_header" width="100">{"Description"|translate}</td>
  </tr>
  {foreach from=$DATA item=GROUP name=GROUPSTABLE}
      <tr class="{cycle values="row_a,row_b"}">
      
       <td class="button">{if $GROUP.active == 1}{
       actionIcon
           action="deactivateGroup"
           form="grouptable"
           icon="active.png"
           title="deactivate this group"
           id=$GROUP.id
           yoffset=1
       }{else}{
       actionIcon
           action="activateGroup"
           form="grouptable"
           icon="inactive.png"
           title="Activate this group"
           id=$GROUP.id
           yoffset=1
       }{/if}{
       actionIcon
           action="clickOnGroup"
           form="grouptable"
           
           icon="view.png"
           title="View this group"
           group_id = $GROUP.id
           principal_id=$GROUP.id
       }{
       actionIcon 
                action="s1EditGroup"
                icon="pencil.png"
                form="0"
                target="slave1"
                group_id = $GROUP.id
                principal_id=$GROUP.id
                title="Edit this group"
       }{if $GROUP.active == 0}{
       actionIcon
           action="deleteGroup"
           icon="delete.png"
           title="Delete this group"
           id=$GROUP.id
           ask="Are you sure to delete this group?"
           form="grouptable"
           yoffset=1
       }{/if}</td> 
       <td class="row">{$GROUP.id}&nbsp;</td>
       <td class="row">{$GROUP.title}&nbsp;</td>
       <td class="row">{$GROUP.description}&nbsp;</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="grouptable"}
</form>