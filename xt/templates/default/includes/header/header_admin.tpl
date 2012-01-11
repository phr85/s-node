<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
 <title>{$SYSTEM_NAME} : {$TPL_TITLE|htmlspecialchars}</title>
 {$META}
 <link rel="stylesheet" href="{$XT_STYLES}admin/office2003.css" type="text/css" media="all"/>
  <link rel="stylesheet" href="{$XT_STYLES}live/jquery-ui-theme.css" type="text/css" media="all" />

<!--%%XTCSSLOADER%%-->
 <script type="text/javascript" src="{$XT_SCRIPTS}admin.js"></script>
<script type="text/javascript" src="{$XT_SCRIPTS}base.js"></script>
<script type="text/javascript" src="{$XT_SCRIPTS}jquery.js"></script>
<script type="text/javascript" src="{$XT_SCRIPTS}jquery.thickbox.js"></script>
<script type="text/javascript" src="{$XT_SCRIPTS}jquery-ui/ui.core.js"></script>
<script type="text/javascript" src="{$XT_SCRIPTS}jquery-ui/ui.datepicker.js"></script>
<!--%%XTSCRIPTLOADER%%-->
</head>
<body>
{if $smarty.get.adminmode ==1}
<table cellpadding="0" cellspacing="0" width="100%" style="height: 100%">
 <tr>
  <td id="header" colspan="2" valign="top"><a href="{$smarty.server.PHP_SELF}"><img src="{$XT_IMAGES}admin/snode.jpg" alt="" border="0" /></a></td>
 </tr>
 <tr>
  <td class="toolbar" style="height: 25px;"><img src="{$XT_IMAGES}admin/gfx/toolbar_left.gif" alt="" /><a href="{$smarty.server.PHP_SELF}?logout=1"><img src="{$XT_IMAGES}icons/exit.png" alt="" /></a><img style="margin-left: 175px;" src="{$XT_IMAGES}admin/gfx/toolbar_left.gif" alt="" /><a href="#" onclick="javascript:switchToolbar();"><img id="sidebar_icon" src="{$XT_IMAGES}icons/window_sidebar.png" alt="" /></a><br /></td>
  <td class="toolbar" align="right" style="padding: 0px; padding-right: 10px;">{if $DEFAULT_PASSWORD == 1}<span style="color:red;">{"You are still using the default password. Please change it in your settings!"|translate}</span>{/if}{if $smarty.session.user.lastName != ''}Willkommen, {/if}{$smarty.session.user.firstName} {$smarty.session.user.lastName} {if $smarty.session.user.lastName != ''}({/if}{$smarty.session.user.name}@{$smarty.server.HTTP_HOST}{if $smarty.session.user.lastName != ''}){/if}</td>
 </tr>
 <tr>
  <td class="desktop_container" colspan="2">

   <table cellspacing="0" cellpadding="0" width="100%" style="height: 100%">
    <tr>
     <td id="sidebar" style="width: 200px; padding-right: 3px;" valign="top">

      <table cellspacing="0" cellpadding="0" width="100%" class="left" style="height: 100%;">
       <tr>
        <td class="top_head">{plugin package="ch.iframe.snode.navigation" module="single_node" level="3" additional="adminmode=1"}</td>
       </tr>
       <tr>
        <td style="background-color: white; padding: 5px;" valign="top">{plugin package="ch.iframe.snode.navigation" module="tree" node="100" style="admin.tpl" start_level="2"}</td>
       </tr>
       <tr><td class="separator"><img src="{$XT_IMAGES}admin/gfx/separator.gif" alt="" /></td></tr>
       <tr>
        <td style="background-color: white; height:1px;" valign="top">{plugin package="ch.iframe.snode.navigation" module="tree" node="100" style="admin_level1.tpl" start_level="1" depth="1"}</td>
       </tr>
      </table>

     </td>
     <td>
      <table cellspacing="0" cellpadding="0" width="100%" style="height: 100%;">
       <tr>
        <td valign="top">
{/if}
