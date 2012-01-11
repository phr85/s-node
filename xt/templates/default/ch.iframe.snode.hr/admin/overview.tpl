<form method="POST" name="overview">
 {include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
 {include file="includes/charfilter.tpl" form="overview"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="170">{"Title"|translate}</td>
   <td class="table_header">{"E-Mail"|translate}</td>
  </tr>
  {foreach from=$DATA item=HR name=HRTABLE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">{if $HR.active == 1}{
       actionIcon
           action="deactivate"
           form="overview"
           icon="active.png"
           title="Deactivate this employee"
           perm="statuschange"
           id=$HR.id
       }{else}{
       actionIcon
           action="activate"
           form="overview"
           icon="inactive.png"
           title="Activate this employee"
           perm="statuschange"
           id=$HR.id
       }{/if}{
       actionIcon
           action="editEmployee"
           form="0"
           target="slave1"
           icon="pencil.png"
           title="Edit this employee"
           perm="edit"
           id=$HR.id
       }{if $HR.active == 0}{
       actionIcon
           action="deleteEmployee"
           icon="delete.png"
           title="Delete this employee"
           perm="delete"
           id=$HR.id
           ask="Are you sure to delete this employee?"
           form="overview"
       }{/if}</td>
       <td class="row">{$HR.lastName|truncate:30:"...":true} {$HR.firstName}&nbsp;</td>
       <td class="row"><a href="mailto:{$HR.email}">{$HR.email}</a>&nbsp;</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="overview"}
 <input type="hidden" name="x{$BASEID}_id">
</form>
