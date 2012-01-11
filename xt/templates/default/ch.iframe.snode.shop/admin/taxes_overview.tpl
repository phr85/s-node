<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}&module={$ADMINMODULE}" method="POST" name="taxes">
{include file="includes/buttons.tpl" data=$TAXES_BUTTONS}
<input type="hidden" name="x{$BASEID}_id" value="" />
<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td class="table_header" width="80">{"Options"|translate}</td>
       <td class="table_header" width="20"><b>ID</b></td>
       <td class="table_header">{"Value"|translate}</td>
      </tr>

      {foreach from=$DATA item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">{actionIcon
             action         = "editTaxes"
             icon           = "pencil.png"
             form           = "0"
             perm           = "manage_taxes"
             title          = "edit taxes"
             target         = "slave1"
             id    = $ENTRY.id
        }{actionIcon
             action         = "deleteTaxes"
             icon           = "delete.png"
             form           = "taxes"
             perm           = "manage_taxes"
             yoffset        = 1
             ask            = "Are you sure to delete this value?"
             title          = "delete taxes"
             id    = $ENTRY.id
        }</td>
       <td class="row">
       {$ENTRY.id}
       </td>
       <td class="row">
       {$ENTRY.value}
       </td>
      </tr>
     {/foreach}
    </table>
 {include file="includes/navigator.tpl" form="taxes"}
 {yoffset}
</form>
