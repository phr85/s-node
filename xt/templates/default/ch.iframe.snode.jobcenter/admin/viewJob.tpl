<div style="padding: 30px;">
    {subplugin package="ch.iframe.snode.jobcenter" module="viewer" job_id=$EDIT.id}
</div>
<form method="post" name="viewjob" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
    {include file="ch.iframe.snode.jobcenter/admin/hiddenvalues.tpl"}
</form>