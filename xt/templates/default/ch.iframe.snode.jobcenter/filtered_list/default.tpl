{if $xt1700_filtered_list.data|@count > 0}
    <table width="100%">
        <tr>
            <td><strong>{"Jobdescription"|livetranslate}</strong></td>
            <td><strong>{"Category"|livetranslate}</strong></td>
            <td><strong>{"Location"|livetranslate}</strong></td>
        </tr>
        {foreach from=$xt1700_filtered_list.data item=JOB name=J}
            <tr>
                <td>
                    <a href="/index.php?TPL={$xt1700_filtered_list.param.details_tpl}&amp;x{$BASEID}_job_id={$JOB.id}">
                        {$JOB.title}
                        {if $JOB.job_percentage_to != 100 || $JOB.job_percentage_from > 0}
                            ({if $JOB.job_percentage_from > 0}{$JOB.job_percentage_from} - {/if}{$JOB.job_percentage_to}%)
                        {/if}
                    </a>
                </td>
                <td>
                    {$JOB.cat_title}
                </td>
                <td>
                    {$JOB.location_city}
                </td>
            </tr>
        {/foreach}
    </table>
{/if}