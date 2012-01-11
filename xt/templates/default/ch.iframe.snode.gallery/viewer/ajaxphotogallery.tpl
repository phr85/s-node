{if $GALLERY.images|@count > 0}

    {* Variablen zu definieren, ACHTUNG nur Bildversionen verwenden mit Breite und Höhenangabe *}
    {assign var="SMALLIMAGEVERSION" value=6}
    {assign var="BIGIMAGEVERSION" value=7}
    {assign var="BORDER" value=1}
    {assign var="BORDERCOLOR" value="D4D7DE"}
    {assign var="PADDING" value=10}
    
    {* Die Daten zu den Imageversionen zusammenstellen *}
    {get_image_version_info version=$SMALLIMAGEVERSION assign="SMALLIMAGEINFO"}
    {get_image_version_info version=$BIGIMAGEVERSION assign="BIGIMAGEINFO"}
    
    {* Die breite des Scrollpane Inhalts berechnen *}
    {assign var="IMAGE_COUNT" value=$GALLERY.images|@count}
    {math equation="((a + b)*c)-b" a=$SMALLIMAGEINFO.width b=$PADDING c=$IMAGE_COUNT assign="CONTENTWIDTH"}
    
    {* CSS laden *}
    {XT_load_css file="ch.iframe.snode.gallery/ajaxphotogallery.css"}
    
    {* Galerie *}
    <div id="ajaxphotogalleryoverallwrapper" style="width: {$BIGIMAGEINFO.width+2*$PADDING+2*$BORDER}px;">
        <h1>{$GALLERY.title}</h1>
        {if $$GALLERY.description != ""}
            <div id="ajaxphotogallerydescription">{$GALLERY.description}</div>
        {/if}
        <div id="ajaxphotogallery" style="width: {$BIGIMAGEINFO.width}px; padding: {$PADDING}px; border: {$BORDER}px solid #{$BORDERCOLOR};">
            <div id="ajaxphotogalleryimagearea">
                <div id="ajaxphotogalleryimage" style="width: {$BIGIMAGEINFO.width}px; height: {$BIGIMAGEINFO.height}px;">
                    <a href="javascript:slideShow.nav(-1)" class="ajaxphotogalleryimgnav " id="ajaxphotogalleryprevimg" style="height: {$BIGIMAGEINFO.height}px;"></a>
                    <a href="javascript:slideShow.nav(1)" class="ajaxphotogalleryimgnav " id="ajaxphotogallerynextimg" style="height: {$BIGIMAGEINFO.height}px;"></a>
                </div>
            </div>
            <div id="ajaxphotogallerythumbwrapper" style="width: {$BIGIMAGEINFO.width}px; height: {$SMALLIMAGEINFO.height}px; padding-top: {$PADDING}px;">
                <div id="ajaxphotogallerythumbarea" style="width: {$BIGIMAGEINFO.width}px; height: {$SMALLIMAGEINFO.height}px;">
                    <ul id="ajaxphotogallerythumbs" style="width: {$CONTENTWIDTH}px; height: {$SMALLIMAGEINFO.height}px;">
                        {foreach from=$GALLERY.images item=IMAGE name=I}
                            <li value="{$IMAGE.id}" {if !$smarty.foreach.I.last}style="padding-right: {$PADDING}px;"{/if}>
                                <img src="/download.php?file_id={$IMAGE.id}&amp;file_version={$SMALLIMAGEVERSION}" alt="{$IMAGE.title}" />
                            </li>
                        {/foreach}
                    </ul>
                    {* Pfeile unten *}
                    <div class="ajaxphotogalleryimgnavbottom " id="ajaxphotogalleryprevimgbottom" style="height: {$SMALLIMAGEINFO.height}px;"></div>
                    <div class="ajaxphotogalleryimgnavbottom " id="ajaxphotogallerynextimgbottom" style="height: {$SMALLIMAGEINFO.height}px;"></div>
                </div>
            </div>
        </div>
    </div>
    
    {* ACHTUNG: Das muss hier stehen, sonst funktioniert die Galerie nicht !!! *}
    <script type="text/javascript">
        var imgid = 'ajaxphotogalleryimage';
        var thumbid = 'ajaxphotogallerythumbs';
        var version = {$BIGIMAGEVERSION};
        var auto = true;
        var autodelay = 5;
    </script>
    <script type="text/javascript" src="/scripts/ch.iframe.snode.gallery/ajaxphotogallery.js"></script>

{/if}