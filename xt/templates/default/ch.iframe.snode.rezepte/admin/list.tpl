<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="recipe">
{include file="includes/buttons.tpl" data=$LIST_BUTTONS withouthidden=1}
{include file="includes/lang_selector_simple.tpl" form="recipe"}
{include file="includes/charfilter.tpl" form="recipe"}

<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
     
   
   <td class="table_header" width="100">{actionIcon action="NULL" label="ID" form=recipe sort=$sort.0.value icon=$sort.0.icon}</td>
   <td class="table_header">{actionIcon action="NULL" form=recipe label="Title" sort=$sort.1.value icon=$sort.1.icon}</td>
   <td class="table_header" width="44">&nbsp;</td>
   <td class="table_header" width="44">{actionIcon action="NULL" form=recipe label="Act" sort=$sort.2.value icon=$sort.2.icon}</td>
   <td class="table_header" width="44">{actionIcon action="NULL" form=recipe label="Val" sort=$sort.3.value icon=$sort.3.icon}</td>


      </tr>
      {foreach from=$DATA item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}" {if $ENTRY.id==$ACTUAL_ID} style="background-color:#FFCCCC;"{/if}>
       <td class="button">
        {if $ENTRY.lang_active  == 1}
        {actionIcon
             action         = "deactivateRecipeLang"
             icon           = "active.png"
             form           = "recipe"
             perm           = "activateRecipe"
             title          = "deactivate recipe"
             nopermicon     = "active.gif"
             nopermtitle    = "recipe is active"
             yoffset        = "1"
             id             = $ENTRY.id
        }{else}{actionIcon
             action         = "activateRecipeLang"
             icon           = "inactive.png"
             form           = "recipe"
             perm           = "activateRecipe"
             title          = "activate recipe"
             nopermicon     = "inactive.gif"
             nopermtitle    = "recipe is inactive"
             yoffset        = "1"
             id             = $ENTRY.id
        }{/if}{if $ENTRY.recipe_of_month  == 1}{actionIcon
             action         = "recipe_of_month_unset"
             icon           = "star_yellow.png"
             form           = "recipe"
             perm           = "activateRecipe"
             title          = "unset product of month"
             yoffset        = "1"
             id             = $ENTRY.id
        }{else}{actionIcon
             action         = "recipe_of_month_set"
             icon           = "star_grey.png"
             form           = "recipe"
             perm           = "activateRecipe"
             title          = "set product of month"
             yoffset        = "1"
             id             = $ENTRY.id
        }{/if}{actionIcon
             action         = "editRecipe"
             icon           = "pencil.png"
             target         = "slave1"
             form           = "0"
             perm           = "editRecipe"
             title          = "edit recipe"
             id             = $ENTRY.id
        }{actionIcon
             action         = "duplicateRecipe"
             icon           = "copy.png"
             form           = "recipe"
             perm           = "addrRecipe"
             title          = "duplicate recipe"
             yoffset        = "1"
             id             = $ENTRY.id
        }{actionIcon
             action         = "deleteRecipe"
             icon           = "delete.png"
             ask            = "Are you sure to delete this recipe?"
             form           = "recipe"
             yoffset        = "1"
             perm           = "deleteRecipe"
             title          = "Delete recipe"
             id             = $ENTRY.id
        }
       </td>
       <td class="row">
       {$ENTRY.title|default:"?"}
       </td>
       <td class="button">{$EXT_OPTIONS[$ENTRY.id]}<img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
       <td class="row">
       <img src="/images/icons/{if $ENTRY.lang_active}active_small.gif{else}inactive_small.gif{/if}" alt="" />
       </td>
       <td class="row">
       <img src="/images/icons/{if $ENTRY.validated}check_small.png{else}check_na.png{/if}" alt="" />
        
       </td>
       
      </tr>
     {/foreach}
    </table>
{include file="includes/navigator.tpl" form="recipe" withouthidden=1}
<input type="hidden" name="showtabs" value="1" />
{include file="ch.iframe.snode.rezepte/admin/hiddenValues.tpl"}
</form>