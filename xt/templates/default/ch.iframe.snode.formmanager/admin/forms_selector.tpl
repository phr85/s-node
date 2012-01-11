<form action="{$smarty.server.PHP_SELF}" method="POST">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
    {foreach from=forms item=form}
        <tr>
            <td><img src="/images/icons/check.png" width="16" height="16" alt="{Select|translate} {$form.title}" /></td>
            <td>{$form.title}</td>
        </tr>
    {/foreach}
    </table>
</form>