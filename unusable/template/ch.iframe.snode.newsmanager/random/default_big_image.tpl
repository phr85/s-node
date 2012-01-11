{if $SHOWTITLEBAR}<div class="titlebar">{$NEWS.title}</div><br />{/if}
{if $NEWS.subtitle != ''}{$NEWS.subtitle}<br /><br />{/if}
{if $NEWS.introduction != ''}<span style="color: black;">{$NEWS.introduction}</span><br />
<br />{/if}
{if $NEWS.image > 0}
<table cellspacing="0" cellpadding="0" align="center">
 <tr>
  <td>{image
    id=$NEWS.image
    version=3
    title=$NEWS.title
    alt=$NEWS.title
  }</td>
 </tr>
</table>{/if}{if $NEWS.maintext != ''}{$NEWS.maintext|nl2br}
<br /><br />{/if}
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
