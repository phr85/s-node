<form method="POST" name="overview">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 {include file="includes/charfilter.tpl" form="overview"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="20">&nbsp;</td>
   <td class="table_header" width="150">{"City"|translate}</td>
   <td class="table_header">{"Description"|translate}</td>
  </tr>
  {foreach from=$DATA item=LOCATION name=LOCATIONTABLE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">{
       actionIcon
           action="edit"
           icon="pencil.png"
           form="0"
           target="slave1"
           location_id=$LOCATION.id
           title="Edit location"
       }{
       actionIcon
           action="delete"
           icon="delete.png"
           form="1"
           target="master"
           location_id=$LOCATION.id
           title="Delete location"
           ask="Are you sure you want to delete this location?"
       }</td>
       <td class="button" align="center"><img src="{$XT_IMAGES}lang/{$LOCATION.country}.png" alt="{$LOCATION.country}" /></td>
       <td class="row">{$LOCATION.cityCode} {$LOCATION.city}&nbsp;</td>
       <td class="row">{$LOCATION.title}&nbsp;</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="overview"}
 <input type="hidden" name="x{$BASEID}_location_id" />
</form>
