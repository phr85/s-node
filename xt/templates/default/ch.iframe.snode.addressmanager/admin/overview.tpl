{include file="includes/buttons.tpl" data=$BUTTONS}

<form method="POST" name="addresstable">
    {include file="includes/charfilter.tpl" form="addresstable"}
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td class="row" align="right" colspan="3">
                {"Zeige Adressen folgenden Typs"|translate}:
                <select name="x{$BASEID}_filtertype" onChange="this.form.submit();">
                    <option value="-1" {if $FILTERTYPE == -1}selected{/if}>{"All"|translate}</option>
                    <option value="-2" {if $FILTERTYPE == -2}selected{/if}>{"Undefined"|translate}</option>
                    {foreach from=$ADDRESSTYPES item=TYPE key=TYPEKEY}
                        <option value="{$TYPEKEY}" {if $FILTERTYPE == $TYPEKEY}selected{/if}>{$TYPE|translate}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        {* /* TODO Filter für addressübersicht implementieren
        {foreach from=$PROPERTIEFILTER item="PROPERTY" key="PROPERTYID"}
            <tr>
                <td class="row" align="right" colspan="3">
                    Filter {$PROPERTY}:
                    {subplugin package="ch.iframe.snode.properties" module="viewer" property=$PROPERTYID style="dropdown_addressfilter.tpl" SOURCEBASEID=$BASEID}
                </td>
            </tr>
        {/foreach}
        *}
        <tr>
            <td class="table_header" width="101">{"Options"|translate}</td>
            <td class="table_header" width="62">
                {actionIcon action="NULL" label="ID" form=addresstable sort=$sort.0.value icon=$sort.0.icon}
            </td>
            <td class="table_header">
                {actionIcon action="NULL" form=addresstable label="Display name" sort=$sort.1.value icon=$sort.1.icon}
            </td>
        </tr>
        {foreach from=$DATA item=ADDRESS name=ADDRESSTABLE}
            <tr class="{cycle values="row_a,row_b"}">
                <td class="button">
                    {if "edit"|allowed}
                        {if $ADDRESS.active == 1}
                            {actionIcon
                                action="deactivateAddress"
                                form="addresstable"
                                icon="active.png"
                                title="deactivate this address"
                                perm="edit"
                                id=$ADDRESS.id
                            }
                        {else}
                            {actionIcon
                                action="activateAddress"
                                form="addresstable"
                                icon="inactive.png"
                                title="activate this address"
                                perm="edit"
                                id=$ADDRESS.id
                            }
                        {/if}
                        {actionIcon
                            action="editAddress"
                            icon="pencil.png"
                            form="0"
                            target="slave1"
                            perm="edit"
                            id = $ADDRESS.id
                            title="Edit this user"
                        }
                    {/if}
                    {if "delete"|allowed && $ADDRESS.active == 0}
                        {actionIcon
                            action="deleteAddress"
                            icon="delete.png"
                            title="Delete this user"
                            perm="edit"
                            id=$ADDRESS.id
                            ask="Are you sure to delete this address?"
                            form="addresstable"
                        }
                    {/if}
                    {if $ADDRESS.lat > 0}
                        <img src="/images/icons/environment_ok.png" height="16" width="16" alt="ok" />
                    {else}
                        <img src="/images/icons/environment_warning.png" height="16" width="16" alt="warning" />
                    {/if}
                </td>
                <td class="row">{$ADDRESS.id}&nbsp;</td>
                <td class="row">
                    {if $ADDRESS.type == 0}
                        <img src="{$XT_IMAGES}icons/help2.png" alt="{"Person"|translate}"/>
                        {$ADDRESS.title}
                    {elseif $ADDRESS.type == 1}
                        <img src="{$XT_IMAGES}icons/factory.png" alt="{"Company"|translate}"/>
                        {if $ADDRESS.title != $ADDRESS.firstName|cat:" "|cat:$ADDRESS.lastName}
                            {$ADDRESS.title}, {$ADDRESS.firstName} {$ADDRESS.lastName}
                        {else}
                            {$ADDRESS.title}
                        {/if}
                    {elseif $ADDRESS.type == 2 }
                        <img src="{$XT_IMAGES}icons/member2.png" alt="{"Department"|translate}"/>
                        {$ADDRESS.title}
                        {if $ADDRESS.organisation_name != ""}
                            <i>({$ADDRESS.organisation_name})</i>
                        {/if}
                    {elseif $ADDRESS.type == 3}
                        <img src="{$XT_IMAGES}icons/user.png" alt="{"Person"|translate}"/>
                        {$ADDRESS.title}
                        {if $ADDRESS.organisation_name != ""}
                            <i>({$ADDRESS.organisation_name})</i>
                        {/if}
                        {if $ADDRESS.organizationalunit_name != ""}
                            <i>({$ADDRESS.organizationalunit_name})</i>
                        {/if}
                    {/if}
                    {if $ADDRESS.user_id != ""}
                        <img src="{$XT_IMAGES}icons/worker.png" alt="{"Address of a system user"|translate}"/>
                        <b>({$ADDRESS.user_name})</b>
                    {/if}
                </td>
            </tr>
        {/foreach}
    </table>
    {include file="includes/navigator.tpl" form="addresstable"}
    <input type="hidden" name="x{$BASEID}_id" value="" />
    <input type="hidden" name="x{$BASEID}_sort" value="" />
    <input type="hidden" name="x{$BASEID}_action" value="" />
</form>