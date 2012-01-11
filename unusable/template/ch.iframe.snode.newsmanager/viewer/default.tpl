{if $SHOWTITLEBAR}<div class="titlebar">{$TPL_REAL_TITLE}</div><br />{/if}
<h1>{$NEWS.title}</h1>
{if $NEWS.subtitle != ''}<div class="subtitle">{$NEWS.subtitle}<br /><br /></div>{else}<br />{/if}
{if $NEWS.introduction != ''}<span class="introduction">{$NEWS.introduction}</span><br />{/if}
{if $NEWS.image > 0}{if $NEWS.image_zoom == 1}<a href="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_POPUP_TPL}&x{$FILEMANAGER_BASEID}_file_id={$NEWS.image}');">{else}{if $NEWS.image_link != ''}<a target="{$NEWS.image_link_target}" href="{$NEWS.image_link}">{/if}{/if}
{image
    id=$NEWS.image
    version=3
    title=$NEWS.title
    alt=$NEWS.title
    class="left"
}{if $NEWS.image_zoom == 1 || $NEWS.image_link != ''}</a>{/if}{/if}
{if $NEWS.maintext != ''}{$NEWS.maintext}{/if}
{$CHAPTERCONTENT}
<br />
<div class="chapter"></div>