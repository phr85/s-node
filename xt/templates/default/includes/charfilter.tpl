<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="char{if $CHAR_FILTER == ''}_active{/if}" onclick="document.getElementById('char_filter').value='all';document.forms['{$form}'].submit();">All</td>
  <td class="char{if $CHAR_FILTER == 'a'}_active{/if}" onclick="document.getElementById('char_filter').value='a';document.forms['{$form}'].submit();">A</td>
  <td class="char{if $CHAR_FILTER == 'b'}_active{/if}" onclick="document.getElementById('char_filter').value='b';document.forms['{$form}'].submit();">B</td>
  <td class="char{if $CHAR_FILTER == 'c'}_active{/if}" onclick="document.getElementById('char_filter').value='c';document.forms['{$form}'].submit();">C</td>
  <td class="char{if $CHAR_FILTER == 'd'}_active{/if}" onclick="document.getElementById('char_filter').value='d';document.forms['{$form}'].submit();">D</td>
  <td class="char{if $CHAR_FILTER == 'e'}_active{/if}" onclick="document.getElementById('char_filter').value='e';document.forms['{$form}'].submit();">E</td>
  <td class="char{if $CHAR_FILTER == 'f'}_active{/if}" onclick="document.getElementById('char_filter').value='f';document.forms['{$form}'].submit();">F</td>
  <td class="char{if $CHAR_FILTER == 'g'}_active{/if}" onclick="document.getElementById('char_filter').value='g';document.forms['{$form}'].submit();">G</td>
  <td class="char{if $CHAR_FILTER == 'h'}_active{/if}" onclick="document.getElementById('char_filter').value='h';document.forms['{$form}'].submit();">H</td>
  <td class="char{if $CHAR_FILTER == 'i'}_active{/if}" onclick="document.getElementById('char_filter').value='i';document.forms['{$form}'].submit();">I</td>
  <td class="char{if $CHAR_FILTER == 'j'}_active{/if}" onclick="document.getElementById('char_filter').value='j';document.forms['{$form}'].submit();">J</td>
  <td class="char{if $CHAR_FILTER == 'k'}_active{/if}" onclick="document.getElementById('char_filter').value='k';document.forms['{$form}'].submit();">K</td>
  <td class="char{if $CHAR_FILTER == 'l'}_active{/if}" onclick="document.getElementById('char_filter').value='l';document.forms['{$form}'].submit();">L</td>
  <td class="char{if $CHAR_FILTER == 'm'}_active{/if}" onclick="document.getElementById('char_filter').value='m';document.forms['{$form}'].submit();">M</td>
  <td class="char{if $CHAR_FILTER == 'n'}_active{/if}" onclick="document.getElementById('char_filter').value='n';document.forms['{$form}'].submit();">N</td>
  <td class="char{if $CHAR_FILTER == 'o'}_active{/if}" onclick="document.getElementById('char_filter').value='o';document.forms['{$form}'].submit();">O</td>
  <td class="char{if $CHAR_FILTER == 'p'}_active{/if}" onclick="document.getElementById('char_filter').value='p';document.forms['{$form}'].submit();">P</td>
  <td class="char{if $CHAR_FILTER == 'q'}_active{/if}" onclick="document.getElementById('char_filter').value='q';document.forms['{$form}'].submit();">Q</td>
  <td class="char{if $CHAR_FILTER == 'r'}_active{/if}" onclick="document.getElementById('char_filter').value='r';document.forms['{$form}'].submit();">R</td>
  <td class="char{if $CHAR_FILTER == 's'}_active{/if}" onclick="document.getElementById('char_filter').value='s';document.forms['{$form}'].submit();">S</td>
  <td class="char{if $CHAR_FILTER == 't'}_active{/if}" onclick="document.getElementById('char_filter').value='t';document.forms['{$form}'].submit();">T</td>
  <td class="char{if $CHAR_FILTER == 'u'}_active{/if}" onclick="document.getElementById('char_filter').value='u';document.forms['{$form}'].submit();">U</td>
  <td class="char{if $CHAR_FILTER == 'v'}_active{/if}" onclick="document.getElementById('char_filter').value='v';document.forms['{$form}'].submit();">V</td>
  <td class="char{if $CHAR_FILTER == 'w'}_active{/if}" onclick="document.getElementById('char_filter').value='w';document.forms['{$form}'].submit();">W</td>
  <td class="char{if $CHAR_FILTER == 'x'}_active{/if}" onclick="document.getElementById('char_filter').value='x';document.forms['{$form}'].submit();">X</td>
  <td class="char{if $CHAR_FILTER == 'y'}_active{/if}" onclick="document.getElementById('char_filter').value='y';document.forms['{$form}'].submit();">Y</td>
  <td class="char{if $CHAR_FILTER == 'z'}_active{/if}" onclick="document.getElementById('char_filter').value='z';document.forms['{$form}'].submit();">Z</td>
  <td class="char{if $CHAR_FILTER == 'num'}_active{/if}" onclick="document.getElementById('char_filter').value='num';document.forms['{$form}'].submit();">#</td>
  <td class="char{if $CHAR_FILTER == 'special'}_active{/if}" onclick="document.getElementById('char_filter').value='special';document.forms['{$form}'].submit();">{"Others"|translate}</td>
  <td class="char_withoutwidth" width="100%">&nbsp;</td>
 </tr>
</table>
<input type="hidden" id="char_filter" name="x{$BASEID}_char_filter" value="{$CHAR_FILTER}" />