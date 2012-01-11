{XT_load_css file="ch.iframe.snode.gallery/thickbox.css"}
{XT_load_js file="jquery-plugins/jquery.mousewheel.js"}
{XT_load_js file="jquery-plugins/jScrollHorizontalPane.min.js"}
{XT_load_js file="ch.iframe.snode.gallery/thickbox.js"}

<div>
{foreach from=$xt4100_thickbox.data item="GAL"}
<a class="thickbox" href="/ajax.php?package=ch.iframe.snode.gallery&module=viewer&x4100_id={$GAL.id}&param_style=thickbox.tpl&param_per_page=1000&width=550&height=500" target="_blank" title="{$GAL.title}">
    {image id=$GAL.image version=$xt4100_thickbox.metadata.version}
    {$GAL.title}
    {*$GAL.description *}
    </a>
{/foreach}
</div>