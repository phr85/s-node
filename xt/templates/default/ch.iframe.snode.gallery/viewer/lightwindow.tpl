<h1>{$GALLERY.title}</h1>
<b>{$GALLERY.image_count}</b> {"Images"|translate} / <b>{$GALLERY.page_count}</b> {"Pages"|translate}
{if "edit"|permcheck}<a href="javascript:popup('/index.php?TPL=200&amp;module=slave1&amp;x{$BASEID}_action=editNode&amp;x{$BASEID}_livetpl=1&amp;x{$BASEID}_node_id={$GALLERY.id}',800,600,'editgalery')"><img src="/images/icons/edit_small.png" alt="" /></a>{/if}
<p>{if $GALLERY.description != ''}{$GALLERY.description}<br />{/if}</p>
{include file="ch.iframe.snode.gallery/viewer/default/navigator.tpl"}
<br />

{foreach from=$GALLERY.images item=IMAGE name=I}<div style="float: left; margin: 0px 15px 2px 0px;">
<a href="/download.php?file_id={$IMAGE.id}&amp;file_version=4&amp;lw=is.jpg" class="thickbox" rel="zoom{$GALLERY.id}" title="{$IMAGE.description}">
{image
    id=$IMAGE.id
    version=$GALLERY.image_version
    title=$IMAGE.description
    alt=$IMAGE.title
    style="border: 1px solid #DDDDDD;"}</a>
    <p>{if $SHOW_TITLES}<a href="/download.php?file_id={$IMAGE.id}&amp;file_version=4&amp;lw=is.jpg" class="thickbox"  rel="zoom_title{$GALLERY.id}" title="{$IMAGE.description}"><b>{$IMAGE.title}</b></a><br />{/if}{if $SHOW_VIEWS}{$IMAGE.views} {"Views"|translate}{/if}</p></div>
{if $smarty.foreach.I.iteration%$PER_LINE == 0}<br style="clear: both;"/>
{/if}
{/foreach}
{include file="ch.iframe.snode.gallery/viewer/default/navigator.tpl"}
<br style="clear: both;"/>