<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{$TPL_TITLE}</title>
        <link>http://{$smarty.server.SERVER_NAME}</link>
        <description>http://{$smarty.server.SERVER_NAME}</description>
        <language>de-de</language>
        <copyright>urheberrechtliche Informationen</copyright>
        <pubDate>{$TIME|rfc2822}</pubDate>
        <atom:link href="http://{$smarty.server.SERVER_NAME}{$smarty.server.PHP_SELF}?TPL={$TPL}" rel="self" type="application/rss+xml" />
        {foreach from=$DATA item=NEWS}
            <item>
                <title><![CDATA[ {$NEWS.title} ]]></title>
                <link>http://{$smarty.server.SERVER_NAME}{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&amp;x{$BASEID}_id={$NEWS.id}</link>
                <description>
                    <![CDATA[
                        {if $NEWS.image > 0}
                            {image
                                id=$NEWS.image
                                version=1
                                title=$NEWS.img_description
                                alt=$NEWS.img_alt
                                class="left"
                                hostname=true
                            }
                        {/if}
                        {if $NEWS.subtitle != ""}<b>{$NEWS.subtitle}:</b><br /><br />{/if}
                        {$NEWS.introduction}
                    ]]>
                </description>
                <author><![CDATA[ {$NEWS.author} ]]></author>
                <pubDate>{$NEWS.creation_date|rfc2822}</pubDate>
                <guid>http://{$smarty.server.SERVER_NAME}{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&amp;x{$BASEID}_id={$NEWS.id}</guid>
            </item>
        {/foreach}
    </channel>
</rss>