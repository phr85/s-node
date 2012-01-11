<form method="POST" name="map">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 {include file="includes/lang_selector_simple.tpl" form="map"}
 <table cellspacing="0" cellpadding="0" width="100%">
  {if $KEYNOTFOUND}
  <tr>
   <td class="error_msg" colspan="4">{"No Key Added Yet"|translate}</td>
  </tr>
  {/if}
  <tr>
   <td class="table_header" width="80">&nbsp;</td>
   <td class="table_header" width="100">{actionIcon action="NULL" form=map label="Date" sort=$sort.0.value icon=$sort.0.icon}</td>
   <td class="table_header" width="40">{actionIcon action="NULL" label="ID" form=map sort=$sort.1.value icon=$sort.1.icon}</td>
   <td class="table_header">{actionIcon action="NULL" form=map label="Title" sort=$sort.2.value icon=$sort.2.icon}</td>
  </tr>
  {foreach from=$DATA item=MAP name=MAPTABLE}
  <tr class="{cycle values="row_a,row_b"}" {if $MAP.locked_user == $USER_ID}style="background-image: url({$XT_IMAGES}admin/gfx/naventry_active.gif);"{/if}>
   <td class="button">{if $MAP.locked != 1 || $MAP.locked_user == $USER_ID}{if $MAP.active
   }{actionIcon 
        action="deactivateMap"
        icon="active.png"
        form="map"
        perm="statuschange"
        id=$MAP.id
        title="Deactivate this map"
   }{else
   }{actionIcon 
        action="activateMap"
        icon="inactive.png"
        form="map"
        perm="statuschange"
        id=$MAP.id
        title="Activate this map"
   }{/if
   }{actionIcon 
        action="editMap"
        icon="pencil.png"
        form="0"
        target="slave1"
        id=$MAP.id
        perm="edit"
        title="Edit this map"
   }{actionIcon 
        action="deleteMap"
        icon="delete.png"
        form="map"
        id=$MAP.id
        perm="delete"
        title="Delete this map"
        ask="Are you sure you want to delete this map?"
   }{else}{"In edit"|translate}{/if}</td>
   <td class="row">{$MAP.c_date|date_format:"%d.%m.%Y %H:%I"}</td>
    <td class="row">{$MAP.id}</td>
   <td class="row">{
   actionLink
       action="editMap"
       form="0"
       target="slave1"
       perm="view"
       id=$MAP.id
       text=$MAP.title|truncate:40:"...":true
   }&nbsp;</td>
  </tr>
  {/foreach}
 </table>
 <input type="hidden" name="map" value="">
 {include file="includes/navigator.tpl" form="map"}
 <input type="hidden" name="x{$BASEID}_id" value="">
 <input type="hidden" name="x{$BASEID}_sort" value="" />
 <input type="hidden" name="module" value="">
</form>