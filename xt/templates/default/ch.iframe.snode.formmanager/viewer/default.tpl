{XT_load_css file="formmanager.css"}
{XT_load_css file="jquery-ui-theme.css"}
{XT_load_js file="jquery-ui/ui.datepicker.js"}
{XT_load_js file="ch.iframe.snode.formmanager/viewer.js"}

<form method="post" enctype="multipart/form-data" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
    <div id="form_container">
        {if $FORM.hide_label != 1}<h1>{$FORM.title}</h1>{/if}
        {if $FORM.description != ''}<br />{$FORM.description}<br /><br />{/if}
        {if count($ERRORS) > 0}{include file="includes/widgets/errorhandler.tpl" Message="Die fehlenden Felder sind rot markiert"|translate Title="Fehlende Eingaben"|translate Options=",width:400"}{/if}

        {* walk through the element array to display each form field *}
        {foreach from=$ELEMENTS item=ELEMENT name=formelements}

            {* Start counting if the field type is a grouping title *}
            {if $ELEMENT.element_type == 6 && $ELEMENT.size > 1 }
                {counter start=$ELEMENT.size direction="down" print=false assign="counterI"}
                {assign var="GROUPWIDTH" value=$ELEMENT.size}
                {assign var="ISCOUNTING" value="1"}
            {elseif $ISCOUNTING == 1}
                {counter}
            {else}
                {* Reset variable if the field is not in a group *}
                {assign var="ISCOUNTING" value="0"}
                {assign var="counterI" value="0"}
            {/if}
    
            {if $ELEMENT.element_type == 8}
                <div class="form_separator">
                    {if !$ELEMENT.hide_label}{$ELEMENT.label}{/if}
                </div>
                {if $ELEMENT.description!=""}
                    {$ELEMENT.description}<br />
                    <br />
                {/if}
            {else}
                {if $ELEMENT.element_type != 12}
                    {if $ELEMENT.element_type == 0}
                        <br />
                        <label for="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}{else}form_element{$ELEMENT.element_id}{/if}">
                            {$ELEMENT.label}
                        </label>
                        {include file="includes/form_elements.tpl"}<br />
                    {else}
                        {if $ELEMENT.hide_label != 1}
                            <div class="{if $counterI >= 0 && $counterI != $GROUPWIDTH}formsublabel{else}formlabel{/if}">
                                {if $ELEMENT.element_type == 3 || $ELEMENT.element_type == 5 || $ELEMENT.element_type == 6 || $ELEMENT.element_type == 9 || $ELEMENT.element_type == 10}
                                    {$ELEMENT.label}
                                {else}
                                    <label for ="{if $ELEMENT.scripting_identifier !=""}{$ELEMENT.scripting_identifier}{else}form_element{$ELEMENT.element_id}{/if}">
                                        {$ELEMENT.label}
                                    </label>
                                {/if}
                                {if $ELEMENT.required OR $ELEMENT.element_type == 14}
                                    <span class="required">*</span>
                                {/if}
                            </div>
                        {/if}
                        {* Display element if it is not the group itself*}
                        {if $ELEMENT.element_type != 6}
                            <div class="formelement">{include file="includes/form_elements.tpl"}</div>
                        {/if}
                        {* force a linebreak if reached the last element of the group or the last field is set*}
                        {if $counterI <= 0 OR $smarty.foreach.formelements.last}
                            <br class="clear" />
                        {/if}
                    {/if}
                {else}
                    {include file="includes/form_elements.tpl"}
                {/if}
            {/if}
        {/foreach}
        <input type="hidden" name="x{$BASEID}_form_id" value="{$FORM.id}" />
        <input type="submit" value="{'Submit'|translate}" />
    </div>
</form>