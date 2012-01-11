<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="recipe">
{include file="includes/lang_selector_simple.tpl" form="recipe"}
{include file="includes/charfilter.tpl" form="recipe" }

<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td colspan="4" class="admin_title">{"node_title"|translate}: <b>{$NODE_TITLE} </b></td>
      </tr>
      <tr>
       <td class="table_header" width="80">{"options"|translate}</td>
       <td class="table_header" width="20"><b>ID</b></td>
       <td class="table_header" width="80">{"art_nr"|translate}</td>
       <td class="table_header">{"title"|translate}</td>
      </tr>

      {foreach from=$DATA item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if $ENTRY.recipe_id == $ENTRY.id}
       {if "edit"|allowed}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=removeRecipeFromTree&x{$BASEID}_recipe_id={$ENTRY.id}&x{$BASEID}_node_id={$ENTRY.node_id}"><img src="images/icons/check.png" alt="{"add"|translate}" title="{"add"|translate}" /></a>{/if}
       {else}
       {if "edit"|allowed}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=addRecipeToTree&x{$BASEID}_id={$ENTRY.id}"><img src="images/icons/folder_add.png" alt="{"add"|translate}" title="{"add"|translate}" /></a>{/if}
       {/if}
       </td>
       <td class="row">
       {$ENTRY.id}
       </td>
       <td class="row">
       {$ENTRY.art_nr}
       </td>
       <td class="row">
       {$ENTRY.title|default:"?"}
       </td>
      </tr>
     {/foreach}
    </table>
    <br />
 {include file="includes/navigator.tpl" form="recipe"}
</form>