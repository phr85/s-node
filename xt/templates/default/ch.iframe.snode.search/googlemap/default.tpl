<?xml version="1.0" encoding="UTF-8" ?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
{foreach from=$DATA item=page}
   <url>
    <loc>http://{$smarty.server.SERVER_NAME}{$page.url}</loc>
    <lastmod>{$page.lastmod|rfc2822}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
   </url>
{/foreach}
</urlset>
