<form method="POST" name="overview">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="200">{"Title"|translate}</td>
  <td class="table_header">{"Client"|translate}</td>
 </tr>
 {foreach from=$PROJECTS item=PROJECT}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{
  actionIcon
      action="viewProject"
      icon="view.png"
      title="View this project"
      project_id=$PROJECT.id
      target="slave1"
      form="0"
  }{
  actionIcon
      action="editProject"
      icon="pencil.png"
      title="Edit this project"
      project_id=$PROJECT.id
      form="overview"
      target="slave1"
      form="0"
  }</td>
  <td class="row">{$PROJECT.title}</td>
  <td class="row">{$PROJECT.company|truncate:20:"...":true}</td>
 </tr>
 {/foreach}
</table>
{include file="includes/navigator.tpl" form="overview"}
<input type="hidden" name="x{$BASEID}_project_id" value="" />
</form>
