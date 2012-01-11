{XT_load_css file="jquery-ui-theme.css"}
{XT_load_css file="ch.iframe.snode.jobcenter.css"}

<form method="post" enctype="multipart/form-data" action="">
    <div id="application_form">
        <h1>{$xt1700_application.form.title|livetranslate}</h1>
        <br />
        {* Errorhandling *}
        {if $xt1700_application.form.errors|@count > 0}
            {include file="ch.iframe.snode.jobcenter/application/"|cat:$xt1700_application.param.style_folder|cat:"/error_handler.tpl" MESSAGE="The missed fields are red marked"|translate TITLE="Missing Input"|translate Options=",width:600,height:400"}
        {/if}
        {* Formular wird nur solange angezeigt, bis die Bewerbung versendet wurde *}
        {if $xt1700_application.form.success != ""}
            <div class="application_success">
                {$xt1700_application.form.success|translate}
            </div>
        {else}
            {* Alle Zeilen sind Feldgruppen !!! *}
            {foreach from=$xt1700_application.form.field_groups item=GROUP name=G}
                <div class="application_form_element_group">
                    {* Falls es ein Template gibt wird der klassische Fall Beschreibung / Feld aufgebaut *}
                    {if $xt1700_application.config.fieldtypes[$GROUP.fields.0.type].template != ""}
                        <div class="application_form_element_description">
                            {foreach from=$GROUP.fields item=FIELD name=F}
                                {* Bei Input Radio/Checkbox werden die Labels neben den Text geschrieben, dh. die Beschreibung ist hier hicht das Label *}
                                {if !$xt1700_application.config.fieldtypes[$FIELD.type].dummy_label}
                                    <label for="application_{$FIELD.label}">
                                        {if !$FIELD.dont_display_label}
                                            {$FIELD.label|livetranslate}{if $FIELD.required}<span class="application_required">*</span>{/if}
                                        {/if}
                                    </label>
                                {else}
                                    {if !$FIELD.dont_display_label}
                                        {$FIELD.label|livetranslate}{if $FIELD.required}<span class="application_required">*</span>{/if}
                                    {/if}
                                {/if}
                                {if !$smarty.foreach.F.last}/{/if}
                            {/foreach}
                        </div>
                        <div class="application_form_element_field">
                            {foreach from=$GROUP.fields item=FIELD name=F}
                                {assign var=ERRORS value=$xt1700_application.form.errors[$FIELD.label]}
                                {* Hier werden die einzelnen Feldtypen eingefuegt *}
                                {include file="ch.iframe.snode.jobcenter/application/"|cat:$xt1700_application.param.style_folder|cat:"/"|cat:$xt1700_application.config.fieldtypes[$FIELD.type].template}
                            {/foreach}
                        </div>
                    {* Hier werden die Seperator verarbeitet *}
                    {elseif $GROUP.fields.0.type == 1}
                        <div class="application_form_seperator">
                            {$GROUP.fields.0.label|livetranslate}
                        </div>
                    {/if}
                </div>
            {/foreach}
            <div class="application_form_element_group"></div>
            {* Submit and Reset *}
            <div class="application_form_element_group">
                <div class="application_form_element_description"></div>
                <div class="application_form_element_field">
                    <input type="hidden" value="{$xt1700_application.param.job_id}" id="application_job_id" name="application[job_id]" />
                    <input type="submit" value="{"submit"|translate}" id="application_submit" name="application[submit]" />
                    <input type="reset" value="{"reset"|translate}" id="application_reset" name="application[reset]" />
                </div>
            </div>
        {/if}
    </div>
    <br class="clear" />
</form>

{*print_data array=$xt1700_application*}