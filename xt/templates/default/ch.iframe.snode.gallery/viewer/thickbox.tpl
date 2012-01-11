{XT_load_css file="ch.iframe.snode.gallery/thickbox.css"}
{XT_load_js file="jquery-plugins/jquery.mousewheel.js"}
{XT_load_js file="jquery-plugins/jScrollHorizontalPane.min.js"}
{XT_load_js file="ch.iframe.snode.gallery/thickbox.js"}

{* Das muss bei jedem Projekt einzeln angepasst werden *}
{assign var="SMALLIMAGEVERSION" value=6}
{assign var="BIGIMAGEVERSION" value=7}
{assign var="IMAGE_PADDING" value=5}
{assign var="ACTIVE_CLASS" value="thickboxgalleryelementactive"}
{assign var="INACTIVE_CLASS" value="thickboxgalleryelementinactive"}
{* EOF: Das muss bei jedem Projekt einzeln angepasst werden *}

{* Das aktive Bild bestimmen (wird nur benoetigt wenn kein Javacript vorhanden ist) *}
{get_value param="active_image" assign="ACTIVE_IMAGE"}
{if $ACTIVE_IMAGE == ""}
    {assign var="ACTIVE_IMAGE" value=0}
{/if}

{* Die Daten zu den Imageversionen zusammenstellen *}
{thickbox_get_image_version_info version=$SMALLIMAGEVERSION assign="SMALLIMAGEINFO"}
{thickbox_get_image_version_info version=$BIGIMAGEVERSION assign="BIGIMAGEINFO"}

{* Den Javascriptarray zusammenstellen *}
{thickbox_build_javascript_array gallery=$GALLERY activeclass=$ACTIVE_CLASS inactiveclass=$INACTIVE_CLASS imageversion=$BIGIMAGEVERSION}

{* Die breite des Scrollpane Inhalts berechnen *}
{assign var="IMAGE_COUNT" value=$GALLERY.images|@count}
{math equation="((a + b)*c)-b" a=$SMALLIMAGEINFO.width b=$IMAGE_PADDING c=$IMAGE_COUNT assign="CONTENTWIDTH"}

<div id="thickboxgallery_{$GALLERY.id}" class="thickboxgallerywrapper">
    <div class="thickboxgallerybigimagewrapper" style="height: {$BIGIMAGEINFO.height}px;">
        <div class="{$INACTIVE_CLASS}" style="height: {$BIGIMAGEINFO.height}px;">
            <img
                src="/download.php?file_id={$GALLERY.images.$ACTIVE_IMAGE.id}&amp;file_version={$BIGIMAGEVERSION}"
                alt="{$GALLERY.images.$ACTIVE_IMAGE.title}"
                width="{$BIGIMAGEINFO.width}"
                height="{$BIGIMAGEINFO.height}"
            />
        </div>
        <div class="{$ACTIVE_CLASS}" style="height: {$BIGIMAGEINFO.height}px;">
            <img
                src="/download.php?file_id={$GALLERY.images.$ACTIVE_IMAGE.id}&amp;file_version={$BIGIMAGEVERSION}"
                alt="{$GALLERY.images.$ACTIVE_IMAGE.title}"
                width="{$BIGIMAGEINFO.width}"
                height="{$BIGIMAGEINFO.height}"
            />
        </div>
    </div>
    <div class="thickboxgalleryimagetextwrapper">
        <div class="thickboxgalleryimagetitle">
            {$GALLERY.images.$ACTIVE_IMAGE.title}
        </div>
        <div class="thickboxgalleryimagedescription">
            {$GALLERY.images.$ACTIVE_IMAGE.description}
        </div>
    </div>
    <div class="thickboxgalleryscrollerwrapper">
        <div class="thickboxgalleryscrollerpane scroll-pane">
            <div class="thickboxgalleryscrollercontent" style="width: {$CONTENTWIDTH}px; height: {$SMALLIMAGEINFO.height}px;">
                {foreach from=$GALLERY.images item=IMAGE name=I}
                    <a href="/index.php?TPL={$TPL}&amp;x{$BASEID}_active_image={$smarty.foreach.I.iteration-1}" onclick="thickboxgalleryimagechange({$GALLERY.id}, {$smarty.foreach.I.iteration-1}, true); return false;">
                        <img
                            src="/download.php?file_id={$IMAGE.id}&amp;file_version={$SMALLIMAGEVERSION}"
                            alt="{$IMAGE.title}"
                            {if !$smarty.foreach.I.last}
                                style="padding-right: {$IMAGE_PADDING}px;"
                            {else}
                                onload="thickboxgalleryinit({$GALLERY.id}); return false;"
                            {/if}
                        />
                    </a>
                {/foreach}
            </div>
        </div>
    </div>
</div>
<br class="clear" />