<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$SYSTEM_LANG}" lang="{$SYSTEM_LANG}">
    <head>
        <title>{$TPL_TITLE}</title>
        {if $smarty.get.print}
            <link rel="stylesheet" type="text/css" href="{$XT_STYLES}live/%%THEME%%/print.css" media="screen" />
            <link rel="stylesheet" type="text/css" href="{$XT_STYLES}live/%%THEME%%/print.css" media="print" />
        {else}
            <link rel="stylesheet" type="text/css" href="{if $TPL_CSS != ''}{$TPL_CSS}{else}{$XT_STYLES}live/%%THEME%%/%%CSS%%{/if}" media="screen" />
            <link rel="stylesheet" type="text/css" href="{$XT_STYLES}live/%%THEME%%/print.css" media="print" />
        {/if}
        <!--%%XTCSSLOADER%%-->
        {XT_load_css file="jquery.tipTip.css"}
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="search" type="application/opensearchdescription+xml" title="{$SYSTEM_NAME}" href="/opensearch.xml.php" />
        {$META}
        <script type="text/javascript" src="{$XT_SCRIPTS}base.js"></script>
        <script type="text/javascript" src="{$XT_SCRIPTS}jquery.js"></script>
        <script type="text/javascript" src="{$XT_SCRIPTS}jquery.thickbox.js"></script>
        <script type="text/javascript" src="{$XT_SCRIPTS}jquery-ui/ui.core.js"></script>
        <!--%%XTSCRIPTLOADER%%-->
        {XT_load_js file="jquery-plugins/jquery.tipTip.js"}
        {XT_load_js file="jquery-plugins/call.jquery.tipTip.js"}
    </head>
    <body>
        {plugin package="ch.iframe.snode.toolbox" module="viewer"}
        <a name="top"></a>
        <div id="container_tb">
            <div id="container">
                <div id="header">
                    <a href="{$smarty.server.PHP_SELF}"><img src="/images/default/head.gif" alt="S-NODE XT default" /></a>
                    {image id=$HEADIMAGE version="orig" class="headimage"}
                </div>
                <div id="topnav">
                    {plugin package="ch.iframe.snode.navigation" module="tree" depth=1 open_depth=1 node="10000"}
                </div>
                <div id="sidenav">
                    {plugin package="ch.iframe.snode.navigation" module="tree" depth=2 start_level=2 node="10000" style="sidenav.tpl"}
                </div>
                <div id="content">