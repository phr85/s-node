<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="promo">
{include file="includes/buttons.tpl" data=$promo_BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="promo"}
{include file="includes/charfilter.tpl" form="promo"}
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
             action         = "editpromo"
             icon           = "pencil.png"
             form           = "0"
             perm           = "manage_promo"
             title          = "edit promo"
             target         = "slave1"
             id    = $ENTRY.id
        }{actionIcon
             action         = "deletepromo"
             icon           = "delete.png"
             form           = "promo"
             perm           = "manage_taxes"
             ask            = "Are you sure to delete this value?"
             title          = "delete promo"
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
 {include file="includes/navigator.tpl" form="promo"}
{yoffset}
</form>
