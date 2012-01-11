{if $xt1700_application.files|@count > 0}
    {foreach from=$xt1700_application.files item=FILE name=F}
        {$FILE.name}
        <input
            type="submit"
            value="{$FILE.name}"
            id="application_file_delete_{$smarty.foreach.F.iteration}"
            class="application_delete_file"
            name="application[delete_file]"
        />
        <input
            type="hidden"
            value="{$FILE.name}"
            id="application_files_{$smarty.foreach.F.iteration}_name"
            name="application[uploaded_files][{$smarty.foreach.F.iteration}][name]"
        />
        <input
            type="hidden"
            value="{$FILE.type}"
            id="application_files_{$smarty.foreach.F.iteration}_type"
            name="application[uploaded_files][{$smarty.foreach.F.iteration}][type]"
        />
        <input
            type="hidden"
            value="{$FILE.tmp_name}"
            id="application_files_{$smarty.foreach.F.iteration}_tmp_name"
            name="application[uploaded_files][{$smarty.foreach.F.iteration}][tmp_name]"
        />
        <input
            type="hidden"
            value="{$FILE.size}"
            id="application_files_{$smarty.foreach.F.iteration}_size"
            name="application[uploaded_files][{$smarty.foreach.F.iteration}][size]"
        />
        <br />
        {if $smarty.foreach.F.last}<br />{/if}
    {/foreach}
{/if}

<input
    type="file"
    value=""
    id="application_files"
    {if $ERRORS|@count > 0}class="application_error"{/if}
    name="application[files][]"
    size="{if $FIELD.size}{$FIELD.size}{else}21{/if}"
    multiple="multiple"
/>
<input
    type="submit"
    value="{"add_more_files"|translate}"
    id="application_add_more_files"
    name="application[add_more_files]"
/>