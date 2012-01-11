{XT_load_css file="downloadlist.css"}

<h1>{$DATA[$DATA.node_id].title}</h1>
{if $FILES|@count > 0}
    <div class="downloadlistwrapper">
        <table class="downloadlisttable">
            <tr class="downloadlistfilewrapper">
                <td class="downloadlistfiletitle">
                    <a href="index.php?TPL={$TPL}&amp;x{$BASEID}_order={$order.0.value}">
                        {if $DATA.order == "det.title"}<strong>{/if}
                        {"Filename"|translate}
                        {if $DATA.order == "det.title"}</strong>{/if}
                    </a>
                </td>
                <td class="downloadlistfilesize">
                    <a href="index.php?TPL={$TPL}&amp;x{$BASEID}_order={$order.1.value}">
                        {if $DATA.order == "f.filesize"}<strong>{/if}
                        {"File size"|translate}
                        {if $DATA.order == "f.filesize"}</strong>{/if}
                    </a>
                </td>
                <td class="downloadlistfiledate">
                    <a href="index.php?TPL={$TPL}&amp;x{$BASEID}_order={$order.2.value}">
                        {if $DATA.order == "f.upload_date"}<strong>{/if}
                        {"Date"|translate}
                        {if $DATA.order == "f.upload_date"}</strong>{/if}
                    </a>
                </td>
            </tr>
            {foreach from=$FILES item=FILE}
                <tr class="downloadlistfilewrapper">
                    <td class="downloadlistfiletitle">
                        <a href="/download.php?file_id={$FILE.id}&amp;download=true">
                            {$FILE.filename|icon}
                            {$FILE.title}
                        </a>
                        <br />
                        {if $FILE.description}
                            <span class="downloadlistfiledescription">{$FILE.description}</span>
                        {/if}
                    </td>
                    <td class="downloadlistfilesize">
                        {$FILE.filesize|format_filesize}
                    </td>
                    <td class="downloadlistfiledate">
                        {if $FILE.manual_date > 0}
                            {$FILE.manual_date|date_format:"%d.%m.%Y"}
                        {else}
                            {$FILE.upload_date|date_format:"%d.%m.%Y"}
                        {/if}
                    </td>
                </tr>
            {/foreach}
        </table>
    </div>
{/if}