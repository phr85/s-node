{if $SHOWTITLEBAR}<div class="titlebar">{$TPL_REAL_TITLE}</div><br />{/if}
<span style="font-size: 14px;"><b>{$NEWS.title}</b></span>
{if $NEWS.subtitle != ''}{$NEWS.subtitle}<br /><br />{/if}
{if $NEWS.introduction != ''}<span style="color: black;">{$NEWS.introduction}</span><br />
<br />{/if}
<table cellspacing="0" cellpadding="0" style="margin-right: 15px;">
 <tr>
  {if $NEWS.image > 0}
  <td valign="top" style="padding-right: 20px;">
  {image
    id=$NEWS.image
    version=""
    title=$NEWS.title
    alt=$NEWS.title
  }</td>
  {/if}
  <td>
   {if $NEWS.maintext != ''}{$NEWS.maintext|nl2br}<br /><br />{/if}
   {foreach from=$CHAPTERS item=CHAPTER}
    <span style="font-size: 14px;"><b>{$CHAPTER.title}</b></span><br /><br />
    {if $CHAPTER.subtitle != ''}{$CHAPTER.subtitle}<br /><br />{/if}
    {if $CHAPTER.image > 0}
    <table cellspacing="0" cellpadding="0" align="left" style="margin: 0px 15px 3px 0px;">
     <tr>
      <td>{image
        id=$CHAPTER.image
        version=1
        title=$CHAPTER.title
        alt=$CHAPTER.title
      }</td>
     </tr>
    </table>{/if}
    {$CHAPTER.maintext|nl2br}
    <br /><br />
    {/foreach}
  </td>
 </tr>
</table>
