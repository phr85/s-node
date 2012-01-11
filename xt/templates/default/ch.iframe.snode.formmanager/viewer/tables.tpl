<form method="post" name="form{$FORM.id}" enctype="multipart/form-data" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" style="margin: 0xp;">
    <h1>{$FORM.title}</h1>
    {if $FORM.description != ''}<br />{$FORM.description}<br /><br />{/if}
    <div id="form_container">
        {foreach from=$ELEMENTS item=ELEMENT}
            {if $ELEMENT.element_type == 8}
                <div class="form_separator">{$ELEMENT.label}</div>
            {else}
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td width="180" style="padding: 5px; padding-left: 0px;" valign="top">{$ELEMENT.label} {if $ELEMENT.required}<span style="color: red;">*</span>{/if}</td>
                        <td style="padding: 5px;">{include file="includes/form_elements.tpl"}</td>
                    </tr>  
                </table>
            {/if}
        {/foreach}
        <input type="submit" value="{'Submit'|translate}" />
        <input type="hidden" name="x{$BASEID}_form_id" value="{$FORM.id}" />
    </div>
</form>