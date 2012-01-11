<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
  <channel>
    <title>{$TPL_TITLE}</title>
    <link>{$smarty.server.hostname}</link>
    <description>Nachrichten aus der Kategorie Aktuelles</description>
    <language>de-de</language>
    <copyright>urheberrechtliche Informationen</copyright>
    <pubDate>{$TIME|rfc2822}</pubDate>
{foreach from=$DATA item=NEWS}
   <item>
      <title>{$NEWS.title}</title>
      <link>http://{$smarty.server.SERVER_NAME}{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&amp;x{$BASEID}_id={$NEWS.id}</link>
      <subtitle>{$NEWS.subtitle}</subtitle>
      <description>
        <![CDATA[{if $NEWS.image > 0}
    {image
    id=$NEWS.image
    version=1
    title=$NEWS.img_description
    alt=$NEWS.img_alt
    class="left"
    hostname=true}
    {/if}
    {if $NEWS.subtitle != ""}<b>{$NEWS.subtitle}:</b>{/if}
    {if $NEWS.date > 0}{$NEWS.date|date_format:"%d.%m.%Y"}{/if}  {$NEWS.introduction|truncate:255} <a style="font-weight:normal;" href="http://{$smarty.server.SERVER_NAME}{$smarty.server.PHP_SELF}?TPL={$TARGET_TPL}&amp;x{$BASEID}_id={$NEWS.id}">mehr</a>
        ]]>
      </description>
      <author>{$NEWS.autor}</author>
      <pubDate>{$NEWS.creation_date|rfc2822}</pubDate>
    </item>
{/foreach}
  </channel>
</rss>