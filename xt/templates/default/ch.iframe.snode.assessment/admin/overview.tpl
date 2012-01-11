{include file="includes/buttons.tpl" data=$BUTTONS}
<form method="POST" name="overview">
<table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="81">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header">{"Display name"|translate}</td>
  </tr>
  {foreach from=$xt8200_admin.data item=ASSESSMENT name=TABLE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if "edit"|allowed}
       {if $ASSESSMENT.active == 1}{
       actionIcon
           action="deactivateAssessment"
           form="overview"
           icon="active.png"
           title="deactivate this assessment"
           perm="edit"
           id=$ASSESSMENT.id
       }{else}{
       actionIcon
           action="activateAssessment"
           form="overview"
           icon="inactive.png"
           title="activate this assessment"
           perm="edit"
           id=$ASSESSMENT.id
       }{/if}{
       actionIcon
           action="editAssessment"
           icon="pencil.png"
           form="0"
           target="slave1"
           perm="edit"
           id = $ASSESSMENT.id
           title="Edit this assessment"
       }
       {/if}
       {if "delete"|allowed}
       {if $ASSESSMENT.active == 0}{
       actionIcon
           action="deleteAssessment"
           icon="delete.png"
           title="Delete this assessment"
           perm="edit"
           id=$ASSESSMENT.id
           ask="Are you sure to delete this assessment?"
           form="overview"
       }{/if}
       {/if}</td>
       <td class="row">{$ASSESSMENT.id}&nbsp;</td>
       <td class="row">
 		{$ASSESSMENT.title}
		</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="overview"}
 <input type="hidden" name="x{$BASEID}_id" value="" />
 <input type="hidden" name="x{$BASEID}_action" value="" />
</form>