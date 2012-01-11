{if $SHOWTITLEBAR}<div class="titlebar">{$TPL_REAL_TITLE}</div><br />{/if}
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
 <td width="50%" valign="top" style="padding-right: 15px;">
  <div align="center"><img src="{$XT_IMAGES}live/swiss.gif" alt="" /></div>
  <span style="font-size: 14px;"><b>{$NEWS.title}</b></span>
  {if $NEWS.subtitle != ''}{$NEWS.subtitle}<br /><br />{/if}
  {if $NEWS.introduction != ''}<span style="color: black;">{$NEWS.introduction}</span><br />
  <br />{/if}{if $NEWS.maintext != ''}{$NEWS.maintext|nl2br}
  <br />
  <br />{/if}
    {foreach from=$CHAPTERS item=CHAPTER}
    <span style="font-size: 14px;"><b>{$CHAPTER.title}</b></span><br /><br />
    {if $CHAPTER.subtitle != ''}{$CHAPTER.subtitle}<br /><br />{/if}
    {if $CHAPTER.image > 0}
    <table cellspacing="0" cellpadding="0" align="left" style="margin: 0px 15px 3px 0px;">
     <tr>
      <td>{image
        id=$CHAPTER.image
        version=0
        title=$CHAPTER.title
        alt=$CHAPTER.title
      }</td>
     </tr>
    </table>{/if}
    {$CHAPTER.maintext|nl2br}
    <br /><br />
    {/foreach}
 </td>
 <td valign="top"><img src="{$XT_IMAGES}live/line.gif" alt="" /></td>
 <td width="50%" align="center" valign="top">
  {if $NEWS.image > 0}
  <table cellspacing="0" cellpadding="0" align="center" style="margin-right: 20px;">
   <tr>
    <td>{image
    id=$NEWS.image
    version=3
    title=$NEWS.title
    alt=$NEWS.title
    }</td>
   </tr>
  </table>{/if}
 </td>
</tr>
</table>