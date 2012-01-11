<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}&module={$ADMINMODULE}" method="POST" name="units">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="units"}
{include file="includes/charfilter.tpl" form="units"}
<input type="hidden" name="x{$BASEID}_id" value="" />
<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td class="table_header" width="80">{"Options"|translate}</td>
       <td class="table_header" width="20">ID</td>
       <td class="table_header" width="60">{"Default"|translate}</td>
       <td class="table_header" width="120">{"short"|translate}</td>
       <td class="table_header">{"Description"|translate}</td>
      </tr>

      {foreach from=$DATA item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">{actionIcon
             action         = "editUnit"
             icon           = "pencil.png"
             form           = "0"
             perm           = "edit"
             title          = "Edit taxes"
             target         = "slave1"
             id    = $ENTRY.id
        }{actionIcon
             action         = "delete"
             icon           = "delete.png"
             form           = "units"
             perm           = "delete"
             yoffset        = 1
             ask            = "Do you want to delete this unit"
             title          = "Delete unit"
             id    = $ENTRY.id
        }</td>
       <td class="row">
       {$ENTRY.id}
       </td>
       <td class="row">
       {$ENTRY.standard}
       </td>
       <td class="row">
       {$ENTRY.short|default:"?"}
       </td>
       <td class="row">
       {$ENTRY.full|default:"?"}
       </td>
      </tr>
     {/foreach}
    </table>
 {include file="includes/navigator.tpl" form="units"}
 {yoffset}
</form>
