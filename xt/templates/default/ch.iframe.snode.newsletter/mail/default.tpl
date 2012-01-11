<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>
<html>
<head>
<base href="http://{$smarty.server.SERVER_NAME}/" />
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
<title>{$xt5300_send.newsletter.title}</title>
<style type='text/css'>
<!--
{literal}
a:link{
text-decoration:none; color:#FF9e02;
}
a:hover{
text-decoration:none;
color:#000000;
}
html, body, textarea, td, th{
color:#000000;
font-family:Verdana,Arial,sans-serif;
font-size:10px;
font-weight:normal;
}
img{
border: 0px;
}


.magenta{
color:#a54164;
}
td.footer{
border-top:1px solid #a54164;
vertical-align: top;
}
{/literal}
-->
</style>
</head>
<body bgcolor='#CCCCCC'>
<table width='600' border='0' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>

<!-- BEGIN HEADER -->
<tr>
<tr>
<td style=' line-height:150%; padding-left:10px; padding-right:10px; padding-top:3px; padding-bottom:3px;'>
<br />
<span class="magenta" style="font-weight:bold;">Lieber {$xt5300_send.userdata.name|default:"Leser"}</span> <br /><br />

{$xt5300_send.newsletter.header}<br /><br />
{$xt5300_send.newsletter.content_html}<br /><br />
<img src="cid:{$xt5300_send.newsletter.image}_{$xt5300_send.newsletter.image_version}" alt="" />
</td>
</tr>
<tr>
<td><br /><br /><br /></td></tr>
{foreach from=$xt5300_send.chapters item=CHAPTER}
<tr>
<td>
<b>{$CHAPTER.title}</b><br />
{if $CHAPTER.image > 0}<img width="{$CHAPTER.image_width}" height="{$CHAPTER.image_height}" src="cid:{$CHAPTER.image}_{$CHAPTER.image_version}" alt="" align="left" />{/if}
{$CHAPTER.maintext}
{$CHAPTER.link}
<br />
<br />
</td>
</tr>
{/foreach}
</table>
<br />
{if $xt5300_send.userdata.email != ''}Abonent: {$xt5300_send.userdata.email}<br />{/if}
{if $xt5300_send.category.id != ''}Kategorie: {$xt5300_send.category.id}<br />{/if}
<br />
{$xt5300_send.newsletter.footer}
<img src="http://{$smarty.server.SERVER_NAME}/newsletter_views.php?newsletter_id={$xt5300_send.newsletter.id}&amp;user_id={$xt5300_send.userdata.id}" alt="" width="1" height="1"/>
</body>
</html>