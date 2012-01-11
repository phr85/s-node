<textarea
    id="application_{$FIELD.label}"
    {if $ERRORS|@count > 0}class="application_error"{/if}
    name="application[{$FIELD.label}]"
    cols="{if $FIELD.cols != ""}{$FIELD.cols}{else}35{/if}"
    rows="{if $FIELD.rows != ""}{$FIELD.rows}{else}5{/if}"
>{if $xt1700_application.form.fillout}{$xt1700_application.form.fillout[$FIELD.label]}{elseif $FIELD.default != ""}{$FIELD.default}{/if}</textarea>