<h1>Benutzer Verzeichnis</h1>
<a href="#A">A</a>
<a href="#B">B</a>
<a href="#C">C</a>
<a href="#D">D</a>
<a href="#E">E</a>
<a href="#F">F</a>
<a href="#G">G</a>
<a href="#H">H</a>
<a href="#I">I</a>
<a href="#J">J</a>
<a href="#K">K</a>
<a href="#L">L</a>
<a href="#M">M</a>
<a href="#N">N</a>
<a href="#O">O</a>
<a href="#P">P</a>
<a href="#Q">Q</a>
<a href="#R">R</a>
<a href="#S">S</a>
<a href="#T">T</a>
<a href="#U">U</a>
<a href="#V">V</a>
<a href="#W">W</a>
<a href="#X">X</a>
<a href="#Y">Y</a>
<a href="#Z">Z</a>
<br /><br />
{foreach from=$ENTRIES key=LETTER item=ETS}
<h2>{$LETTER}<a name="{$LETTER}">&nbsp;</a></h2>
<div style="float: right;"><a href="#top">{"Top"|translate}</a></div>
{foreach from=$ETS item=ENTRY}
<a href="{$ENTRY.url}" style="color: #999999;">{$ENTRY.username}</a><br />
{/foreach}
<br />
{/foreach}