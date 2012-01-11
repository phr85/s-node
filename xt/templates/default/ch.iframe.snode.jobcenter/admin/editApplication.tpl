<form method="post" name="editApplication" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td class="view_header" colspan="2">
                <span class="title_light">{"application_from"|translate}:</span><span class="title">
                    {$VALUES.last_name.value} {$VALUES.first_name.value}
                </span>
            </td>
        </tr>
        <tr>
            <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
        </tr>
    </table>
    {include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}
    <table cellspacing="0" cellpadding="0" width="100%">
        {foreach from=$VALUES item=VALUE}
            <tr>
                <td class="left">
                    {$VALUE.key|translate}
                </td>
                <td class="right">
                    <textarea id="x{$BASEID}_application_values_{$VALUE.id}" name="x{$BASEID}_application[values][{$VALUE.id}]" cols="42" rows="1">{$VALUE.value}</textarea>
                    {*toggle_editor id="application_values_"|cat:$VALUE.id*}
                </td>
            </tr>
        {/foreach}
    </table>
    {include file="ch.iframe.snode.jobcenter/admin/hiddenvalues.tpl"}
</form>
{include file="includes/editor.tpl"}