{foreach from=$DATA item=FORMS name=export}{if $smarty.foreach.export.first}"Datum";"Referer";{foreach from=$FORMS.elements item=ELEMENT_DATA}"{$ELEMENT_DATA.label|addslashes} ({$ELEMENT_DATA.id})";{/foreach}

{/if}"{$FORMS.date_str}";"{$FORMS.referer}";{foreach from=$FORMS.elements item=ELEMENT_DATA}"{$ELEMENT_DATA.value|addslashes}";{/foreach}

{/foreach}
