<h1>{$IMAGE.title}</h1>
{$GALLERY.title}<br /><br />
<div style="float: left;">
{foreach from=$PREV_IMAGES item=PREV_IMAGE}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_view={$PREV_IMAGE.id}&amp;x{$BASEID}_id={$GALLERY.id}">{
image
    id=$PREV_IMAGE.id
    version=0
    title=$PREV_IMAGE.description
    alt=$PREV_IMAGE.title
    style="border: 1px solid #DDDDDD; margin-bottom: 7px;"
}</a><br />{/foreach}<img src="/images/spacer.gif" width="64" alt=""/></div>
<div style="float: right;">
{foreach from=$NEXT_IMAGES item=NEXT_IMAGE}<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_view={$NEXT_IMAGE.id}&amp;x{$BASEID}_id={$GALLERY.id}">{
image
    id=$NEXT_IMAGE.id
    version=0
    title=$NEXT_IMAGE.description
    alt=$NEXT_IMAGE.title
    style="border: 1px solid #DDDDDD; margin-bottom: 7px;"
}</a><br />{/foreach}<img src="/images/spacer.gif" width="64" alt=""/></div>
<div align="center">{image
    id=$IMAGE.id
    version=4
    title=$IMAGE.description
    alt=$IMAGE.title
    style="border: 1px solid #DDDDDD;"
}<br />
<br />
<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_view={$P_IMAGE.id}&amp;x{$BASEID}_id={$GALLERY.id}"><img src="/images/default/arrow_left.gif" alt="" /></a>&nbsp;
<b>{$IMAGE.title}</b>&nbsp;
<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_view={$N_IMAGE.id}&amp;x{$BASEID}_id={$GALLERY.id}"><img src="/images/default/arrow_right.gif" alt="" /></a>
{if $IMAGE.description != ''}<br /><br />{$IMAGE.description}{/if}<br /><br />&laquo; <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_id={$GALLERY.id}">{"Back to the overview"|translate}</a>
</div>