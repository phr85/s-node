<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{$TPL_TITLE}</title>
        <link>http://{$smarty.server.SERVER_NAME}</link>
        <description>http://{$smarty.server.SERVER_NAME}</description>
        <language>de-de</language>
        <copyright>urheberrechtliche Informationen</copyright>
        <pubDate>{$smarty.now|rfc2822}</pubDate>
        <atom:link href="http://{$smarty.server.SERVER_NAME}{$smarty.server.PHP_SELF}?TPL={$TPL}" rel="self" type="application/rss+xml" />
        {foreach item=TICKET from=$xt8100_rss.data}
            <item>
                <title>{$TICKET.title}</title>
                <link>http://{$smarty.server.SERVER_NAME}{$smarty.server.PHP_SELF}?TPL={$xt8100_rss.taget_tpl}&amp;adminmode=1</link>
                <description>
                    <![CDATA[
                       {"Date"|translate}: {$TICKET.date|date_format:"%d.%m.%Y"}<br/>
                       {"Effort"|translate}: {$TICKET.work_time} {"Minutes"|translate}<br/><br/>
                       {$TICKET.description}<br/>          
                    ]]>
                </description>
                <author>
                {xt_getaddresses assign="SUPERVISOR_DETAILS" id=$TICKET.supervisor_address}
                {$SUPERVISOR_DETAILS.firstName|escape} {$SUPERVISOR_DETAILS.lastName|escape}
                </author>
                <pubDate>{$TICKET.creation_date|rfc2822}</pubDate>
                <guid>http://{$smarty.server.SERVER_NAME}{$smarty.server.PHP_SELF}?TPL={$xt8100_rss.taget_tpl}&amp;adminmode=1</guid>
            </item>
        {/foreach}
    </channel>
</rss>