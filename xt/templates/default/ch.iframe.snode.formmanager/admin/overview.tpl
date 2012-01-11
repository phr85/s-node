<form method="post" name="formstable" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
 {include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
{include file="includes/charfilter.tpl" form="formstable"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="45">{actionIcon action="NULL" label="ID" form=formstable sort=$sort.0.value icon=$sort.0.icon}</td>
   <td class="table_header">{actionIcon action="NULL" form=formstable label="Title" sort=$sort.1.value icon=$sort.1.icon}</td>
   <td class="table_header" width="60">&nbsp;</td>
  </tr>
  {foreach from=$DATA item=FORM}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">{if $FORM.active == 0}{
       actionIcon
           action="activate"
           icon="inactive.png"
           form="formstable"
           form_id=$FORM.id
           title="Activate this form"
       }{else}{
       actionIcon
           action="deactivate"
           icon="active.png"
           form="formstable"
           form_id=$FORM.id
           title="Deactivate this form"
       }{/if}<a href="{$smarty.server.PHP_SELF}?TPL={$VIEWER_TPL}&amp;x{$BASEID}_form_id={$FORM.id}" target="_blank"><img class="icon" src="{$XT_IMAGES}icons/view.png" alt="{'Preview this form'|translate}" title="{'Preview this form'|translate}" /></a
       >{
       actionIcon
           action="editForm"
           icon="pencil.png"
           form="0"
           target="slave1"
           form_id=$FORM.id
           title="Edit this form"
       }{
       actionIcon
           action="deleteForm"
           icon="delete.png"
           form="formstable"
           form_id=$FORM.id
           title="Delete this form"
           ask="Are you sure you want to delete this form?"
       }</td>
       <td class="row">{$FORM.id}&nbsp;</td>
       <td class="row">{
       actionLink
           action="editForm"
           form="0"
           target="slave1"
           form_id=$FORM.id
           text=$FORM.title|truncate:40:"...":true
       }&nbsp;</td>
       <td class="button" align="right">{
       actionIcon
           action="copyForm"
           icon="copy.png"
           form="formstable"
           form_id=$FORM.id
           title="Copy this form"
       }
       {
       actionIcon
           action="exportForm"
           icon="download.png"
           form="0"
           form_id=$FORM.id
           title="Export this form"
           target="slave1"
       }
       </td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="formstable"}
 <input type="hidden" name="x{$BASEID}_form_id" value="" />
 <input type="hidden" name="x{$BASEID}_sort" value="" />
</form>