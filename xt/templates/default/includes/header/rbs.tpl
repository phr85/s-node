<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$SYSTEM_LANG}" lang="{$SYSTEM_LANG}">
    <head>        <!--%%XTCSSLOADER%%-->
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
        {plugin package="ch.iframe.snode.core" module="toolbox"}
        <a name="top"></a>
        <div id="container_tb">
        <img src="/images/default/bordertop.gif" alt="" />
        <div id="container">
            <div id="header">
                <a href="{$smarty.server.PHP_SELF}"><img style="padding-top: 30px;" src="/images/default/head.gif" alt="S-NODE XT default" /></a>
                {image id=$HEADIMAGE version="orig" class="headimage"}
            </div>
            <div id="topnav">
                {plugin package="ch.iframe.snode.navigation" module="tree" depth=1 open_depth=1 node="10000"}
            </div>
            <div id="sidenav">
            <!--ajax package="ch.iframe.snode.roombooking" module="datepicker" name="picker1" rooms="1,2,3,4,5,6" style="default.tpl" child="iface1"-->
            {plugin package="ch.iframe.snode.roombooking" module="datepicker" rooms="1,2,3,4,6" style="default.tpl"}
            {plugin package="ch.iframe.snode.navigation" module="tree" depth=2 start_level=2 node="10000" style="sidenav.tpl"}
            </div>
            <div id="content">