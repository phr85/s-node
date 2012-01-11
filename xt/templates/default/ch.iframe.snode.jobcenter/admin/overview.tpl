<form method="POST" name="overview">
    {include file="includes/buttons.tpl" data=$BUTTONS withouthidden=1}
    {include file="includes/lang_selector_simple.tpl" form="overview"}
    {include file="includes/charfilter.tpl" form="overview"}
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td class="table_header" width="100">
                {"Options"|translate}
            </td>
            <td class="table_header" width="200">
                {actionIcon
                    action="NULL"
                    form="overview"
                    label="Job_title"
                    sort=$sort.0.value
                    icon=$sort.0.icon
                }
            </td>
            <td class="table_header" width="200">
                {actionIcon
                    action="NULL"
                    form="overview"
                    label="Location"
                    sort=$sort.1.value
                    icon=$sort.1.icon
                }
            </td>
            <td class="table_header" width="60">
                {actionIcon
                    action="NULL"
                    form="overview"
                    label="Job_ID"
                    sort=$sort.2.value
                    icon=$sort.2.icon
                }
            </td>
            <td class="table_header" width="60">
                {actionIcon
                    action="NULL"
                    form="overview"
                    label="Job Nr."
                    sort=$sort.3.value
                    icon=$sort.3.icon
                }
            </td>
        </tr>
        {foreach from=$DATA item=JOB name=JOBTABLE}
            <tr class="{cycle values="row_a,row_b"}">
                <td class="button">
                    {strip}
                    {actionIcon
                        action="viewJob"
                        form="0"
                        target="slave1"
                        icon="view.png"
                        perm="editJobs"
                        id=$JOB.id
                        title="Preview this job offer"
                    }
                    {if $JOB.active == 1}
                        {actionIcon
                            action="deactivateJobLang"
                            icon="active.png"
                            form="overview"
                            perm="changeStatus"
                            id=$JOB.id
                            title="Deactivate this job offer"
                        }
                    {else}
                        {actionIcon
                            action="activateJobLang"
                            icon="inactive.png"
                            form="overview"
                            perm="changeStatus"
                            id=$JOB.id
                            title="Activate this job offer"
                        }
                    {/if}
                    {actionIcon
                        action="editJob"
                        form="0"
                        target="slave1"
                        icon="pencil.png"
                        perm="editJobs"
                        id=$JOB.id
                        title="Edit this job"
                    }
                    {actionIcon
                        action="copyJob"
                        icon="copy.png"
                        form="overview"
                        perm="copyJobs"
                        id=$JOB.id
                        title="Copy this job"
                    }
                    {actionIcon
                        action="deleteJob"
                        form="overview"
                        icon="delete.png"
                        perm="deleteJobs"
                        id=$JOB.id
                        title="Delete this job"
                        ask="Do you really want to delete this job?"
                    }
                    {/strip}
                </td>
                <td class="row">
                    {actionLink
                        action="editJob"
                        form="0"
                        target="slave1"
                        perm="editJobs"
                        id=$JOB.id
                        text=$JOB.title|truncate:40:"...":true
                    }
                    ({$JOB.application_count})
                </td>
                <td class="row">
                    {if $JOB.location_city != ''}
                        {$JOB.location_city}
                    {else}
                        <span style="color: #999999;">N / A</span>
                    {/if}
                </td>
                <td class="row">
                    {$JOB.id}
                </td>
                <td class="row">
                    {if $JOB.job_id != ""}
                        {$JOB.job_id}
                    {else}
                        <span style="color: #999999;">N / A</span>
                    {/if}
                </td>
            </tr>
        {/foreach}
    </table>
    {include file="includes/navigator.tpl" form="overview"}
    {include file="ch.iframe.snode.jobcenter/admin/hiddenvalues.tpl"}
</form>
