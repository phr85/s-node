<select
    id="application_{$FIELD.label}"
    {if $ERRORS|@count > 0}class="application_error"{/if}
    name="application[{$FIELD.label}][]"
    size="{$FIELD.size}"
    multiple="multiple"
>
    {if $FIELD.values|@count > 0}
        {foreach from=$FIELD.values item=VALUE name=V}
            <option
                value="{$VALUE.value}"
                {if $xt1700_application.form.fillout}
                    {foreach from=$xt1700_application.form.fillout[$FIELD.label] item=INPUT}
                        {if $INPUT == $VALUE.value}selected="selected"{/if}
                    {/foreach}
                {else}
                    {if $FIELD.default == $VALUE.value}selected="selected"{/if}
                {/if}
            >
                {$VALUE.label}
            </option>
        {/foreach}
    {else}
        <option value=""></option>
    {/if}
</select>