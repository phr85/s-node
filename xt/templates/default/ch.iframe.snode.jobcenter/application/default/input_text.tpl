<input
    type="text"
    value="{if $xt1700_application.form.fillout}{$xt1700_application.form.fillout[$FIELD.label]}{elseif $FIELD.default != ""}{$FIELD.default}{/if}"
    id="application_{$FIELD.label}"
    {if $ERRORS|@count > 0}class="application_error"{/if}
    name="application[{$FIELD.label}]"
    size="{if $FIELD.size}{$FIELD.size}{else}20{/if}"
/>