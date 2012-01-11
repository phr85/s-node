<form method="post" name="scripts">
{include file="includes/buttons.tpl" data=$BUTTONS}
{include file="includes/charfilter.tpl" form="scripts"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="45">{actionIcon action="NULL" label="ID" form=scripts sort=$sort.0.value icon=$sort.0.icon}</td>
   <td class="table_header">{actionIcon action="NULL" form=scripts label="Title" sort=$sort.1.value icon=$sort.1.icon}</td>
   <td class="table_header" width="30">&nbsp;</td>
  </tr>
  {foreach from=$SCRIPTS item=SCRIPT}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">{
       actionIcon
            action="editScript"
            icon="pencil.png"
            form="0"
            target="slave1"
            script_id=$SCRIPT.id
            title="Edit this script"
       }{
       actionIcon
            action="deleteScript"
            icon="delete.png"
            form="scripts"
            script_id=$SCRIPT.id
            title="Delete this script"
            ask="Are you sure you want to delete this script?"
       }</td>
       <td class="row">{$SCRIPT.id}&nbsp;</td>
       <td class="row">{
       actionLink
           action="editScript"
           form="0"
           target="slave1"
           script_id=$SCRIPT.id
           text=$SCRIPT.title|truncate:40:"...":true
       }&nbsp;</td>
       <td class="button" align="right">{
       actionIcon
            action="duplicateScript"
            icon="copy.png"
            form="scripts"
            script_id=$SCRIPT.id
            title="Duplicate this script"
       }</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="scripts"}
 <input type="hidden" name="x{$BASEID}_script_id" value="" />
 <input type="hidden" name="x{$BASEID}_sort" value="">
 <input type="hidden" name="module" value="s" />
</form>