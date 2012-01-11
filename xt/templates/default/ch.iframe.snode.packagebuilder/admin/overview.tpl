<form method="POST" name="overview" onSubmit="window.document.forms['overview'].x{$BASEID}_yoffset.value=window.pageYOffset;">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{"Installed Packages"|translate}</span>
  </td>
 </tr>
<tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="200">{"Build"|translate}</td>
   <td class="table_header" width="200">{"Sample data"|translate}</td>
   <td class="table_header">{"Name"|translate}</td>
   <td class="table_header" width="20">{"done"|translate}</td>
   <td class="table_header" width="40">{"date"|translate}</td>
  </tr>
  {foreach from=$INSTALLED item=PACKAGE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="row">{
       actionIcon
           action = "buildPackage"
           title = $PACKAGE.name
           form = "overview"
           icon = "lock.png"
           encode = 1
           yoffset="1"
           package = $PACKAGE.name
       }
       
       <a href="/index.php?TPL=1005&x6_package={$PACKAGE.name}&x6_package_version=closed&xdate={$TIME}">
       <img src="/images/icons/download.png" alt="" /></a>
       <!-- actionIcon
           action = "downloadPackage"
           title = $PACKAGE.name
           form= "overview"
           icon= "download.png"
           package = $PACKAGE.name
           yoffset="1"
           package_version = "closed"
       -->{
       actionIcon
           action = "buildPackage"
           title = $PACKAGE.name
           form= "overview"
           icon= "lock_open.png"
           yoffset="1"
           package = $PACKAGE.name
       }
       <a href="/index.php?TPL=1005&x6_package={$PACKAGE.name}&x6_package_version=open&xdate={$TIME}">
       <img src="/images/icons/factory.png" alt="factory version -- iframe internal use only" /></a>
       <!--
       actionIcon
           action = "downloadPackage"
           title = $PACKAGE.name
           form= "overview"
           icon= "download.png"
           package = $PACKAGE.name
           yoffset="1"
           package_version = "open"
       -->
       </td>
       <td class="row">{if $PACKAGE.sample_data_available}{
       actionIcon
           action = "buildSamplePackage"
           title = $PACKAGE.name
           form= "overview"
           icon= "lock_open.png"
           yoffset="1"
           package = $PACKAGE.name
       }{
       actionIcon
           action = "downloadPackage"
           title = $PACKAGE.name
           form= "overview"
           icon= "download.png"
           package = $PACKAGE.name
           yoffset="1"
           package_version = "sampledata"
       }{else}{$ICONSPACER}{/if}</td>
       <td class="row">{$PACKAGE.name}</td>
       <td class="row">{if $PACKAGE.package != "not_done"}<img src="{$XT_IMAGES}icons/check.png" alt="" />{else}...{/if}</td>
       <td class="row">{if $PACKAGE.package != "not_done"}{$PACKAGE.package.8|date_format:"%d.%m.%y %H:%I:%S"}{else}...{/if}</td>
      </tr>
  {/foreach}
 </table>
 <br />
 <input type="hidden" name="x{$BASEID}_package" value="">
 <input type="hidden" name="x{$BASEID}_package_version" value="">
 <input type="hidden" name="x{$BASEID}_encode" value="">
 {yoffset}
</form>