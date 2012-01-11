{if $ELEMENT.element_type == 0}
    {* show text *}
    <input
        type="hidden"
        id ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}{else}form_element{$ELEMENT.element_id}{/if}"
        name="x{$BASEID}_formfields[{$ELEMENT.element_id}]"
        value="{if $POSTS[$ELEMENT.element_id]}{$POSTS[$ELEMENT.element_id]}{elseif $ELEMENT.default_value != ''}{$ELEMENT.default_value}{else}{$ELEMENT.values.0.value}{/if}"
    />
    <label for="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}{else}form_element{$ELEMENT.element_id}{/if}">
        {if $POSTS[$ELEMENT.element_id]}
            {$POSTS[$ELEMENT.element_id]}
        {elseif $ELEMENT.default_value != ''}
            {$ELEMENT.default_value}
        {else}
            {$ELEMENT.values.0.value}
        {/if}
    </label>
{elseif $ELEMENT.element_type == 1}
    {* text *}
    <input
        type="text"
        id ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}{else}form_element{$ELEMENT.element_id}{/if}"
        name="x{$BASEID}_formfields[{$ELEMENT.element_id}]"
        value="{if $POSTS[$ELEMENT.element_id]}{$POSTS[$ELEMENT.element_id]}{elseif $ELEMENT.default_value != ''}{$ELEMENT.default_value}{else}{$ELEMENT.values.0.value}{/if}"
        {if $ELEMENT.readonly}disabled{/if}
        size="{if $ELEMENT.size > 0}{$ELEMENT.size}{else}15{/if}"
        {if $ERRORS[$ELEMENT.element_id][0]}class="form_error"{/if}
        {$ELEMENT.params}
     />
{elseif $ELEMENT.element_type == 2 || $ELEMENT.element_type == 4}
    {* select *}
    <select
        id ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}{else}form_element{$ELEMENT.element_id}{/if}"
        name="x{$BASEID}_formfields[{$ELEMENT.element_id}]"
        {if $ERRORS[$ELEMENT.element_id][0]}class="form_error"{/if}
        {$ELEMENT.params}
    >
        {foreach from=$ELEMENT.values item=VAL}
            <option
                {if $VAL.value != ''}value="{$VAL.value}"{/if}
                {if posted_form_value($ELEMENT.element_id,$VAL.value)}selected="selected"{elseif $ELEMENT.default_value == $VAL.value &&$POSTS[$ELEMENT.element_id][$VAL.value] == ""}selected="selected"{/if}
            >
                {$VAL.label}
            </option>
        {/foreach}
    </select>
{elseif $ELEMENT.element_type == 3}
    {* radio *}
    {foreach from=$ELEMENT.values item=VAL name=RADIO}
        <div>
            <div class="checkbox">
                <input
                    type="radio"
                    id="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}_{$smarty.foreach.RADIO.iteration}{else}form_element{$ELEMENT.element_id}_{$smarty.foreach.RADIO.iteration}{/if}"
                    name="x{$BASEID}_formfields[{$ELEMENT.element_id}]"
                    value="{if $VAL.value != ''}{$VAL.value}{else}{$VAL.label}{/if}"
                    {if posted_form_value($ELEMENT.element_id,$VAL.value)}checked{elseif $ELEMENT.default_value == $VAL.value && $POSTS[$ELEMENT.element_id][$VAL.value] == ""}checked{/if}
                    {$ELEMENT.params}
                />
            </div>
            <div class="checkboxlabel">
                <label for="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}_{$smarty.foreach.RADIO.iteration}{else}form_element{$ELEMENT.element_id}_{$smarty.foreach.RADIO.iteration}{/if}">
                    {$VAL.label}
                </label>
            </div>
            <br clear="all" />
        </div>
    {/foreach}
{elseif $ELEMENT.element_type == 5}
    {* checkbox *}
    {foreach from=$ELEMENT.values item=VAL name=CHECKBOX}
        <input
            type="checkbox"
            id="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}_{$smarty.foreach.CHECKBOX.iteration}{else}form_element{$ELEMENT.element_id}_{$smarty.foreach.CHECKBOX.iteration}{/if}"
            name="x{$BASEID}_formfields[{$ELEMENT.element_id}][{$VAL.value}]"
            value="{if $VAL.value != ''}{$VAL.value}{else}{$VAL.label}{/if}"
            {if $POSTS[$ELEMENT.element_id][$VAL.value]}checked="checked"{/if}
        />
        <label for="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}_{$smarty.foreach.CHECKBOX.iteration}{else}form_element{$ELEMENT.element_id}_{$smarty.foreach.CHECKBOX.iteration}{/if}">
            {$VAL.label}
        </label>
        <br />
    {/foreach}
{elseif $ELEMENT.element_type == 7}
    {* password*}
    <input
        type="password"
        id ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}{else}form_element{$ELEMENT.element_id}{/if}"
        name="x{$BASEID}_formfields[{$ELEMENT.element_id}]"
        value="{if $POSTS[$ELEMENT.element_id]}{$POSTS[$ELEMENT.element_id]}{else}{if $ELEMENT.default_value != ''}{$ELEMENT.default_value}{else}{$ELEMENT.values.0.value}{/if}{/if}"
        {if $ELEMENT.readonly}disabled{/if}
        size="{if $ELEMENT.size > 0}{$ELEMENT.size}{else}15{/if}"
        {if $ERRORS[$ELEMENT.element_id][0]}class="form_error"{/if}
        {$ELEMENT.params}
     />
{elseif $ELEMENT.element_type == 9}
    {* postalCode and city *}
    <input
        type="text"
        id ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}_0{else}form_element{$ELEMENT.element_id}_0{/if}"
        name="x{$BASEID}_formfields[{$ELEMENT.element_id}][0]"
        value="{if $POSTS[$ELEMENT.element_id][0]}{$POSTS[$ELEMENT.element_id][0]}{else}{$ELEMENT.values.0.value}{/if}"
        {if $ELEMENT.readonly}disabled{/if}
        size="6"
        {if $ERRORS[$ELEMENT.element_id][0]}class="form_error"{/if}
     />
    <input
        type="text"
        id ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}_1{else}form_element{$ELEMENT.element_id}_1{/if}"
        name="x{$BASEID}_formfields[{$ELEMENT.element_id}][1]"
        value="{if $POSTS[$ELEMENT.element_id][1]}{$POSTS[$ELEMENT.element_id][1]}{else}{$ELEMENT.values.1.value}{/if}"
        {if $ELEMENT.readonly}disabled{/if}
        size="27"
        {if $ERRORS[$ELEMENT.element_id][1]}class="form_error"{/if}
     />
{elseif $ELEMENT.element_type == 10}
    {* street and city *}
    <input
        type="text"
        id ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}_0{else}form_element{$ELEMENT.element_id}_0{/if}"
        name="x{$BASEID}_formfields[{$ELEMENT.element_id}][0]"
        value="{if $POSTS[$ELEMENT.element_id][0]}{$POSTS[$ELEMENT.element_id][0]}{else}{$ELEMENT.values.0.value}{/if}"
        {if $ELEMENT.readonly}disabled{/if}
        size="27"
        {if $ERRORS[$ELEMENT.element_id][0]}class="form_error"{/if}
     />
    <input
        type="text"
        id ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}_1{else}form_element{$ELEMENT.element_id}_1{/if}"
        name="x{$BASEID}_formfields[{$ELEMENT.element_id}][1]"
        value="{if $POSTS[$ELEMENT.element_id][1]}{$POSTS[$ELEMENT.element_id][1]}{else}{$ELEMENT.values.1.value}{/if}"
        {if $ELEMENT.readonly}disabled{/if}
        size="6"
        {if $ERRORS[$ELEMENT.element_id][1]}class="form_error"{/if}
     />
{elseif $ELEMENT.element_type == 11}
    {* textarea *}
    <textarea
        id ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}{else}form_element{$ELEMENT.element_id}{/if}"
        name="x{$BASEID}_formfields[{$ELEMENT.element_id}]"
        {if $ERRORS[$ELEMENT.element_id][0]}class="form_error"{/if}
        {if $ELEMENT.readonly}disabled{/if}
        {if $ELEMENT.maxlength > 0}onkeyup="ismaxlength(this); document.getElementById('x{$BASEID}_maxlength_{$ELEMENT.element_id}').value = ({$ELEMENT.maxlength} -  this.value.length);"{/if}
        {$ELEMENT.params}
    >{if $ELEMENT.default_value != ''}{$ELEMENT.default_value}{else}{$ELEMENT.values.0.value}{/if}{if $POSTS[$ELEMENT.element_id]}{$POSTS[$ELEMENT.element_id]}{else}{$ELEMENT.values.0.value}{/if}</textarea>
    {if $ELEMENT.maxlength > 0}
        <br/>
        <label for="x{$BASEID}_maxlength_{$ELEMENT.element_id}">
            {"number of characters"|livetranslate}&nbsp;
        </label>
        <input type="text" id="x{$BASEID}_maxlength_{$ELEMENT.element_id}" size="5" value="{$ELEMENT.maxlength}" />
    {/if}
{elseif $ELEMENT.element_type == 12}
    {* hidden *}
    <input
        type="hidden"
        id ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}{else}form_element{$ELEMENT.element_id}{/if}"
        name="x{$BASEID}_formfields[{$ELEMENT.element_id}]"
        value="{if $POSTS[$ELEMENT.element_id]}{$POSTS[$ELEMENT.element_id]}{elseif $ELEMENT.default_value != ''}{$ELEMENT.default_value}{else}{$ELEMENT.values.0.value}{/if}"
        {$ELEMENT.params}
    />
{elseif $ELEMENT.element_type == 13}
    {* fileupload *}
    {if $UPLOADEDFILE[$ELEMENT.scripting_identifier] == 1}
        {"file uploaded"|translate}
    {else}
        <input
            type="file"
            id ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}{else}form_element{$ELEMENT.element_id}{/if}"
            name="x{$BASEID}_file_{$ELEMENT.element_id}"
            {if $ELEMENT.readonly}disabled{/if}
            {if $ERRORS[$ELEMENT.element_id][0]}class="form_error"{/if}
            {$ELEMENT.params}
         />
    {/if}
{elseif $ELEMENT.element_type == 14}
    {* captcha *}
    {include file="includes/widgets/captcha.tpl" name="`$ELEMENT.scripting_identifier`"}
    <br class="clear" />
    {$ELEMENT.description}
{elseif $ELEMENT.element_type == 15}
    {* datepicker *}
    <input class="XTFoMdatepicker {if $ERRORS[$ELEMENT.element_id][0]}form_error{/if}"
        type="text"
        id ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}{else}form_element{$ELEMENT.element_id}{/if}"
        name="x{$BASEID}_formfields[{$ELEMENT.element_id}]"
        value="{if $POSTS[$ELEMENT.element_id]}{$POSTS[$ELEMENT.element_id]}{elseif $ELEMENT.default_value != ''}{$ELEMENT.default_value}{else}{$ELEMENT.values.0.value}{/if}"
        {if $ELEMENT.readonly}disabled{/if}
        size="{if $ELEMENT.size > 0}{$ELEMENT.size}{else}15{/if}"
        {$ELEMENT.params}
    />
{/if}