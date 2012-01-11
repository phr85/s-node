<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="x{$BASEID}_csearch">
<table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td>{"Category"|translate}</td>
        <td>{"Search in"|translate}</td>
    </tr>
    <tr>
        
        <td>
            <select name="x{$BASEID}_category">
                {foreach from=$CATEGORIES item=CATEGORY}
                    <option value="{$CATEGORY.node_id}"{if $CATEGORY_SELECTED == $CATEGORY.node_id} selected{/if}>{$CATEGORY.title}</option>
                {/foreach}
            </select>
        </td>
        <td>
            <select name="x{$BASEID}_field">
                {foreach from=$FIELDS item=FIELD}
                    <option value="{$FIELD.id}"{if $FIELD_SELECTED == $FIELD.id} selected{/if}>{$FIELD.title}</option>
                {/foreach}
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="text" name="x{$BASEID}_searchfor" value="{$SEARCH_FOR}" size="30">
            &nbsp;
            <input type="submit" name="x{$BASEID}_csearchbutton" value="{"Search"|translate}">
        </td>
    </tr>
</table>
{if $RESULTS !=""}
<h1>{"Results"|translate} ({$RESULTS_COUNT}):</h1>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
{foreach from=$RESULTS item=RESULT}
    <tr>
        <td><a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&amp;x{$BASEID}_article_id={$RESULT.article_id}">{$RESULT.title}</a></td>
    </tr>
{/foreach}
</table>
{/if}
</form>