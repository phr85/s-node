<form method="POST" name="overview">
 {include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
 {include file="includes/charfilter.tpl" form="overview"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="32">ID</td>
   <td class="table_header">{"Area name"|translate}</td>
   <td class="table_header" width="80">{"Sort"|translate}</td>
  </tr>
  {foreach from=$DATA item=AREA name=overview name=A}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">{
      if $CTRL
      }{actionIcon
          action="insertArea"
          icon="explorer/arrow_down_green.png"
          position="after"
          form="0"
          target="slave1"
          insert_position=$AREA.pos
      }{actionIcon
          action="insertArea"
          icon="explorer/arrow_up_green.png"
          position="before"
          form="0"
          target="slave1"
          insert_position=$AREA.pos
      }{else}{if $AREA.active == 1}{
       actionIcon
           action="deactivateArea"
           form="0"
           target="slave1"
           icon="active.png"
           title="Activate this area"
           perm="statuschange"
           id=$AREA.id
       }{else}{
       actionIcon
           action="activateArea"
           form="overview"
           icon="inactive.png"
           title="Deactivate this area"
           perm="statuschange"
           id=$AREA.id
       }{/if}{
       actionIcon
           action="view"
           form="overview"
           icon="view.png"
           title="View this area"
           perm="view"
           id=$AREA.id
       }{
       actionIcon
           action="editArea"
           form="0"
           icon="pencil.png"
           title="Edit this area"
           perm="edit"
           target="slave1"
           id=$AREA.id
       }{
       actionIcon
           action="deleteArea"
           icon="delete.png"
           title="Delete this area"
           perm="delete"
           id=$AREA.id
           ask="Are you sure to delete this area?"
           form="overview"
       }{/if}</td>
       <td class="row">{$AREA.id}&nbsp;</td>
       <td class="row">{$AREA.title}&nbsp;</td>
       <td class="button">{if !$smarty.foreach.A.first}{
       actionIcon
           action="moveArea"
           icon="explorer/arrow_up_green.png"
           title="Move this area down"
           perm="edit"
           id=$AREA.id
           form="overview"
           position="up"
           move_position=$AREA.pos
       }{else}{$ICONSPACER}{/if}{if !$smarty.foreach.A.last}{
       actionIcon
           action="moveArea"
           icon="explorer/arrow_down_green.png"
           title="Move this area up"
           perm="edit"
           id=$AREA.id
           form="overview"
           position="down"
           move_position=$AREA.pos
       }{else}{$ICONSPACER}{/if}</td>
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="overview"}
 <input type="hidden" name="x{$BASEID}_id">
 <input type="hidden" name="x{$BASEID}_position">
 <input type="hidden" name="x{$BASEID}_move_position">
 <input type="hidden" name="x{$BASEID}_insert_position">
</form>