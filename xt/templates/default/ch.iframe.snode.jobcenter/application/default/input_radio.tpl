{foreach from=$FIELD.values item=VALUE name=V}
    <input
        type="radio"
        value="{$VALUE.value}"
        id="application_{$FIELD.label}_{$smarty.foreach.V.iteration}"
        name="application[{$FIELD.label}]"
        {if $xt1700_application.form.fillout}
            {if $xt1700_application.form.fillout[$FIELD.label] == $VALUE.value}checked="checked"{/if}
        {else}
            {if $FIELD.default == $VALUE.value}checked="checked"{/if}
        {/if}
    />
    <label for="application_{$FIELD.label}_{$smarty.foreach.V.iteration}">
        {$VALUE.label}
    </label><br />
{/foreach}