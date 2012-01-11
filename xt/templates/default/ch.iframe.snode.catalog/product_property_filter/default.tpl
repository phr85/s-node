<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="filter_{$PROPERTY}">
{if $TITLE}
<h2>{$TITLE}</h2>
{/if}
<select name="x{$BASEID}_property_{$PROPERTY}" onchange="submit();">
    <option value="not">{"Please Select"|translate}</option>
{foreach from=$DROPDOWN item=VALUE}
{if $VALUE.value != ""}
        <option value="{$VALUE.value}"{if $SELECTED == $VALUE.value} selected{/if}>{$VALUE.value}</option>
{/if}
    {/foreach}
</select>
</form>