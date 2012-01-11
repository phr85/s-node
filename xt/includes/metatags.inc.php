<?php

global $meta;

$GLOBALS['meta'][] = '<meta name="generator" content="S-Node XT" />';

/**
 * The text can be used when printing a summary of the document. 
 * The text should not contain any formatting information. Used 
 * by some search engines to describe your document. Particularly 
 * important if your document has very little text, is a frameset, 
 * or has extensive scripts at the top.
 */
$GLOBALS['meta'][] = '<meta name="description" content="%%DESCRIPTION%%" />';

/**
 * The keywords are used by some search engines to index your 
 * document in addition to words from the title and document body. 
 * Typically used for synonyms and alternates of title words. 
 * Consider adding frequent misspellings. e.g. heirarchy, hierarchy.
 */
$GLOBALS['meta'][] = '<meta name="keywords" content="%%KEYWORDS%%" />';

/**
 * A copyright statement.
 */
$GLOBALS['meta'][] = '<meta name="copyright" content="' . $meta_copyright . '" />';

/**                          
 * The CONTENT field is a comma separated list:
 * INDEX: search engine robots should include this page.
 * FOLLOW: robots should follow links from this page to other pages.
 * NOINDEX: links can be explored, although the page is not indexed.
 * NOFOLLOW: the page can be indexed, but no links are explored.
 * NONE: robots can ignore the page.
 * NOARCHIVE: Google uses this to prevent archiving of the page. 
 * See http://www.google.com/bot.html
 */
$GLOBALS['meta'][] = '<meta name="robots" content="index, follow, noarchive" />';

/**
 * The author's email
 */
$GLOBALS['meta'][] = '<meta name="email" content="' . $GLOBALS['cfg']->get('system','email') . '" />';

/**
 * The author's name
 */
$meta_author != '' ? $GLOBALS['meta'][] = '<meta name="author" content="' . $meta_author . '" />' : null;

/**
 * The HTTP content type may be extended to give the 
 * character set. It is recommended to always use this 
 * tag and to specify the charset.
 */
$GLOBALS['meta'][] = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

/**
 * Declares the primary natural language(s) of the document. 
 * May be used by search engines to categorize by language.
 */
/*$GLOBALS['meta'][] = '<meta http-equiv="Content-Language" content="' . $meta_content_lang . '" />
 ';
*/
/**
 * This directive indicates cached information should not be 
 * used and instead requests should be forwarded to the origin 
 * server. This directive has the same semantics as the 
 * CACHE-CONTROL:NO-CACHE directive and is provided for backwards 
 * compatibility with HTTP/1.0.
 */ 
$GLOBALS['meta'][] = '<meta http-equiv="pragma" content="public" />';

/**
 * public - may be cached in public shared caches
 * private - may only be cached in private cache
 * no-cache - may not be cached
 * no-store - may be cached but not archived
 */
$GLOBALS['meta'][] = '<meta http-equiv="cache-control" content="private" />';

/**
 * To inform search engines when to come back and index your site again.
 */
$GLOBALS['meta'][] = '<meta name="revisit-after" content="' . $meta_revisit_after . '" />';

/**
 * The date and time after which the document should be considered 
 * expired. An illegal EXPIRES date, e.g. "0", is interpreted as "now". 
 * Setting EXPIRES to 0 may thus be used to force a modification check 
 * at each visit.
 * 
 * Web robots may delete expired documents from a search engine, or 
 * schedule a revisit.
 */
// $GLOBALS['meta'][] = '<meta http-equiv="expires" content="0" />';
?>