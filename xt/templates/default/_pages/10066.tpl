<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$SYSTEM_LANG}" lang="{$SYSTEM_LANG}">
    <head>
        <title>{$TPL_TITLE}</title>
        {if $smarty.get.print}
            <link rel="stylesheet" type="text/css" href="{$XT_STYLES}live/print.css" media="screen" />
        {else}
            <link rel="stylesheet" type="text/css" href="{if $TPL_CSS != ''}{$TPL_CSS}{else}{$XT_STYLES}live/default.css{/if}" media="screen" />
            <link rel="stylesheet" type="text/css" href="{$XT_STYLES}live/print.css" media="print" />
        {/if}
        <link rel="shortcut icon" href="/favicon.ico" />
        {$META}
        <script type="text/javascript" src="{$XT_SCRIPTS}base.js"></script>
        <script type="text/javascript" src="{$XT_SCRIPTS}postajax.js"></script>
    </head>
    <body>

{plugin package="ch.iframe.snode.roombooking" module="create_booking" style="givendate.tpl"}

</body>
</html>