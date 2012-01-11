<form method="POST" name="overview">
{include file="includes/buttons.tpl" data=$MANAGE_BUTTONS}
{include file="includes/charfilter.tpl" form="overview"}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="200">{"Title"|translate}</td>
  <td class="table_header" width="250">{"Description"|translate}</td>
  <td class="table_header">{"Expected total work time"|translate}</td>
 </tr>
 {foreach from=$WORKFLOWS item=WORKFLOW}
  <tr class="{cycle values=row_a,row_b}">
   <td class="button">{
   actionIcon
        action="view"
        icon="view.png"
        id=$WORKFLOW.id
        title="View information about this workflow"
        perm="view"
        form="overview"
   }{
   actionIcon
        action="editWorkflow"
        icon="pencil.png"
        id=$WORKFLOW.id
        title="Edit this workflow"
        perm="edit"
        form="overview"
   }</td>
   <td class="row">{$WORKFLOW.title}&nbsp;</td>
   <td class="row">{$WORKFLOW.description|truncate:50:"...":true}</td>
   <td class="row">{$WORKFLOW.average_time}</td>
  </tr>
 {/foreach}
</table>
{include file="includes/navigator.tpl" form="overview"}
<input type="hidden" name="x{$BASEID}_id" value="">
</form>
