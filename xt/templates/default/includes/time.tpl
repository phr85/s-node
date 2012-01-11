<form method="POST">
 <input type="hidden" name="x{$BASEID}_action" value="">
 {foreach from=$BUTTONS item=BUTTON}
  <input type="submit" value="{$BUTTON.label}" name="submit_{$BUTTON.action}" class="{$BUTTON.class}" onclick="document.forms[0].x{$BASEID}_action.value='{$BUTTON.action}'">&nbsp;
 {/foreach}
 <br /><br />

<table border="0" cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2"><b>{"Active time interval"|translate}</b></td>
 </tr>
 <tr>
  <td class="left" width="200" valign="top">
   {"Active time interval disabled?"|translate}<br />
  </td>
  <td class="right">
   <input type="checkbox" name="x{$BASEID}_timeinterval" value="1" {if $CHECKED_TIMEINTERVAL==false}checked{/if}><br />
  </td>
 </tr>
 <tr>
  <td class="left" width="200" valign="top">
   {"From"|translate}
  </td>
  <td class="right">{"Hour"|translate}
   <select name="x{$BASEID}_rep_hstart" class="default">
    <option value="0" >00</option>
    <option value="1" >01</option>
    <option value="2" >02</option>
    <option value="3" >03</option>
    <option value="4" >04</option>
    <option value="5" >05</option>
    <option value="6" >06</option>
    <option value="7" >07</option>
    <option value="8" >08</option>
    <option value="9" >09</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
   </select>&nbsp;{"Minute"|translate}
   <select name="x{$BASEID}_rep_mstart" class="default">
    <option value="0" selected>00</option>
    <option value="5" >05</option>
    <option value="10" >10</option>
    <option value="15" >15</option>
    <option value="20" >20</option>
    <option value="25" >25</option>
    <option value="30" >30</option>
    <option value="35" >35</option>
    <option value="40" >40</option>
    <option value="45" >45</option>
    <option value="50" >50</option>
    <option value="55" >55</option>
    <option value="59" >59</option>
   </select>
   &nbsp;{"Date"|translate}
   <input type="text" name="x{$BASEID}_startdate" size="15" value="" class="default" maxlength="10" readonly>
   <img src="images/icons/calendar.png" width="16" height="16" border="0" alt="{'Calendar'|translate}" title="{'Opens the calendar'|translate}" />
  </td>
 </tr>
 <tr>
  <td class="left" width="200" valign="top">
   {"Until"|translate}
  </td>
  <td class="right">{"Hour"|translate}
   <select name="x{$BASEID}_rep_hend" class="default">
    <option value="0" >00</option>
    <option value="1" >01</option>
    <option value="2" >02</option>
    <option value="3" >03</option>
    <option value="4" >04</option>
    <option value="5" >05</option>
    <option value="6" >06</option>
    <option value="7" >07</option>
    <option value="8" >08</option>
    <option value="9" >09</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
   </select>&nbsp;{"Minute"|translate}
   <select name="x{$BASEID}_rep_mend" class="default">
    <option value="0" selected>00</option>
    <option value="5" >05</option>
    <option value="10" >10</option>
    <option value="15" >15</option>
    <option value="20" >20</option>
    <option value="25" >25</option>
    <option value="30" >30</option>
    <option value="35" >35</option>
    <option value="40" >40</option>
    <option value="45" >45</option>
    <option value="50" >50</option>
    <option value="55" >55</option>
    <option value="59" >59</option>
   </select>
   &nbsp;{"Date"|translate}
   <input type="text" name="x{$BASEID}_enddate" size="15" value="" class="default" maxlength="10" readonly>
   <img src="images/icons/calendar.png" width="16" height="16" border="0" alt="{'Calendar'|translate}" title="{'Opens the calendar'|translate}" />
  </td>
 </tr>
</table>
<br />
<table cellspacing="0" cellpadding="0" width="100%">

 <tr>
  <td class="table_header" colspan="2"><b>{"Recurring event"|translate}</b></td>
 </tr>
 <tr>
  <td class="left" width="200" valign="top">
   {"Recurring event disabled?"|translate}<br />
  </td>
  <td class="right">
   <input type="checkbox" name="x{$BASEID}_recurring" value="1" {if $CHECKED_TIMERECURRING==false}checked{/if}><br />
  </td>
 </tr>
 <tr>
  <td class="left" width="200" valign="top">
   {"Days of the week"|translate}
  </td>
  <td class="right">
   <input type="checkbox" name="x{$BASEID}_time[0]" value="0" {if $CHECKED_TIME[0]|default:""}checked{/if}>{"All"|translate}&nbsp;<br />
   <input type="checkbox" name="x{$BASEID}_time[2]" value="2" {if $CHECKED_TIME[2]|default:""}checked{/if}>{"Mo"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_time[3]" value="3" {if $CHECKED_TIME[3]|default:""}checked{/if}>{"Tu"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_time[4]" value="4" {if $CHECKED_TIME[4]|default:""}checked{/if}>{"We"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_time[5]" value="5" {if $CHECKED_TIME[5]|default:""}checked{/if}>{"Th"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_time[6]" value="6" {if $CHECKED_TIME[6]|default:""}checked{/if}>{"Fr"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_time[7]" value="7" {if $CHECKED_TIME[7]|default:""}checked{/if}>{"Sa"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_time[1]" value="1" {if $CHECKED_TIME[1]|default:""}checked{/if}>{"Su"|translate}<br />
  </td>
 </tr>
 <tr>
  <td class="left" width="200" valign="top">
   {"Days of the month"|translate}
  </td>
  <td class="right">
   <input type="checkbox" name="x{$BASEID}_timew[0]"  value="0" {if $CHECKED_TIMEW[0]|default:""}checked{/if} >{"All"|translate}&nbsp;<br />
   <input type="checkbox" name="x{$BASEID}_timew[1]"  value="1" {if $CHECKED_TIMEW[1]|default:""}checked{/if} >01&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[2]"  value="2" {if $CHECKED_TIMEW[2]|default:""}checked{/if} >02&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[3]"  value="3" {if $CHECKED_TIMEW[3]|default:""}checked{/if} >03&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[4]"  value="4" {if $CHECKED_TIMEW[4]|default:""}checked{/if} >04&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[5]"  value="5" {if $CHECKED_TIMEW[5]|default:""}checked{/if} >05&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[6]"  value="6" {if $CHECKED_TIMEW[6]|default:""}checked{/if} >06&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[7]"  value="7" {if $CHECKED_TIMEW[7]|default:""}checked{/if} >07&nbsp;<br />
   <input type="checkbox" name="x{$BASEID}_timew[8]"  value="8" {if $CHECKED_TIMEW[8]|default:""}checked{/if} >08&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[9]"  value="9" {if $CHECKED_TIMEW[9]|default:""}checked{/if} >09&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[10]" value="10"{if $CHECKED_TIMEW[10]|default:""}checked{/if}>10&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[11]" value="11"{if $CHECKED_TIMEW[11]|default:""}checked{/if}>11&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[12]" value="12"{if $CHECKED_TIMEW[12]|default:""}checked{/if}>12&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[13]" value="13"{if $CHECKED_TIMEW[13]|default:""}checked{/if}>13&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[14]" value="14"{if $CHECKED_TIMEW[14]|default:""}checked{/if}>14&nbsp;<br />
   <input type="checkbox" name="x{$BASEID}_timew[15]" value="15"{if $CHECKED_TIMEW[15]|default:""}checked{/if}>15&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[16]" value="16"{if $CHECKED_TIMEW[16]|default:""}checked{/if}>16&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[17]" value="17"{if $CHECKED_TIMEW[17]|default:""}checked{/if}>17&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[18]" value="18"{if $CHECKED_TIMEW[18]|default:""}checked{/if}>18&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[19]" value="19"{if $CHECKED_TIMEW[19]|default:""}checked{/if}>19&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[20]" value="20"{if $CHECKED_TIMEW[20]|default:""}checked{/if}>20&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[21]" value="21"{if $CHECKED_TIMEW[21]|default:""}checked{/if}>21&nbsp;<br />
   <input type="checkbox" name="x{$BASEID}_timew[22]" value="22"{if $CHECKED_TIMEW[22]|default:""}checked{/if}>22&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[23]" value="23"{if $CHECKED_TIMEW[23]|default:""}checked{/if}>23&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[24]" value="24"{if $CHECKED_TIMEW[24]|default:""}checked{/if}>24&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[25]" value="25"{if $CHECKED_TIMEW[25]|default:""}checked{/if}>25&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[26]" value="26"{if $CHECKED_TIMEW[26]|default:""}checked{/if}>26&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[27]" value="27"{if $CHECKED_TIMEW[27]|default:""}checked{/if}>27&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[28]" value="28"{if $CHECKED_TIMEW[28]|default:""}checked{/if}>28&nbsp;<br />
   <input type="checkbox" name="x{$BASEID}_timew[29]" value="29"{if $CHECKED_TIMEW[29]|default:""}checked{/if}>29&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[30]" value="30"{if $CHECKED_TIMEW[30]|default:""}checked{/if}>30&nbsp;
   <input type="checkbox" name="x{$BASEID}_timew[31]" value="31"{if $CHECKED_TIMEW[31]|default:""}checked{/if}>31<br />
  </td>
 </tr>
 <tr>
  <td class="left">
   {"Months of the year"|translate}
  </td>
  <td class="right">
   <input type="checkbox" name="x{$BASEID}_timem[0]"  value="0"  {if $CHECKED_TIMEM[0]|default:""}checked{/if}>{"All"|translate}&nbsp;<br />
   <input type="checkbox" name="x{$BASEID}_timem[1]"  value="1"  {if $CHECKED_TIMEM[1]|default:""}checked{/if}>{"January"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_timem[2]"  value="2"  {if $CHECKED_TIMEM[2]|default:""}checked{/if}>{"February"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_timem[3]"  value="3"  {if $CHECKED_TIMEM[3]|default:""}checked{/if}>{"March"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_timem[4]"  value="4"  {if $CHECKED_TIMEM[4]|default:""}checked{/if}>{"April"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_timem[5]"  value="5"  {if $CHECKED_TIMEM[5]|default:""}checked{/if}>{"May"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_timem[6]"  value="6"  {if $CHECKED_TIMEM[6]|default:""}checked{/if}>{"June"|translate}&nbsp;<br />
   <input type="checkbox" name="x{$BASEID}_timem[7]"  value="7"  {if $CHECKED_TIMEM[7]|default:""}checked{/if}>{"July"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_timem[8]"  value="8"  {if $CHECKED_TIMEM[8]|default:""}checked{/if}>{"August"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_timem[9]"  value="9"  {if $CHECKED_TIMEM[9]|default:""}checked{/if}>{"September"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_timem[10]" value="10" {if $CHECKED_TIMEM[10]|default:""}checked{/if}>{"October"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_timem[11]" value="11" {if $CHECKED_TIMEM[11]|default:""}checked{/if}>{"November"|translate}&nbsp;
   <input type="checkbox" name="x{$BASEID}_timem[12]" value="12" {if $CHECKED_TIMEM[12]|default:""}checked{/if}>{"December"|translate}<br />
  </td>
 </tr>
 <tr>
  <td class="left">
   Zeit
  </td>
  <td class="right">
  <input type="checkbox" name="x{$BASEID}_timeexact" value="1" {if $CHECKED_TIMEEXACT}checked{/if}>{"All"|translate}&nbsp;<br />
  {"Hour"|translate}
   <select name="x{$BASEID}_rep_hstart2" class="default">
    <option value="0" {if $CHECKED_R_HOURSTART[0]|default:""}selected{/if} >00</option>
    <option value="1" {if $CHECKED_R_HOURSTART[1]|default:""}selected{/if} >01</option>
    <option value="2" {if $CHECKED_R_HOURSTART[2]|default:""}selected{/if} >02</option>
    <option value="3" {if $CHECKED_R_HOURSTART[3]|default:""}selected{/if} >03</option>
    <option value="4" {if $CHECKED_R_HOURSTART[4]|default:""}selected{/if} >04</option>
    <option value="5" {if $CHECKED_R_HOURSTART[5]|default:""}selected{/if} >05</option>
    <option value="6" {if $CHECKED_R_HOURSTART[6]|default:""}selected{/if} >06</option>
    <option value="7" {if $CHECKED_R_HOURSTART[7]|default:""}selected{/if} >07</option>
    <option value="8" {if $CHECKED_R_HOURSTART[8]|default:""}selected{/if} >08</option>
    <option value="9" {if $CHECKED_R_HOURSTART[9]|default:""}selected{/if} >09</option>
    <option value="10"{if $CHECKED_R_HOURSTART[10]|default:""}selected{/if}>10</option>
    <option value="11"{if $CHECKED_R_HOURSTART[11]|default:""}selected{/if}>11</option>
    <option value="12"{if $CHECKED_R_HOURSTART[12]|default:""}selected{/if}>12</option>
    <option value="13"{if $CHECKED_R_HOURSTART[13]|default:""}selected{/if}>13</option>
    <option value="14"{if $CHECKED_R_HOURSTART[14]|default:""}selected{/if}>14</option>
    <option value="15"{if $CHECKED_R_HOURSTART[15]|default:""}selected{/if}>15</option>
    <option value="16"{if $CHECKED_R_HOURSTART[16]|default:""}selected{/if}>16</option>
    <option value="17"{if $CHECKED_R_HOURSTART[17]|default:""}selected{/if}>17</option>
    <option value="18"{if $CHECKED_R_HOURSTART[18]|default:""}selected{/if}>18</option>
    <option value="19"{if $CHECKED_R_HOURSTART[19]|default:""}selected{/if}>19</option>
    <option value="20"{if $CHECKED_R_HOURSTART[20]|default:""}selected{/if}>20</option>
    <option value="21"{if $CHECKED_R_HOURSTART[21]|default:""}selected{/if}>21</option>
    <option value="22"{if $CHECKED_R_HOURSTART[22]|default:""}selected{/if}>22</option>
    <option value="23"{if $CHECKED_R_HOURSTART[23]|default:""}selected{/if}>23</option>
   </select>&nbsp;{"Minute"|translate}
   <select name="x{$BASEID}_rep_mstart2" class="default">
    <option value="0"  {if $CHECKED_R_MINUTESTART[0]|default:""}selected{/if} >00</option>
    <option value="5"  {if $CHECKED_R_MINUTESTART[5]|default:""}selected{/if} >05</option>
    <option value="10" {if $CHECKED_R_MINUTESTART[10]|default:""}selected{/if} >10</option>
    <option value="15" {if $CHECKED_R_MINUTESTART[15]|default:""}selected{/if} >15</option>
    <option value="20" {if $CHECKED_R_MINUTESTART[20]|default:""}selected{/if} >20</option>
    <option value="25" {if $CHECKED_R_MINUTESTART[25]|default:""}selected{/if} >25</option>
    <option value="30" {if $CHECKED_R_MINUTESTART[30]|default:""}selected{/if} >30</option>
    <option value="35" {if $CHECKED_R_MINUTESTART[35]|default:""}selected{/if} >35</option>
    <option value="40" {if $CHECKED_R_MINUTESTART[40]|default:""}selected{/if} >40</option>
    <option value="45" {if $CHECKED_R_MINUTESTART[45]|default:""}selected{/if} >45</option>
    <option value="50" {if $CHECKED_R_MINUTESTART[50]|default:""}selected{/if}>50</option>
    <option value="55" {if $CHECKED_R_MINUTESTART[55]|default:""}selected{/if}>55</option>
    <option value="59" {if $CHECKED_R_MINUTESTART[59]|default:""}selected{/if}>59</option>
   </select>
    &nbsp;&nbsp;<b>{"Until"|translate}</b>&nbsp;&nbsp;{"Hour"|translate}
   <select name="x{$BASEID}_rep_hend2" class="default">
    <option value="0" {if $CHECKED_R_HOUREND[0]|default:""}selected{/if} >00</option>
    <option value="1" {if $CHECKED_R_HOUREND[1]|default:""}selected{/if} >01</option>
    <option value="2" {if $CHECKED_R_HOUREND[2]|default:""}selected{/if} >02</option>
    <option value="3" {if $CHECKED_R_HOUREND[3]|default:""}selected{/if} >03</option>
    <option value="4" {if $CHECKED_R_HOUREND[4]|default:""}selected{/if} >04</option>
    <option value="5" {if $CHECKED_R_HOUREND[5]|default:""}selected{/if} >05</option>
    <option value="6" {if $CHECKED_R_HOUREND[6]|default:""}selected{/if} >06</option>
    <option value="7" {if $CHECKED_R_HOUREND[7]|default:""}selected{/if} >07</option>
    <option value="8" {if $CHECKED_R_HOUREND[8]|default:""}selected{/if} >08</option>
    <option value="9" {if $CHECKED_R_HOUREND[9]|default:""}selected{/if} >09</option>
    <option value="10"{if $CHECKED_R_HOUREND[10]|default:""}selected{/if}>10</option>
    <option value="11"{if $CHECKED_R_HOUREND[11]|default:""}selected{/if}>11</option>
    <option value="12"{if $CHECKED_R_HOUREND[12]|default:""}selected{/if}>12</option>
    <option value="13"{if $CHECKED_R_HOUREND[13]|default:""}selected{/if}>13</option>
    <option value="14"{if $CHECKED_R_HOUREND[14]|default:""}selected{/if}>14</option>
    <option value="15"{if $CHECKED_R_HOUREND[15]|default:""}selected{/if}>15</option>
    <option value="16"{if $CHECKED_R_HOUREND[16]|default:""}selected{/if}>16</option>
    <option value="17"{if $CHECKED_R_HOUREND[17]|default:""}selected{/if}>17</option>
    <option value="18"{if $CHECKED_R_HOUREND[18]|default:""}selected{/if}>18</option>
    <option value="19"{if $CHECKED_R_HOUREND[19]|default:""}selected{/if}>19</option>
    <option value="20"{if $CHECKED_R_HOUREND[20]|default:""}selected{/if}>20</option>
    <option value="21"{if $CHECKED_R_HOUREND[21]|default:""}selected{/if}>21</option>
    <option value="22"{if $CHECKED_R_HOUREND[22]|default:""}selected{/if}>22</option>
    <option value="23"{if $CHECKED_R_HOUREND[23]|default:""}selected{/if}>23</option>
   </select>&nbsp;{"Minute"|translate}
   <select name="x{$BASEID}_rep_mend2" class="default">
    <option value="0"  {if $CHECKED_R_MINUTEEND[0]|default:""}selected{/if} >00</option>
    <option value="5"  {if $CHECKED_R_MINUTEEND[5]|default:""}selected{/if} >05</option>
    <option value="10" {if $CHECKED_R_MINUTEEND[10]|default:""}selected{/if} >10</option>
    <option value="15" {if $CHECKED_R_MINUTEEND[15]|default:""}selected{/if} >15</option>
    <option value="20" {if $CHECKED_R_MINUTEEND[20]|default:""}selected{/if} >20</option>
    <option value="25" {if $CHECKED_R_MINUTEEND[25]|default:""}selected{/if} >25</option>
    <option value="30" {if $CHECKED_R_MINUTEEND[30]|default:""}selected{/if} >30</option>
    <option value="35" {if $CHECKED_R_MINUTEEND[35]|default:""}selected{/if} >35</option>
    <option value="40" {if $CHECKED_R_MINUTEEND[40]|default:""}selected{/if} >40</option>
    <option value="45" {if $CHECKED_R_MINUTEEND[45]|default:""}selected{/if} >45</option>
    <option value="50" {if $CHECKED_R_MINUTEEND[50]|default:""}selected{/if}>50</option>
    <option value="55" {if $CHECKED_R_MINUTEEND[55]|default:""}selected{/if}>55</option>
    <option value="59" {if $CHECKED_R_MINUTEEND[59]|default:""}selected{/if}>59</option>
   </select>
  </td>
 </tr>
</table>
</form>