<form method="POST" name="applications">
    {include file="includes/charfilter.tpl" form="applications"}
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td class="table_header" width="60">
                {"options"|translate}
            </td>
            <td class="table_header" width="150">
                {actionIcon
                    action="NULL"
                    form="applications"
                    label="application_from"
                    sort=$sort.0.value
                    icon=$sort.0.icon
                }
            </td>
            <td class="table_header" width="150">
                {actionIcon
                    action="NULL"
                    form="applications"
                    label="Job_title"
                    sort=$sort.1.value
                    icon=$sort.1.icon
                }
            </td>
            <td class="table_header" width="100">
                {actionIcon
                    action="NULL"
                    form="applications"
                    label="job_id"
                    sort=$sort.2.value
                    icon=$sort.2.icon
                }
            </td>
            <td class="table_header" width="70">
                {actionIcon
                    action="NULL"
                    form="applications"
                    label="date"
                    sort=$sort.3.value
                    icon=$sort.3.icon
                }
            </td>
        </tr>
        {foreach from=$DATA item=APPLICATION}
            <tr class="{cycle values="row_a,row_b"}">
                <td class="button">
                    {strip}
                    {actionIcon
                        action="editApplication"
                        form="0"
                        target="slave1"
                        icon="pencil.png"
                        perm="editApplication"
                        id=$APPLICATION.id
                        title="Edit this Application"
                    }
                    {actionIcon
                        action="sendApplication"
                        icon="mail.png"
                        form="applications"
                        id=$APPLICATION.id
                        title="Send this Application"
                        ask="Do you really want to send this application again?"
                    }
                    {actionIcon
                        action="deleteApplication"
                        form="applications"
                        icon="delete.png"
                        perm="deleteApplication"
                        id=$APPLICATION.id
                        title="Delete this Application"
                        ask="Do you really want to delete this Application?"
                    }
                    {/strip}
                </td>
                <td class="row">
                    {$APPLICATION.last_name} {$APPLICATION.first_name}
                </td>
                <td class="row">
                    {$APPLICATION.job_title}
                </td>
                <td class="row">
                    {$APPLICATION.job_id}
                </td>
                <td class="row">
                    {$APPLICATION.creation_date|date_format:"%d.%m.%Y"}
                </td>
            </tr>
        {/foreach}
    </table>
    {include file="includes/navigator.tpl" form="applications"}
    {include file="ch.iframe.snode.jobcenter/admin/hiddenvalues.tpl"}
</form>