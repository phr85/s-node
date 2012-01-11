<h1>{"Address"|translate}</h1>
<table cellpadding="0" cellspacing="0" width="100%">
{if $DATA.user_id != ""}
<tr>
  <td class="inpl">{"Username"|translate}</td>
  <td class="inpr">{$DATA.user_id|xt_getUserProperties:"username"}</td>
</tr>
{/if}
<tr>
  <td class="inpl">{"Display name"|translate}</td>
  <td class="inpr">{$DATA.title}</td>
 </tr>
 <tr>
  <td class="inpl">{"First name"|translate} / {"Last name"|translate}</td>
  <td class="inpr">
  {if $DATA.gender == 0}{"Unknown"|translate}{/if}
 {if $DATA.gender == 1}{"Mr."|translate}{/if}
 {if $DATA.gender == 2}{"Mrs."|translate}{/if}
 {$DATA.firstName}&nbsp;{$DATA.lastName}
 </td>
 </tr>
 <tr>
  <td class="inpl">{"Position"|translate}</td>
  <td class="inpr">{$DATA.position}</td>
 </tr>
 <tr>
  <td class="inpl">{"Street"|translate}</td>
  <td class="inpr">{$DATA.street}</td>
 </tr>
 <tr>
  <td class="inpl">{"Postal code"|translate} / {"City"|translate}</td>
  <td class="inpr">
   {$DATA.postalCode}&nbsp;{$DATA.city}
  </td>
 </tr>
 <tr>
  <td class="inpl">{"Country"|translate}</td>
  <td class="inpr">
  {foreach from=$COUNTRIES item=COUNTRY}
    {if $COUNTRY.country == $DATA.country}{$COUNTRY.name}{/if}
   {/foreach}
  </td>
 </tr>
 <tr>
  <td class="inpl">{"Region"|translate}</td>
  <td class="inpr">
	 {foreach from=$REGIONS item=REGION}
   {if $REGION.region == $DATA.state}{$REGION.name}{/if}
   {/foreach}
  </td>
  </td>
 </tr>
  <tr>
   <td class="inpl">{"Website"|translate}</td>
   <td class="inpr"><a href="{$DATA.website}" target="_blank">{$DATA.website}</a></td>
  </tr>
  <tr>
   <td class="inpl">{"E-Mail (Business)"|translate}</td>
   <td class="inpr"><a href="mailto:{$DATA.email}">{$DATA.email}</a></td>
  </tr>	
  <tr>
   <td class="inpl">{"E-Mail (Private)"|translate}</td>
   <td class="inpr"><a href="mailto:{$DATA.email_private}">{$DATA.email_private}</a></td>
  </tr>
  <tr>
   <td class="inpl">{"Telephone (Business)"|translate}</td>
   <td class="inpr">{$DATA.tel}
   {if $DATA.tel != ''}<a href="callto://{$DATA.tel}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="inpl">{"Telephone (Private)"|translate}</td>
   <td class="inpr">{$DATA.tel_private}
   {if $DATA.tel_private != ''}<a href="callto://{$DATA.tel_private}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="inpl">{"Mobile (Business)"|translate}</td>
   <td class="inpr">{$DATA.tel_mobile}
   {if $DATA.tel_mobile != ''}<a href="callto://{$DATA.tel_mobile}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="inpl">{"Mobile (Private)"|translate}</td>
   <td class="inpr">{$DATA.tel_mobile_private}
   {if $DATA.tel_mobile_private != ''}<a href="callto://{$DATA.tel_mobile_private}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="inpl">{"Fax (Business)"|translate}</td>
   <td class="inpr">{$DATA.fax}
   {if $DATA.fax != ''}<a href="callto://{$DATA.fax}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  <tr>
   <td class="inpl">{"Fax (Private)"|translate}</td>
   <td class="inpr">{$DATA.fax_private}
   {if $DATA.fax_private != ''}<a href="callto://{$DATA.fax_private}"><img src="images/icons/telephone.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" /></a>{else}<img src="images/icons/telephone_na.png" style="padding-left: 5px; vertical-align: middle;" alt="{'Call'|translate}" title="{'Call'|translate}" />{/if}
   </td>
  </tr>
  </table>