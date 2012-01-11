<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="discounts">
{include file="includes/buttons.tpl" data=$DISCOUNTS_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="discounts"}
{include file="includes/charfilter.tpl" form="discounts"}
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}" />
<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td class="table_header" width="80">{"Options"|translate}</td>
       <td class="table_header" width="20">ID</td>
       <td class="table_header">{"Title"|translate}</td>
       <td class="table_header" width="80">{"Discount in %"|translate}</td>
       <td class="table_header" width="60">{"give discount at"|translate}</td>
      </tr>

      {foreach from=$DATA item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">{actionIcon
             action         = "editDiscounts"
             icon           = "pencil.png"
             form           = "0"
             perm           = "manage_discounts"
             title          = "edit discounts"
             target         = "slave1"
             id    = $ENTRY.id
        }{actionIcon
             action         = "deleteDiscounts"
             icon           = "delete.png"
             form           = "discounts"
             perm           = "manage_taxes"
             ask            = "Are you sure to delete this value?"
             title          = "delete discounts"
             yoffset        = 1
             id    = $ENTRY.id
        }</td>
       <td class="row">{$ENTRY.id}</td>
       <td class="row">{$ENTRY.name|default:"<br />"}</td>
       <td class="row">{$ENTRY.value}</td>
       <td class="row">{$ENTRY.give_discount_at}</td>
      </tr>
     {/foreach}
    </table>
 {include file="includes/navigator.tpl" form="discounts"}
{yoffset}
</form>
