<?php

// AdvancedBBCode 1.2
// http://software.unclassified.de/abbc
// Copyright 2003 by Yves Goergen
//
// Configuration File

// target frame and derefer script for auto-links
$GLOBALS['abbc_cfg']['target'] = '_blank';
$GLOBALS['abbc_cfg']['derefer'] = 'derefer.php?url=';

// activated subsets
$GLOBALS['abbc_cfg']['subsets'] = ABBC_ALL & ~ABBC_PARAGRAPH;
# & ~ABBC_SMILEYS;

// embed the text output in <div> tags
$GLOBALS['abbc_cfg']['output_div'] = true;

// automatically make URLs clickable
$GLOBALS['abbc_cfg']['find_urls'] = true;

// smiley images path (with trailing /)
$GLOBALS['abbc_cfg']['smilepath'] = "/images/emoticons/";

// base and monospace fonts
$GLOBALS['abbc_cfg']['basefont'] = "11px/16px Verdana,Arial,sans-serif";
$GLOBALS['abbc_cfg']['monofont'] = "12px/16px Andale Mono,Courier New,monospace";
$GLOBALS['abbc_cfg']['qnamefont'] = "italic 11px/13px Verdana,Arial,sans-serif";

// some tag's parameters, see abbc_css() for details
$GLOBALS['abbc_cfg']['custom_a'] = true;
$GLOBALS['abbc_cfg']['a_color'] = "#0040FF";
$GLOBALS['abbc_cfg']['a_decor'] = "none";
$GLOBALS['abbc_cfg']['a_color_hover'] = "#0040FF";
$GLOBALS['abbc_cfg']['a_decor_hover'] = "underline";
$GLOBALS['abbc_cfg']['m_color'] = "#009000";
$GLOBALS['abbc_cfg']['code_color'] = "#900000";
$GLOBALS['abbc_cfg']['code_back'] = "#E5E5E5";
$GLOBALS['abbc_cfg']['code_padding'] = "3px 2px 3px 2px";
$GLOBALS['abbc_cfg']['code_margin'] = "3px 0px";
$GLOBALS['abbc_cfg']['quote_borderl'] = "solid 2px #606060";
$GLOBALS['abbc_cfg']['quote_borderl2'] = "solid 2px #888888";
$GLOBALS['abbc_cfg']['quote_borderl3'] = "solid 2px #B0B0B0";
$GLOBALS['abbc_cfg']['quote_padding'] = "0px 0px 0px 10px";
$GLOBALS['abbc_cfg']['quote_margin'] = "3px 0px";
$GLOBALS['abbc_cfg']['qname_color'] = "#A0A000";
$GLOBALS['abbc_cfg']['par_margin'] = "10px 0px";

// here are the custom colors for PHP syntax highlighting
$GLOBALS['abbc_cfg']['use_custom_php'] = true;
$GLOBALS['abbc_cfg']['php_comment'] = "#808080";
$GLOBALS['abbc_cfg']['php_default'] = "#000000";
$GLOBALS['abbc_cfg']['php_html'] = "#006000";
$GLOBALS['abbc_cfg']['php_keyword'] = "#0000D0";
$GLOBALS['abbc_cfg']['php_string'] = "#900000";

// Tag Definitions

// Following information is necessary for a BBCode tag:
//   tag          how the [tag] is named
//   htmlopen     what it's to be translated into (parameters used by $1, $2...)
//   htmlcont     new content inside the HTML tags, normally something like $1, $2...
//   htmlclose    closing HTML tag (optional)
//   htmlblock    this defines its own block, new-lines around it are removed
//   maxparam     number of parameters for BBCode tag
//   openclose    has a closing tag, $htmlclose is needed
//   nocase       case-insensitive tagname (default, recommended)
//   nested       may this tag be nested? ex. [b]...[b]...[/b]...[/b]
//   proccont     process the tag's content? if no, nested is ignored
//   subset       what subset this tag belongs to

// Maximum parameter count is currently set to 3. You might want to change this.
// Relevant code locations are marked with MAXPARAM.

$tag = '#';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = false;
$GLOBALS['abbc_tags'][$tag]['proccont']   = false;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_DONTINT;

$tag = 'rem';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = true;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = false;
$GLOBALS['abbc_tags'][$tag]['proccont']   = false;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_DONTINT;

$tag = 'code';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "~\"<div class=code>\".";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "abbc_mask_specials(str_replace('\\\"','\"',rtrim('$1')),1).";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "\"</div>\"";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "~\"<div class=code>\".";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "abbc_mask_specials(str_replace('\\\"','\"',rtrim('$2')),\"$1\").";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "\"</div>\"";
$GLOBALS['abbc_tags'][$tag]['textcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = true;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = false;
$GLOBALS['abbc_tags'][$tag]['proccont']   = false;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_CODE;

$tag = 'quote';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "~\"<div class=quote>\".";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "trim(str_replace('\\\"','\"','\$1')).";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "\"</div>\"";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "--- Zitat:\n\$1\n---";
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "~\"<div class=quote><div class=qname>Zitat\".(trim(\"\$1\")==''?':':\" von \".trim(stripslashes(\"\$1\")).\":\").\"</div>\".";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "trim(str_replace('\\\"','\"','\$2')).";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "\"</div>\"";
$GLOBALS['abbc_tags'][$tag]['textcont1']  = "--- Zitat von \$1:\n\$2\n---";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = true;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_QUOTE;

$tag = 'b';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<b>";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "</b>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_SIMPLE;

$tag = 'i';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<i>";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "</i>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_SIMPLE;

$tag = 'u';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<u>";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "</u>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_SIMPLE;

$tag = 's';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<s>";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "</s>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_SIMPLE;

$tag = 'o';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<span style=\"border-top:1px solid black;margin-top:1px;\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "</span>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "<span style=\"border-top:1px solid \$1;margin-top:1px;\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "</span>";
$GLOBALS['abbc_tags'][$tag]['textcont1']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_SIMPLE;

$tag = 'm';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<tt>";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "</tt>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_SIMPLE;

$tag = 'url';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<a href=\"$1\" target=\"_blank\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "</a>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "<a href=\"$1\" target=\"_blank\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "</a>";
$GLOBALS['abbc_tags'][$tag]['textcont1']  = "\$2 [\$1]";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = false;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_URL;

$tag = 'mail';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<a href=\"mailto:\$1\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "</a>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "<a href=\"mailto:\$1\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$2 [\$1]";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "</a>";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = false;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_URL;

$tag = 'img';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "<img src=\"$1\">";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "(Bild: \$1)";
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "<img src=\"$2\" align=\"$1\">";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "";
$GLOBALS['abbc_tags'][$tag]['textcont1']  = "(Bild: \$2)";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = false;
$GLOBALS['abbc_tags'][$tag]['proccont']   = false;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_IMG;

$tag = 'br';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<br clear=all>";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\n";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['openclose']  = false;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = false;
$GLOBALS['abbc_tags'][$tag]['proccont']   = false;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_SIMPLE;

$tag = 'color';
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "<span style=\"color:\$1\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "</span>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_FONT;

$tag = 'font';
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "<span style=\"font-family:\$1\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "</span>";
$GLOBALS['abbc_tags'][$tag]['textcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlopen2']  = "<span style=\"font-family:\$1; font-size:\$2px; line-height:120%\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont2']  = "\$3";
$GLOBALS['abbc_tags'][$tag]['htmlclose2'] = "</span>";
$GLOBALS['abbc_tags'][$tag]['textcont2']  = "\$3";
$GLOBALS['abbc_tags'][$tag]['htmlopen3']  = "<span style=\"font-family:\$1; font-size:\$2px; line-height:\$3px\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont3']  = "\$4";
$GLOBALS['abbc_tags'][$tag]['htmlclose3'] = "</span>";
$GLOBALS['abbc_tags'][$tag]['textcont3']  = "\$4";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 3;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_FONT;

$tag = 'size';
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "<span style=\"font-size:\$1px; line-height:120%\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "</span>";
$GLOBALS['abbc_tags'][$tag]['textcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlopen2']  = "<span style=\"font-size:\$1px; line-height:\$2px\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont2']  = "\$3";
$GLOBALS['abbc_tags'][$tag]['htmlclose2'] = "</span>";
$GLOBALS['abbc_tags'][$tag]['textcont2']  = "\$3";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 2;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_FONT;

$tag = 'sup';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<sup>";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "</sup>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_FONT;

$tag = 'sub';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<sub>";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "</sub>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_FONT;

$tag = 'mark';
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "<span style=\"background-color:\$1\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "</span>";
$GLOBALS['abbc_tags'][$tag]['textcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_FONT;

$tag = 'align';
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "<div style=\"text-align:\$1\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "</div>";
$GLOBALS['abbc_tags'][$tag]['textcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = true;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_FONT;

$tag = 'line';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<br><div style=\"border-top:1px solid #000000; margin:8 0;\"></div>";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "----------";
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "<br><div style=\"border-top:1px solid \$1; margin:4 0;\"></div>";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "";
$GLOBALS['abbc_tags'][$tag]['textcont1']  = "----------";
$GLOBALS['abbc_tags'][$tag]['htmlopen2']  = "<br><div style=\"border-top:\$2px solid \$1; margin:8 0;\"></div>";
$GLOBALS['abbc_tags'][$tag]['htmlcont2']  = "";
$GLOBALS['abbc_tags'][$tag]['htmlclose2'] = "";
$GLOBALS['abbc_tags'][$tag]['textcont2']  = "----------";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = true;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 2;
$GLOBALS['abbc_tags'][$tag]['openclose']  = false;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = false;
$GLOBALS['abbc_tags'][$tag]['proccont']   = false;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_SIMPLE;

$tag = 'list';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<ul>";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "</ul>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "~abbc_begin_list(\"\$1\").";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "\"\$2\".";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "abbc_end_list(\"\$1\")";
$GLOBALS['abbc_tags'][$tag]['textcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = true;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_LIST;

$tag = '*';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<li>";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\n* ";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['openclose']  = false;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = false;
$GLOBALS['abbc_tags'][$tag]['proccont']   = false;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_LIST;

#$tag = ':';
#$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "~abbc_disp_smiley(\"\$1\")";
#$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "";
#$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "";
#$GLOBALS['abbc_tags'][$tag]['htmlblock']  = false;
#$GLOBALS['abbc_tags'][$tag]['minparam']   = 1;
#$GLOBALS['abbc_tags'][$tag]['maxparam']   = 1;
#$GLOBALS['abbc_tags'][$tag]['openclose']  = false;
#$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
#$GLOBALS['abbc_tags'][$tag]['nested']     = false;
#$GLOBALS['abbc_tags'][$tag]['proccont']   = false;
#$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_IMG;

$tag = 'indent';
$GLOBALS['abbc_tags'][$tag]['htmlopen0']  = "<div style=\"margin-left:20px\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlclose0'] = "</div>";
$GLOBALS['abbc_tags'][$tag]['textcont0']  = "\$1";
$GLOBALS['abbc_tags'][$tag]['htmlopen1']  = "<div style=\"margin-left:\$1px\">";
$GLOBALS['abbc_tags'][$tag]['htmlcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlclose1'] = "</div>";
$GLOBALS['abbc_tags'][$tag]['textcont1']  = "\$2";
$GLOBALS['abbc_tags'][$tag]['htmlblock']  = true;
$GLOBALS['abbc_tags'][$tag]['minparam']   = 0;
$GLOBALS['abbc_tags'][$tag]['maxparam']   = 1;
$GLOBALS['abbc_tags'][$tag]['openclose']  = true;
$GLOBALS['abbc_tags'][$tag]['nocase']     = true;
$GLOBALS['abbc_tags'][$tag]['nested']     = true;
$GLOBALS['abbc_tags'][$tag]['proccont']   = true;
$GLOBALS['abbc_tags'][$tag]['subset']     = ABBC_FONT;

unset($tag);

// Smiley Definitions

// Following information is necessary for a smiley:
//   code    the smiley's code -- NO "< > & [ ]" here!
//   img     image to be displayed
//   nocase  case-insensitive code (default, recommended) -- this is currently ignored: smileys ARE case-sensitive!
//   align   how to align the smiley <img>

// Note: For maximum performance with smileys, you should sort the smileys
//       in order of usage. So the most used smiley is defined first, aso.

$c = 0;

$GLOBALS['abbc_smileys'][$c]['code']   = ":-)";
$GLOBALS['abbc_smileys'][$c]['img']    = "smile.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ";-)";
$GLOBALS['abbc_smileys'][$c]['img']    = "wink.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":cheesy:";
$GLOBALS['abbc_smileys'][$c]['img']    = "cheesy.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":-D";
$GLOBALS['abbc_smileys'][$c]['img']    = "grins.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":-p";
$GLOBALS['abbc_smileys'][$c]['img']    = "razz.png";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":-/";
$GLOBALS['abbc_smileys'][$c]['img']    = "slash.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":#:";
$GLOBALS['abbc_smileys'][$c]['img']    = "confuse.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":-(";
$GLOBALS['abbc_smileys'][$c]['img']    = "sad.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":'(";
$GLOBALS['abbc_smileys'][$c]['img']    = "cry.png";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":cool:";
$GLOBALS['abbc_smileys'][$c]['img']    = "cool.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":motz:";
$GLOBALS['abbc_smileys'][$c]['img']    = "motz.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":finger:";
$GLOBALS['abbc_smileys'][$c]['img']    = "finger.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":red:";
$GLOBALS['abbc_smileys'][$c]['img']    = "redface.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":*)";
$GLOBALS['abbc_smileys'][$c]['img']    = "clown.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":zzz:";
$GLOBALS['abbc_smileys'][$c]['img']    = "sleep.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":heart:";
$GLOBALS['abbc_smileys'][$c]['img']    = "heart.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":moody:";
$GLOBALS['abbc_smileys'][$c]['img']    = "moody.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":gun:";
$GLOBALS['abbc_smileys'][$c]['img']    = "gun.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":ohr:";
$GLOBALS['abbc_smileys'][$c]['img']    = "ohren.png";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":-O";
$GLOBALS['abbc_smileys'][$c]['img']    = "gaehn.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":rolleyes:";
$GLOBALS['abbc_smileys'][$c]['img']    = "rolleyes.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = "8-(";
$GLOBALS['abbc_smileys'][$c]['img']    = "shocked.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":anx:";
$GLOBALS['abbc_smileys'][$c]['img']    = "uhoh.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":wand:";
$GLOBALS['abbc_smileys'][$c]['img']    = "wand.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":vogel:";
$GLOBALS['abbc_smileys'][$c]['img']    = "vogel.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

$c++;
$GLOBALS['abbc_smileys'][$c]['code']   = ":ss:";
$GLOBALS['abbc_smileys'][$c]['img']    = "hitler.gif";
$GLOBALS['abbc_smileys'][$c]['nocase'] = true;
$GLOBALS['abbc_smileys'][$c]['align']  = "absmiddle";

?>