<form method="POST" name="editElement">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Field"|translate}:</span><span class="title"> {$DATA.label}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_ELEMENT_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Field type"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_element_type" onChange="document.forms['editElement'].x{$BASEID}_action.value='saveElement';document.forms['editElement'].submit()">
   {foreach from=$TYPES key=KEY item=TYPE}
   <option value="{$KEY}" {if $DATA.element_type == $KEY}selected{/if}>{$TYPE}</option>
   {/foreach}
   </select>
  </td>
 </tr>
 <tr>
  <td class="left">{"Label"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_label" value="{$DATA.label|htmlspecialchars}" size="42">
  <input type="checkbox" name="x{$BASEID}_hide_label" value="1" {if $DATA.hide_label==1} checked="checked" {/if} />{"hide label"|translate}
  </td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" cols="65" rows="4">{$DATA.description}</textarea></td>
 </tr>
 <tr>
  <td class="view_header" colspan="3">
   <span class="title">{"Details"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {if $DATA.element_type != 8}
 {if $DATA.element_type == 6}
  <tr>
  <td class="left">{"Mark as required"|translate}?</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_required" value="1" {if $DATA.required == 1}checked{/if}></td>
 </tr>
 {/if}
 {if $DATA.element_type != 6}
 <tr>
  <td class="left">{"Initial value"|translate}</td>
  <td class="right"><input type="text" style="color: darkorange;" name="x{$BASEID}_default_value" value="{$DATA.default_value}" size="42"></td>
 </tr>
 <tr>
  <td class="left">{"Mark as required"|translate}?</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_required" value="1" onchange="document.forms['editElement'].x{$BASEID}_action.value='makeRequired';document.forms['editElement'].submit();" {if $DATA.required == 1}checked{/if}></td>
 </tr>
 <tr>
  <td class="left">{"Read-Only"|translate}?</td>
  <td class="right"><input type="checkbox" name="x{$BASEID}_readonly" value="1" {if $DATA.readonly == 1}checked{/if}></td>
 </tr>
  {/if}
 {if $DATA.element_type != 11}
 <tr>
  <td class="left"> {if $DATA.element_type != 6}{"Field size"|translate}{else}{"Number of fields for grouping"|translate}{/if}</td>
  <td class="right"><input type="text" name="x{$BASEID}_size" value="{$DATA.size}" size="3" value="42" maxlength="3"></td>
 </tr>
 {/if}
 {if $DATA.element_type == 11}
 <tr>
  <td class="left">{"Maximal field lenght"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_maxlength" value="{$DATA.maxlength}" size="5" value="42" maxlength="5"></td>
 </tr>
 {/if}
 <tr>
  <td class="left">{"Additional parameters"|translate}</td>
  <td class="right"><textarea name="x{$BASEID}_params" cols="65" rows="3">{$DATA.params}</textarea></td>
 </tr>
 {if $DATA.element_type == 2 || $DATA.element_type == 3 || $DATA.element_type == 4 || $DATA.element_type == 5}
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Value presets"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {/if}
 {/if}
</table>
{if $DATA.element_type == 2 || $DATA.element_type == 3 || $DATA.element_type == 4 || $DATA.element_type == 5}
{include file="includes/buttons.tpl" data=$EDIT_ELEMENT_VALUES_BUTTONS withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Datasource"|translate}</td>
  <td class="right" colspan="2">
   <select name="x{$BASEID}_datasource_type" onChange="document.forms['editElement'].x{$BASEID}_action.value='saveElement';document.forms['editElement'].submit()">
    <option value="2" {if $DATA.datasource_type == 2}selected{/if}>{"Only custom values"|translate}</option>
    <option value="3" {if $DATA.datasource_type == 3}selected{/if}>{"Database (SQL)"|translate}</option>
    <option value="4" {if $DATA.datasource_type == 4}selected{/if}>{"URL value (Get)"|translate}</option>
    <option value="5" {if $DATA.datasource_type == 5}selected{/if}>{"Form value (Post)"|translate}</option>
    <option value="6" {if $DATA.datasource_type == 6}selected{/if}>{"Request value (Post or Get)"|translate}</option>
    <option value="7" {if $DATA.datasource_type == 7}selected{/if}>{"Session value (Session)"|translate}</option>
   </select>
  </td>
 </tr>
 {if $DATA.datasource_type == 3}
 <tr>
  <td class="left">{"Database query"|translate}</td>
  <td class="right" colspan="2"><textarea name="x{$BASEID}_datasource_query" cols="65" rows="3">{$DATA.datasource_query}</textarea>
  <br />{"e.g."|translate} SELECT id, username FROM xt_user ORDER BY username ASC
  </td>
 </tr>
 <tr>
  <td class="left">{"Datasource value field"|translate}</td>
  <td class="right" colspan="2"><input type="text" name="x{$BASEID}_datasource_value_field" value="{$DATA.datasource_value_field}" size="42">&nbsp;{"e.g."|translate} id</td>
 </tr>
 <tr>
  <td class="left">{"Datasource label field"|translate}</td>
  <td class="right" colspan="2"><input type="text" name="x{$BASEID}_datasource_label_field" value="{$DATA.datasource_label_field}" size="42">&nbsp;{"e.g."|translate} username</td>
 </tr>
 {/if}
{if $DATA.datasource_type == 4 || $DATA.datasource_type == 5 || $DATA.datasource_type == 6 || $DATA.datasource_type == 7}
 <tr>
  <td class="left">{"Array Name"|translate}</td>
  <td class="right" colspan="2"><input type="text" name="x{$BASEID}_datasource_query" value="{$DATA.datasource_query}" size="42">&nbsp;{"e.g."|translate} mydata for $Array['mydata']</td>
  </td>
 </tr>
 <tr>
  <td class="left">{"Datasource value field"|translate}</td>
  <td class="right" colspan="2"><input type="text" name="x{$BASEID}_datasource_value_field" value="{$DATA.datasource_value_field}" size="42">&nbsp;{"e.g."|translate} value for $Array['mydata'][0]['value']</td>
 </tr>
 <tr>
  <td class="left">{"Datasource label field"|translate}</td>
  <td class="right" colspan="2"><input type="text" name="x{$BASEID}_datasource_label_field" value="{$DATA.datasource_label_field}" size="42">&nbsp;{"e.g."|translate} label for $Array['mydata'][0]['label']</td>
 </tr>
 {/if}
 {foreach from=$VALUES item=VALUE name=V}
 <tr>
  <td class="left">{$VALUE.pos}.</td>
  <td class="right" style="width: 80px; padding-right: 0px;">{
  if $CTRL
  }{actionIcon
      action="insertValue"
      icon="explorer/arrow_down_green.png"
      position="after"
      form="editElement"
      insert_position=$VALUE.pos
  }{actionIcon
      action="insertValue"
      icon="explorer/arrow_up_green.png"
      position="before"
      form="editElement"
      insert_position=$VALUE.pos
  }{else}{actionIcon
      action="editValue"
      icon="pencil.png"
      form="editElement"
      value_id=$VALUE.id
      title="Edit value"
  }{actionIcon
      action="deleteValue"
      icon="delete.png"
      form="editElement"
      ask="Are you sure to delete this value?"
      title="Delete value"
      value_id=$VALUE.id
  }{if !$smarty.foreach.V.last}{actionIcon
      action="moveValue"
      icon="explorer/arrow_down_green.png"
      position="down"
      form="editElement"
      move_position=$VALUE.pos
      value_id=$VALUE.id
  }{else}{$ICONSPACER}{/if}{if !$smarty.foreach.V.first}{actionIcon
      action="moveValue"
      icon="explorer/arrow_up_green.png"
      position="up"
      form="editElement"
      move_position=$VALUE.pos
      value_id=$VALUE.id
  }{else}{$ICONSPACER}{/if}{/if}</td>
  <td class="right">{$VALUE.label} <span style="color: #000000;">=></span> <span style="color: green;">{$VALUE.value}</span></td>
 </tr>
 {/foreach}
 <tr>
  <td class="left">&nbsp;</td>
  <td class="right" colspan="2">{if $FIRST_VALUE}{
   actionIcon
        action="addFirstValue"
        icon="add_small.png"
        form="editElement"
        title="Add a new value"
   }{else}{
   actionIcon
        action="addValue"
        icon="add_small.png"
        form="editElement"
        title="Add a new value"
   }{/if}</td>
 </tr>
</table>
{/if}
{if $DATA.element_type != 6}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="3">
   <span class="title">{"Scripting"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="3"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Scripting Identifier"|translate}</td>
  <td class="right" colspan="2"><input type="text" name="x{$BASEID}_scripting_identifier" value="{$DATA.scripting_identifier}" size="42"></td>
 </tr>
 <tr>
  <td class="view_header" colspan="3">
   <span class="title">{"Rules"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="3"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {foreach from=$RULES item=RULE}
 {if $RULE.compare_type == 1}
 <tr>
  <td class="left">{$RULE.title}</td>
  <td class="right" style="width: 40px; padding-right: 0px;">{actionIcon
      action="editElementRule"
      icon="pencil.png"
      form="editElement"
      title="Edit this rule"
      rule_id=$RULE.id
  }{actionIcon
      action="deleteElementRule"
      icon="delete.png"
      form="editElement"
      title="Delete this rule"
      ask="Are you sure to delete this rule?"
      rule_id=$RULE.id
  }</td>
  <td class="right">Simple compare: <span style="color: green;">Input</span> {$RULE.compare_query} <span style="color: red;">{$RULE.value}</span></td>
 </tr>
 {/if}
 {if $RULE.compare_type == 4}
 <tr>
  <td class="left">{$RULE.title}</td>
  <td class="right" style="width: 40px; padding-right: 0px;">{actionIcon
      action="editElementRule"
      icon="pencil.png"
      form="editElement"
      title="Edit this rule"
      rule_id=$RULE.id
  }{actionIcon
      action="deleteElementRule"
      icon="delete.png"
      form="editElement"
      title="Delete this rule"
      ask="Are you sure to delete this rule?"
      rule_id=$RULE.id
  }</td>
  <td class="right">Script: <span style="color: red;">{$RULE.value}</span></td>
 </tr>
 {/if}
 {if $RULE.compare_type == 2 || $RULE.compare_type == 3}
 <tr>
  <td class="left">{$RULE.title}</td>
  <td class="right" style="width: 40px; padding-right: 0px;">{actionIcon
      action="editElementRule"
      icon="pencil.png"
      form="editElement"
      title="Edit this rule"
      rule_id=$RULE.id
  }{actionIcon
      action="deleteElementRule"
      icon="delete.png"
      form="editElement"
      title="Delete this rule"
      ask="Are you sure to delete this rule?"
      rule_id=$RULE.id
  }</td>
  <td class="right">Regular expression: <span style="color: green;">Input</span> {"must match"|translate} <span style="color: red;">{$RULE.compare_query}</span></td>
 </tr>
 {/if}
 {/foreach}
 <tr>
  <td class="left">&nbsp;</td>
  <td class="right" colspan="2">{
       actionIcon
            action="addElementRule"
            icon="add_small.png"
            form="editElement"
            title="Add a new rule"
            element_id=$DATA.element_id
       }</td>
 </tr>
 {/if}
</table>
<input type="hidden" name="x{$BASEID}_element_id" value="{$DATA.element_id}" />
<input type="hidden" name="x{$BASEID}_rule_id" value="" />
<input type="hidden" name="x{$BASEID}_form_id" value="" />
<input type="hidden" name="x{$BASEID}_value_id" value="" />
<input type="hidden" name="x{$BASEID}_insert_position" value="" />
<input type="hidden" name="x{$BASEID}_move_position" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_module" value="ee" />
<input type="hidden" name="x{$BASEID}_script_id" />
{include file="includes/editor.tpl"}
</form>
