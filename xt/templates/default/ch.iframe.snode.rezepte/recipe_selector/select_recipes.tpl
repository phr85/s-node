<form method="post" name="recipe" onSubmit="window.document.forms['editRecipe'].x{$BASEID}_yoffset.value= window.pageYOffset;" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td colspan="4"><h2>{"Last 5 Entries"|translate}:</h2></td>
      </tr>
       <tr>
        <td colspan="4">{include file="includes/lang_selector_simple.tpl" form="recipe"}</td>
      </tr>
      <tr>
       <td class="table_header" width="30">&nbsp;</td>
       <td class="table_header" width="40">ID</td>
       <td class="table_header">{"title"|translate}</td>
      </tr>
      {foreach from=$DATA_LAST item=LASTENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if $LASTENTRY.recipe_id == $LASTENTRY.id}{actionIcon
       action     = "removeRecipeFromTree"
       icon       = "check.png"
       perm       = "recipeSelector"
       form       = "recipe"
       title      = "remove recipe from tree"
       recipe_id =$LASTENTRY.id
       node_id    =$LASTENTRY.node_id
       yoffset    = "1"
       }{else}{actionIcon
       action     = "addRecipeToTree"
       icon       = "folder_add.png"
       perm       = "recipeSelector"
       form       = "recipe"
       title      = "add recipe to tree"
       id         =$LASTENTRY.id
       node_id    =$LASTENTRY.node_id
       yoffset    = "1"
       }{/if}
       </td>
       <td class="row">
       {$LASTENTRY.id}
       </td>
       <td class="row">
       {$LASTENTRY.title|default:"?"}
       </td>
      </tr>
     {/foreach}
</table>
<h2>{"Search"|translate}</h2>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="search_box">
   {"Search for"|translate}&nbsp;
   <input type="text" id="x{$BASEID}_search" name="x{$BASEID}_search" value="{$SEARCH_TERM}" />&nbsp;
   {"in"|translate}&nbsp;
   <select name="x{$BASEID}_search_field">
    <option value="d.title" {if $SEARCH_BY == "d.title"}selected{/if}>{"Title"|translate}</option>
    <option value="a.id" {if $SEARCH_BY == "a.id"}selected{/if}>{"ID"|translate}</option>
    <option value="a.art_nr" {if $SEARCH_BY == "a.art_nr"}selected{/if}>{"Recipe nr."|translate}</option>
   </select>
   <input type="submit" value="{'Search'|translate}" />
   <img src="{$XT_IMAGES}spacer.gif" onload="document.getElementById('x{$BASEID}_search').focus();" />
  </td>
 </tr>
</table>



<input type="hidden" name="x{$BASEID}_recipe_id" value="" />
    <input type="hidden" name="x{$BASEID}_id" value="">
    <input type="hidden" name="x{$BASEID}_node_id" value="">
    <input type="hidden" name="x{$BASEID}_action" value="">
    <input type="hidden" name="x{$BASEID}_sort" value="">

<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td colspan="5"><h2>{"List"|translate}</h2></td>
      </tr>
      <tr>
        <td colspan="5">{include file="includes/charfilter.tpl" form="recipe"}</td>
      </tr>
      <tr>
   <td class="table_header" width="30">&nbsp;</td>
   <td class="table_header" width="44">{actionIcon action="NULL" label="ID" form=recipe sort=$sort.0.value icon=$sort.0.icon}</td>
   <td class="table_header">{actionIcon action="NULL" form=recipe label="Title" sort=$sort.1.value icon=$sort.1.icon}</td>
   <td class="table_header" width="44">{actionIcon action="NULL" form=recipe label="Act" sort=$sort.2.value icon=$sort.2.icon}</td>
   <td class="table_header" width="44">{actionIcon action="NULL" form=recipe label="Val" sort=$sort.3.value icon=$sort.3.icon}</td>
      </tr>
      {foreach from=$DATA item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {if $ENTRY.recipe_id == $ENTRY.id}{actionIcon
       action     = "removeRecipeFromTree"
       icon       = "check.png"
       perm       = "recipeSelector"
       form       = "recipe"
       title      = "remove recipe from tree"
       recipe_id =$ENTRY.id
       node_id    ={$ENTRY.node_id
       yoffset    = "1"
       }{else}{actionIcon
       action     = "addRecipeToTree"
       icon       = "folder_add.png"
       perm       = "recipeSelector"
       form       = "recipe"
       title      = "add recipe to tree"
       id         =$ENTRY.id
       node_id    ={$ENTRY.node_id
       yoffset    = "1"
       }{/if}
       </td>
       <td class="row">
       {$ENTRY.id}
       </td>
       <td class="row">
       {$ENTRY.title|default:"?"}
       </td>
     <td class="row">&nbsp; </td>
     <td class="row">&nbsp; </td>
      </tr>
     {/foreach}
    </table>
 {include file="includes/navigator.tpl" form="recipe"}
 {yoffset}
</form>

<script language="javascript" type="text/javascript">
<!--
window.focus();
// -->
</script>
