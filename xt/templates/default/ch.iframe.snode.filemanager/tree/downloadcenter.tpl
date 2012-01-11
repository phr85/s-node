{XT_load_css file="downloadcenter.css"}

{if $x240_tree.data|@count > 0}
    <div class="downloadcenterwrapper">
        {foreach from=$x240_tree.data item=NAV name=N}
            <div class="downloadcentertreewrapper">
                <div class="{if $NAV.level != 0}downloadcentertreename{else}downloadcentertreenamefirst{/if}" style="padding-left:{if $NAV.level == 0}10{else}{$NAV.level*10}{/if}px;">
                    {if $NAV.level != 0}
                        {if $NAV.itw}
                            <img class="downloadcenterfolder" src="/images/icons/folder_open.png" alt="" />
                        {else}
                            <img class="downloadcenterfolder" src="/images/icons/folder.png" alt="" />
                        {/if}
                    {/if}
                    <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_node={$NAV.id}">
                        <span class="downloadcenterfoldertitle {if $NAV.selected}bold{/if}">{$NAV.title}</span>
                    </a>
                </div>
                {if $NAV.level == 0}
                    <div class="downloadcentertreemeta">
                        <div class="downloadcenterfiledate">
                            {*"filedate"|livetranslate*}
                        </div>
                        <div class="downloadcenterfilesize">
                            {*"filesize"|livetranslate*}
                        </div>
                    </div>
                {/if}
            </div>
            {if $NAV.selected}
                {subplugin package="ch.iframe.snode.filemanager" module="downloadlist" order="det.title" count=1000 style="downloadcenter.tpl" node=$NAV.id}
            {/if}
        {/foreach}
    </div>
{/if}
<br style="clear: both;" />