Kontaktformular
===============

Sie haben ein Formular-Mail von {$smarty.server.SERVER_NAME} erhalten.
Ausgefüllt von {$smarty.server.REMOTE_ADDR}


{foreach from=$ALL_FIELDS key=ELEMENT_ID item=INPUT name=I}
{if $INPUT.element_type != 14}{if $INPUT.element_type == 8 || $INPUT.element_type == 6}{$INPUT.label}
-------------------------------------------------
{else}
{$INPUT.label} {if $INPUT.element_type != 8}: {foreach from=$INPUT_VALUES.$ELEMENT_ID item=VALUE name=inputvalues}{$VALUE}{if $smarty.foreach.inputvalues.last != true},{/if}{/foreach}

{/if}{/if}{/if}{/foreach}