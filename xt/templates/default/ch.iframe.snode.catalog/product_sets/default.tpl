<h2>{$CATEGORY_TITLE}</h2>
<table width="100%" cellpadding="0" cellspacing="0">
{foreach from=$DATA item=PRODUCT}
    <tr>
        <td><a href="{$smarty.server.PHP_SELF}?TPL={get_param param="details_tpl"}&x{$BASEID}_article_id={$PRODUCT.id}">{$PRODUCT.title}</a><td>
    </tr>
{/foreach}
</table>