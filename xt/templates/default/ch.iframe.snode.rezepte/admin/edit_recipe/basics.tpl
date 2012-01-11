 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"recipe basics"|translate}</span>{inline_navigator_top anchor ="recipe_basics"}
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
{if $DISPLAY.status == 1}
<tr>
  <td class="left">{"Status"|translate}</td>
  <td class="right">
  {$DATA.rating_avg} 
  {if $DATA.validated  == 1}
    {actionIcon action="validateRecipeUnset" title="Validate" yoffset="1" icon="check.png" form="editRecipe" id=$DATA.id}
  {else}
    {actionIcon action="validateRecipe" title="Validate" yoffset="1" icon="check_na.png" form="editRecipe" id=$DATA.id}
  {/if}
  {if $DATA.recipe_of_month  == 1}
    {actionIcon action = "recipe_of_month_unset" icon = "star_yellow.png" form = "editRecipe" perm = "activateRecipe" title = "unset product of month" yoffset = "1" id = $DATA.id }
  {else}
    {actionIcon action = "recipe_of_month_set" icon = "star_grey.png" form = "editRecipe" perm = "activateRecipe" title = "set product of month" yoffset = "1" id = $DATA.id }
  {/if}
    {if $DATA.active  == 1}
    {actionIcon action  = "deactivateRecipeLang" icon    = "active.png" perm    = "activateRecipe" form    = "editRecipe" title   = "deactivate recipe" nopermicon = "active.gif" nopermtitle="recipe is active" yoffset="1"}
  {else}
    {actionIcon action = "activateRecipeLang" icon = "inactive.png" perm = "activateRecipe" form = "editRecipe" title = "activate recipe" nopermicon="inactive.gif" nopermtitle="recipe is inactive" yoffset = "1"}
  {/if}
  </td>
 </tr>
 {/if}
 {if $DISPLAY.title == 1}
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_title" value="{$DATA.title}" onchange="window.parent.document.title = this.value" /></td>
 </tr>
 {/if}
 {if $DISPLAY.subtitle == 1}
 <tr>
  <td class="left">{"Subtitle"|translate}</td>
  <td class="right"><input type="text" size="42" name="x{$BASEID}_subtitle" value="{$DATA.subtitle}" /></td>
 </tr>
 {/if}
 {if $DISPLAY.description == 1}
  <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
     <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="3" cols="65">{$DATA.description}</textarea>
  </td>
 </tr>
 {/if}
 
  <tr>
  <td class="left">{"Making"|translate}</td>
  <td class="right">{toggle_editor id="making"}
     <textarea id="x{$BASEID}_making" name="x{$BASEID}_making" rows="6" cols="65">{$DATA.making}</textarea>
  </td>
 </tr>
 
 <tr>
  <td class="left">{"portions"|translate}</td>
  <td class="right"><input type="text" size="6" name="x{$BASEID}_portions" value="{$DATA.portions}" /></td>
 </tr>
 <tr>
  <td class="left">{"kcal"|translate}</td>
  <td class="right"><input type="text" size="6" name="x{$BASEID}_kcal" value="{$DATA.kcal}" /></td>
 </tr>
 <tr>
  <td class="left">{"complexity"|translate}</td>
  <td class="right">
  <select name="x{$BASEID}_complexity">
      <option value="1"{if $DATA.complexity == 1}selected="selected"{/if}>{"complex1"|translate}</option>
      <option value="2"{if $DATA.complexity == 2}selected="selected"{/if}>{"complex2"|translate}</option>
      <option value="3"{if $DATA.complexity == 3}selected="selected"{/if}>{"complex3"|translate}</option>
      <option value="4"{if $DATA.complexity == 4}selected="selected"{/if}>{"complex4"|translate}</option>
      <option value="5"{if $DATA.complexity == 5}selected="selected"{/if}>{"complex5"|translate}</option>
    </select>
 </tr>
 <tr>
  <td class="left">{"duration"|translate}</td>
  <td class="right"><input type="text" size="6" name="x{$BASEID}_create_duration" value="{$DATA.create_duration}" /> {"create duration in min"|translate}
  <br />
  <br />
    <input type="text" size="6" name="x{$BASEID}_rest_duration" value="{$DATA.rest_duration}" /> {"rest duration in min"|translate}
  </td>
 </tr>

 <tr>
  <td class="left">{"ca_price"|translate}</td>
  <td class="right"><input type="text" size="12" name="x{$BASEID}_ca_price" value="{$DATA.ca_price}" /></td>
 </tr>
