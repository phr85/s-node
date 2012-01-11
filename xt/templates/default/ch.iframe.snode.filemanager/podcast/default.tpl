<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">

  <channel>
    <title>{$TPL_TITLE}</title>
    <description>{$TPL_TITLE}</description>
    <link>http://{$smarty.server.SERVER_NAME}{$smarty.server.PHP_SELF}?TPL={$TPL}</link>
    <language>de</language>

    <lastBuildDate>{$FILES.0.upload_date|rfc2822}</lastBuildDate>
    <pubDate>{$FILES.0.upload_date|rfc2822"}</pubDate>
    <docs>http://blogs.law.harvard.edu/tech/rss</docs>
    <webMaster>rob@podcast411.com</webMaster>
    <itunes:author>rob @ podcast411</itunes:author>
    <itunes:subtitle>podCast411 is a show about interviewing other Podcasters, similar to Inside the Actors Studio except for Podcasting </itunes:subtitle>
    <itunes:summary>podCast411 is a show about interviewing ot
    her Podcasters, similar to Inside the Actors Studio except for Podcasting.  Eac
    h show we interview a different Podcaster to find out what Podcasts they are
    listening to, what their show is about, what they are using to create their Podcast and what
    advice they have for other Podcasters or those looking to become a Podcaster.  Plus we have
     news, notes and tech tips for Podcasting. </itunes:summary>

<itunes:image href="http://xtreme.s-node.org/download.php?file_id=188&amp;file_version=2"/>

{foreach from=$FILES item=FILE}
<item>
<title>
{$FILE.title|default:$FILE.filename}
</title>
<link><![CDATA[http://xtreme.s-node.org{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&file_name={$FILE.filename}]]></link>
<description>{$FILE.description}</description>
{if $USE_REWRITE}
<enclosure url="http://xtreme.s-node.org{$XT_WEB_ROOT}file_id/{$FILE.id}/file_name/{$FILE.filename}" length="{$FILE.filesize}" type="{$FILE.mimetype}" />
{else}
<enclosure url="http://xtreme.s-node.org{$XT_WEB_ROOT}download.php?file_id={$FILE.id}&amp;file_name={$FILE.filename}" length="{$FILE.filesize}" type="{$FILE.mimetype}" />
{/if}

<category>Podcasts</category>
<pubDate>{$FILE.upload_date|date_format:"%a, %d %b %Y %H:%M:%S"}</pubDate>
<itunes:explicit>No</itunes:explicit>
<itunes:subtitle>{$FILE.filename}</itunes:subtitle>
{if $FILE.description != ""}<itunes:summary>{$FILE.description}</itunes:summary>{/if}
{if $FILE.keywords != ""}<itunes:keywords>{$FILE.keywords}</itunes:keywords>{/if}
<gid>{$FILE.gid}</gid>
</item>
{/foreach}
</channel>

</rss>
