{* ACHTUNG: Dieses Template wird aus dem Tree aufgerufen, um ein Downloadcenter zu erstellen den folgenden Pluginaufruf verwenden:
{plugin package="ch.iframe.snode.filemanager" module="tree" node=47 show_start_node=1 style="downloadcenter.tpl"}
*}

{foreach from=$FILES item=FILE name="downloadcenter"}
    <div class="downloadcenterfilewrapper">
        <div class="downloadcenterfiledata" style="padding-left:{$NAV.level*10+15}px;">
            <div class="downloadcenterfilename">
                {$FILE.filename|icon:"downloadcenterfileicon"}
                <a href="{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&amp;download=true">
                    <span class="downloadcenterfiletitle">{$FILE.title}</span>
                </a>
            </div>
        </div>
        <div class="downloadcenterfilemeta">
            <div class="downloadcenterfiledate">
                {if $FILE.manual_date > 0}
                    {$FILE.manual_date|date_format:"%d.%m.%Y"}
                {else}
                    {$FILE.upload_date|date_format:"%d.%m.%Y"}
                {/if}
            </div>
            <div class="downloadcenterfilesize">
                {$FILE.filesize|format_filesize}
            </div>
        </div>
    </div>
{/foreach}