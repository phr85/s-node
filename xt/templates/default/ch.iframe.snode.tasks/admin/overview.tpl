<form method="POST" name="tasks">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
{include file="includes/charfilter.tpl" form="tasks"}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="20" colspan="2" style="padding: 0px; padding-left: 6px;"><input type="checkbox" name="x{$BASEID}_checkall"></td>
  <td class="table_header" width="250">{"Title"|translate}</td>
  <td class="table_header" width="16">{"Completed"|translate}</td>
  <td class="table_header" width="150">{"Project"|translate}</td>
  <td class="table_header">{"Must be completed in"|translate}</td>
 </tr>
 {foreach from=$OPEN_TASKS item=TASK}
  <tr class="{cycle values=row_a,row_b}">
   <td class="button">{
   actionIcon
       action="view"
       perm="view"
       icon="view.png"
       title="Read this task"
       id=$TASK.id
       form="tasks"
   }</td>
   <td class="row" style="padding: 3px; padding-left: 6px;"><input type="checkbox" name="x{$BASEID}_task[{$TASK.id}]"></td>
   <td class="row" align="center"><img src="{$XT_IMAGES}icons/priority_{$TASK.priority}.gif" alt="{$TASK.priority}" /></td>
   <td class="row">{$TASK.title|truncate:45:"...":true}</td>
   <td class="row" style="padding: 3px; padding-left: 6px;"><input type="x{$BASEID}_percent[{$TASK.id}]" value="{$TASK.percent}" size=2 maxlength=3> %</td>
   <td class="row">{$TASK.project}</td>
   <td class="row">{$TASK.time_to_end}</td>
  </tr>
 {/foreach}
</table>
{include file="includes/navigator.tpl" form="tasks"}
<input type="hidden" name="x{$BASEID}_id" />
</form>