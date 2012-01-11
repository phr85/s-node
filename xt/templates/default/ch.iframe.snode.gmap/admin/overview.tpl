<form method="post" name="overview" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
{include file="ch.iframe.snode.gmap/admin/hiddenValues.tpl"}
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="25">ID</td>
  <td class="table_header">{"Title"|translate}</td>
 </tr>
 {foreach from=$GMAPS item=GMAP}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{
  actionIcon
      action="editGmap"
      form="0"
      target="slave1"
      icon="pencil.png"
      title="Edit this Google Map"
      id=$GMAP.id
      gmapheader="true"
  }
  {if $GMAP.active == 1
      }{actionIcon
            action="deactivateGmap"
            icon="active.png"
            form="overview"
            id=$GMAP.id
            title="Deactivate this Google Map"
  }{else
      }{actionIcon 
            action="activateGmap"
            icon="inactive.png"
            form="overview"
            id=$GMAP.id
            title="Activate this Google Map"
  }{/if}{
  actionIcon
      action="deleteGmap"
      form="overview"
      icon="delete.png"
      id=$GMAP.id
      title="Delete this Google Map"
      ask="Are you sure you want to delete this Google Map?"
  }</td>
  <td class="row">{$GMAP.id}</td>
  <td class="row">{
  actionLink
      action="editGmap"
      form="0"
      target="slave1"
      id=$GMAP.id
      title=$GMAP.title
      text=$GMAP.title
      gmapheader="true"
  }&nbsp;</td>
 </tr>
 {/foreach}
</table>
</form>
