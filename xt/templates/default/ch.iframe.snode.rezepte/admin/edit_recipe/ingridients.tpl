<tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Ingridients"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 
 
 
{foreach from=$INGRIDIENTS name=ING item=INGRIDIENT}
 <tr>
  <td class="left{if $INGRIDIENT.unit_id==17} highlight{/if}">{actionIcon 
  action="removeIngridientFromRecipe" title="remove" yoffset="1" icon="delete.png" form="editRecipe" ingridient_id=$INGRIDIENT.id}{if !$smarty.foreach.ING.last}{actionIcon 
  action="moveIngridientInRecipeDown" title="move down" yoffset="1" icon="explorer/arrow_down_green.png" form="editRecipe" ingridient_id=$INGRIDIENT.id position=$INGRIDIENT.position}{else}{$ICONSPACER}{/if}{if !$smarty.foreach.ING.first}{actionIcon 
  action="moveIngridientInRecipeUp" title="move up" yoffset="1" icon="explorer/arrow_up_green.png" form="editRecipe" ingridient_id=$INGRIDIENT.id position=$INGRIDIENT.position}{/if}
  </td>
  <td class="right{if $INGRIDIENT.unit_id==17} highlight{/if}">
<input type="text" name="x{$BASEID}_name[{$INGRIDIENT.position}]" value="{$INGRIDIENT.name}" size="33" id="inp{$smarty.foreach.ING.iteration}" />
<input type="text" name="x{$BASEID}_ammount[{$INGRIDIENT.position}]" value="{$INGRIDIENT.unit_ammount}" size="4" />
<select name="x{$BASEID}_unit[{$INGRIDIENT.position}]" id="x{$BASEID}_unit_{$INGRIDIENT.position}">
{foreach from=$UNITS item=UNIT}
<option value="{$UNIT.id}"{if $UNIT.id==$INGRIDIENT.unit_id}selected="selected"{/if}>{$UNIT.standard}, {$UNIT.short}</option>
{/foreach}
</select>
<input type="hidden" name="x{$BASEID}_ing_id[{$INGRIDIENT.position}]" value="{$INGRIDIENT.id}" size="3" id="inpid{$smarty.foreach.ING.iteration}" />

<script type="text/javascript">
{literal}
var options = {
    script: "index.php?TPL=5702&ctype=xml&json=true&",
    varname: "input",
    minchars: 3,
    shownoresults:false,
    json:true,
    callback: function (obj) { document.getElementById('{/literal}inpid{$smarty.foreach.ING.iteration}{literal}').value = obj.id;
    setselitem(obj.unitid,'{/literal}x{$BASEID}_unit_{$INGRIDIENT.position}{literal}');}
};
{/literal}
var as_json = new AutoSuggest('inp{$smarty.foreach.ING.iteration}', options);
</script>

  </td>
 </tr>
{/foreach}


 <tr>
  <td class="left lightgrey">
 {"new"|translate}
  </td>
  <td class="right lightgrey">
<input type="text" name="x{$BASEID}_name[997]" value="" size="33" id="inp997" />
<input type="text" name="x{$BASEID}_ammount[997]" value="0" size="4" />
<select name="x{$BASEID}_unit[997]" id="x{$BASEID}_unit_997">
{foreach from=$UNITS item=UNIT}
<option value="{$UNIT.id}" {if $UNIT.id==17}selected="selected"{/if}>{$UNIT.standard}, {$UNIT.short}</option>
{/foreach}
</select>

<input type="hidden" name="x{$BASEID}_ing_id[997]" value="" size="3" id="inpid997" />

<script type="text/javascript">
{literal}
var options = {
    script: "index.php?TPL=5702&ctype=xml&json=true&",
    varname: "input",
    minchars: 3,
    shownoresults:false,
    json:true,
    callback: function (obj) { document.getElementById('inpid997').value = obj.id;
    setselitem(obj.unitid,'{/literal}x{$BASEID}_unit_997{literal}');}
};
{/literal}
var as_json = new AutoSuggest('inp997', options);
</script>
  </td>
 </tr>



 <tr>
  <td class="left lightgrey">
 {"new"|translate}
  </td>
  <td class="right lightgrey">
<input type="text" name="x{$BASEID}_name[998]" value="" size="33" id="inp998" />
<input type="text" name="x{$BASEID}_ammount[998]" value="0" size="4" />
<select name="x{$BASEID}_unit[998]" id="x{$BASEID}_unit_998">
{foreach from=$UNITS item=UNIT}
<option value="{$UNIT.id}" {if $UNIT.id==17}selected="selected"{/if}>{$UNIT.standard}, {$UNIT.short}</option>
{/foreach}
</select>
<input type="hidden" name="x{$BASEID}_ing_id[998]" value="" size="3" id="inpid998" />

<script type="text/javascript">
{literal}
var options = {
    script: "index.php?TPL=5702&ctype=xml&json=true&",
    varname: "input",
    minchars: 3,
    shownoresults:false,
    json:true,
    callback: function (obj) { document.getElementById('inpid998').value = obj.id;
    setselitem(obj.unitid,'{/literal}x{$BASEID}_unit_998{literal}');}
};
{/literal}
var as_json = new AutoSuggest('inp998', options);
</script>
  </td>
 </tr>
 <tr>
  <td class="left lightgrey">
 {"new"|translate}
  </td>
  <td class="right lightgrey">
<input type="text" name="x{$BASEID}_name[999]" value="" size="33" id="inp999" />
<input type="text" name="x{$BASEID}_ammount[999]" value="0" size="4" />
<select name="x{$BASEID}_unit[999]" id="x{$BASEID}_unit_999">
{foreach from=$UNITS item=UNIT}
<option value="{$UNIT.id}" {if $UNIT.id==17}selected="selected"{/if}>{$UNIT.standard}, {$UNIT.short}</option>
{/foreach}
</select>
<input type="hidden" name="x{$BASEID}_ing_id[999]" value="" size="3" id="inpid999" />

<script type="text/javascript">
{literal}
var options = {
    script: "index.php?TPL=5702&ctype=xml&json=true&",
    varname: "input",
    minchars: 3,
    shownoresults:false,
    json:true,
    callback: function (obj) { document.getElementById('inpid999').value = obj.id;
    setselitem(obj.unitid,'{/literal}x{$BASEID}_unit_999{literal}');}
};
{/literal}
var as_json = new AutoSuggest('inp999', options);
</script>
  </td>
 </tr>




<tr><td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td></tr>
