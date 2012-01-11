{XT_load_css file="events.css"}

{* Wird benoetigt um die Anzahl der Begleitpersonen zu definieren *}
{assign var=ACCO_COUNT value=0}

<h1 class="event_register_title">{"eventregistration"|livetranslate}<br />{$xt5100_registration.data.event_title}</h1>

{* Falls alles geklappt hat die Erfolgsmeldung ausgeben *}
{if $xt5100_registration.success != ""}
    <span class="event_register_success">{$xt5100_registration.success|livetranslate}</span>
{else}
    {* Falls es Fehler gibt den errorhandler zur ausgabe nutzen *}
    {if $xt5100_registration.errors|@count > 0}
    
        {XT_load_js file="jquery-ui/ui.dialog.js"}
        {XT_load_js file="jquery-ui/ui.draggable.js"}
        {XT_load_css file="jquery-ui-theme.css"}

        <div id="errorbox" title="{"To less inputs"|livetranslate}">
            {foreach from=$xt5100_registration.errors item=ERROR}
                {$ERROR|livetranslate}<br />
            {/foreach}
        </div>

        {literal}
        <script>
            $(document).ready(function(){
                $("#errorbox").dialog({
                    modal:true,overlay:{opacity:0.5,background: "black"},width:400
                });
            });
        </script>
        {/literal}
    {/if}
    <form method="post" action="">
        <h2 class="event_register_subtitles">{"personal data"|livetranslate}</h2>
        {* Anrede *}
        <div class="event_register_wrapper">
            <div class="event_register_description">
                {"gender"|livetranslate}
            </div>
            <div class="event_register_value">
                <select name="x{$BASEID}_register[gender]">
                    <option value="1" {if $xt5100_registration.input_values.gender == 1}selected="selected"{/if}>{"mr"|livetranslate}</option>
                    <option value="2" {if $xt5100_registration.input_values.gender == 2}selected="selected"{/if}>{"mrs"|livetranslate}</option>
                </select>
            </div>
        </div>
        {* Vorname *}
        <div class="event_register_wrapper">
            <div class="event_register_description">
                {"firstName"|livetranslate}*
            </div>
            <div class="event_register_value">
                <input {if $xt5100_registration.errors.firstName !=""}class="event_register_field_error"{/if} type="text" value="{$xt5100_registration.input_values.firstName}" name="x{$BASEID}_register[firstName]" />
            </div>
        </div>
        {* Nachname *}
        <div class="event_register_wrapper">
            <div class="event_register_description">
                {"lastName"|livetranslate}*
            </div>
            <div class="event_register_value">
                <input {if $xt5100_registration.errors.lastName !=""}class="event_register_field_error"{/if} type="text" value="{$xt5100_registration.input_values.lastName}" name="x{$BASEID}_register[lastName]" />
            </div>
        </div>
        {* Strasse / Nr. *}
        <div class="event_register_wrapper">
            <div class="event_register_description">
                {"street / nr"|livetranslate}*
            </div>
            <div class="event_register_value">
                <input class="short {if $xt5100_registration.errors.street !=""}event_register_field_error{/if}" type="text" value="{$xt5100_registration.input_values.street}" name="x{$BASEID}_register[street]" />
            </div>
            <div class="event_register_value">
                <input class="extremeshort {if $xt5100_registration.errors.street !=""}event_register_field_error{/if}" type="text" value="{$xt5100_registration.input_values.street_nr}" name="x{$BASEID}_register[street_nr]" />
            </div>
        </div>
        {* PLZ / Ort *}
        <div class="event_register_wrapper">
            <div class="event_register_description">
                {"postalcode / city"|livetranslate}*
            </div>
            <div class="event_register_value">
                <input class="extremeshort {if $xt5100_registration.errors.postalCode !=""}event_register_field_error{/if}" type="text" value="{$xt5100_registration.input_values.postalCode}" name="x{$BASEID}_register[postalCode]" />
            </div>
            <div class="event_register_value">
                <input class="short {if $xt5100_registration.errors.city !=""}event_register_field_error{/if}" type="text" value="{$xt5100_registration.input_values.city}" name="x{$BASEID}_register[city]" />
            </div>
        </div>
        {* E-Mail *}
        <div class="event_register_wrapper">
            <div class="event_register_description">
                {"email"|livetranslate}*
            </div>
            <div class="event_register_value">
                <input {if $xt5100_registration.errors.email !=""}class="event_register_field_error"{/if} type="text" value="{$xt5100_registration.input_values.email}" name="x{$BASEID}_register[email]" />
            </div>
        </div>
        {* Telefon *}
        <div class="event_register_wrapper">
            <div class="event_register_description">
                {"tel"|livetranslate}*
            </div>
            <div class="event_register_value">
                <input {if $xt5100_registration.errors.tel !=""}class="event_register_field_error"{/if} type="text" value="{$xt5100_registration.input_values.tel}" name="x{$BASEID}_register[tel]" />
            </div>
        </div>
        {* Mobil *}
        <div class="event_register_wrapper">
            <div class="event_register_description">
                {"tel_mobile"|livetranslate}
            </div>
            <div class="event_register_value">
                <input type="text" value="{$xt5100_registration.input_values.tel_mobile}" name="x{$BASEID}_register[tel_mobile]" />
            </div>
        </div>
        <div class="event_register_wrapper">
            <div class="event_register_description">
            </div>
            <div class="event_register_value">
            </div>
        </div>
        {if $xt5100_registration.data.freeplaces > 1 || $xt5100_registration.data.freeplaces == ""}
            <h2 class="event_register_subtitles">{"accompanying persons"|livetranslate}</h2>
        {/if}
        {foreach from=$xt5100_registration.input_values.acco_pers item=ACCOMPANYING_PERSON name=ACCO_PERS}
            {assign var=ACCO_COUNT value=$smarty.foreach.ACCO_PERS.iteration}
            {* Anrede *}
            <div class="event_register_wrapper">
                <div class="event_register_description">
                    {"gender"|livetranslate}
                </div>
                <div class="event_register_value">
                    <select name="x{$BASEID}_register[acco_pers][{$ACCO_COUNT}][gender]">
                        <option value="1" {if $xt5100_registration.input_values.acco_pers.$ACCO_COUNT.gender == 1}selected="selected"{/if}>{"mr"|livetranslate}</option>
                        <option value="2" {if $xt5100_registration.input_values.acco_pers.$ACCO_COUNT.gender == 2}selected="selected"{/if}>{"mrs"|livetranslate}</option>
                    </select>
                </div>
            </div>
            {* Vorname *}
            <div class="event_register_wrapper">
                <div class="event_register_description">
                    {"firstName"|livetranslate}
                </div>
                <div class="event_register_value">
                    <input type="text" value="{$xt5100_registration.input_values.acco_pers.$ACCO_COUNT.firstName}" name="x{$BASEID}_register[acco_pers][{$ACCO_COUNT}][firstName]" />
                </div>
            </div>
            {* Nachname *}
            <div class="event_register_wrapper">
                <div class="event_register_description">
                    {"lastName"|livetranslate}
                </div>
                <div class="event_register_value">
                    <input type="text" value="{$xt5100_registration.input_values.acco_pers.$ACCO_COUNT.lastName}" name="x{$BASEID}_register[acco_pers][{$ACCO_COUNT}][lastName]" />
                </div>
            </div>
            <div class="event_register_wrapper">
                <div class="event_register_description">
                </div>
                <div class="event_register_value">
                </div>
            </div>
        {/foreach}
        {* Diesen Formularbereich nur anzeigen wenn noch mindestens 2 Plaetze frei sind oder kein Limit besteht *}
        {if $xt5100_registration.data.freeplaces > 1 || $xt5100_registration.data.freeplaces == ""}
            {* Anrede *}
            <div class="event_register_wrapper">
                <div class="event_register_description">
                    {"gender"|livetranslate}
                </div>
                <div class="event_register_value">
                    <select name="x{$BASEID}_register[acco_pers][{$ACCO_COUNT+1}][gender]">
                        <option value="1">{"mr"|livetranslate}</option>
                        <option value="2">{"mrs"|livetranslate}</option>
                    </select>
                </div>
            </div>
            {* Vorname *}
            <div class="event_register_wrapper">
                <div class="event_register_description">
                    {"firstName"|livetranslate}
                </div>
                <div class="event_register_value">
                    <input type="text" value="" name="x{$BASEID}_register[acco_pers][{$ACCO_COUNT+1}][firstName]" />
                </div>
            </div>
            {* Nachname *}
            <div class="event_register_wrapper">
                <div class="event_register_description">
                    {"lastName"|livetranslate}
                </div>
                <div class="event_register_value">
                    <input type="text" value="" name="x{$BASEID}_register[acco_pers][{$ACCO_COUNT+1}][lastName]" />
                </div>
            </div>
            <div class="event_register_wrapper">
                <div class="event_register_description">
                </div>
                <div class="event_register_value">
                </div>
            </div>
        {/if}
        {* Diesen Button nur dann erscheinen lassen, falls die Summe der Person inkl. der Begleitpersonen kleiner ist, als die maximal verfuegbaren plaetze, oder kein Limit besteht *}
        {if ($xt5100_registration.data.freeplaces > 0  && $xt5100_registration.data.freeplaces > $ACCO_COUNT+2) || $xt5100_registration.data.freeplaces == ""}
            <div class="event_register_wrapper">
                <div class="event_register_description">
                </div>
                <div class="event_register_value">
                    <input class="submit" type="submit" value="{"add more"|livetranslate}" name="x{$BASEID}_register_refresh" />
                </div>
            </div>
        {/if}
        <h2 class="event_register_subtitles">{"comment"|livetranslate}</h2>
        {* Bemerkungen *}
        <div class="event_register_wrapper">
            <div class="event_register_description">
                {"comment"|livetranslate}
            </div>
            <div class="event_register_value">
                <textarea name="x{$BASEID}_register[comment]" cols="" rows="">{$xt5100_registration.input_values.comment}</textarea>
            </div>
        </div>
        <div class="event_register_wrapper">
            <div class="event_register_description">
            </div>
            <div class="event_register_value">
            </div>
        </div>
        <div class="event_register_wrapper">
            <div class="event_register_description">
            </div>
            <div class="event_register_value">
                <input class="submit" type="submit" value="{"register"|livetranslate}" name="x{$BASEID}_register_submit" />
            </div>
        </div>
        <br class="clear" />
    </form>
{/if}