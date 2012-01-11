{if $SHOWTITLEBAR}<div class="titlebar">{$TPL_REAL_TITLE}</div><br />{/if}
<h1>{$NEWS.title}</h1>
{if $NEWS.subtitle != ''}{$NEWS.subtitle}<br /><br />{else}<br />{/if}
{if $NEWS.image > 0}{if $NEWS.image_zoom == 1}<a href="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_POPUP_TPL}&x{$FILEMANAGER_BASEID}_file_id={$NEWS.image}');">{else}{if $NEWS.image_link != ''}<a target="{$NEWS.image_link_target}" href="{$NEWS.image_link}">{/if}{/if}
{image
    id=$NEWS.image
    version=3
    title=$NEWS.title
    alt=$NEWS.title
    class="right_overview"
}</a>{/if}
{if $NEWS.introduction != ''}<span class="introduction">{$NEWS.introduction}</span><br /><br />{/if}
{if $NEWS.maintext != ''}{$NEWS.maintext|nl2br}<br />{/if}
<div class="clear"></div>
<table cellpadding="0" cellspacing="0" width="100%">
{foreach from=$CHAPTERS item=CHAPTER}
<tr>
 <td style="padding-right: 15px;" valign="top">
    <span style="font-size: 14px;"><b>{$CHAPTER.title}</b></span><br /><br />
    {if $CHAPTER.subtitle != ''}{$CHAPTER.subtitle}<br /><br />{/if}
    {$CHAPTER.maintext|nl2br}
    <br /><br />
 </td>
 <td valign="top" align="center" style="padding-left: 15px;">
  {if $CHAPTER.image > 0}
  <table cellspacing="0" cellpadding="0">
   <tr>
    <td>{image
    id=$CHAPTER.image
    version=3
    title=$CHAPTER.title
    alt=$CHAPTER.title
    }</td>
   </tr>
  </table>
  {if $CHAPTER.image_description != ''}<div class="subtitlebar" style="background-color: transparent;">{$CHAPTER.image_description}</div>{/if}<br />{/if}
 </td>
</tr>
{/foreach}
</table>