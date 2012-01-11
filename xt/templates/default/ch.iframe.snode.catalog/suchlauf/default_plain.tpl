{"Objekte die mit Ihrem Suchabo Übereinstimmen"}


{foreach from=$DATA name=p item=PRODUCT}
*******************************************************************************************************************
{$PRODUCT.title}
-------------------------------------------------------------------------------------------------------------------
{$PRODUCT.description}

Link: http://{$smarty.server.SERVER_NAME}/{$smarty.server.PHP_SELF}?TPL=10064&x{$BASEID}_article_id={$PRODUCT.id}
*******************************************************************************************************************


{/foreach}

