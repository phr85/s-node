<?php
$value = XT::getValue("value");
$value["product"][0] = "ch.iframe.snode.addresses";
$value["product"][1] = "ch.iframe.snode.areas";
$value["product"][2] = "ch.iframe.snode.articles";
$value["product"][3] = "ch.iframe.snode.autopilot";
$value["product"][4] = "ch.iframe.snode.banner";
$value["product"][5] = "ch.iframe.snode.catalog";
$value["product"][6] = "ch.iframe.snode.catalog_properties";
$value["product"][7] = "ch.iframe.snode.category";
$value["product"][8] = "ch.iframe.snode.core";
$value["product"][9] = "ch.iframe.snode.css";
$value["product"][10] = "ch.iframe.snode.customers";
$value["product"][11] = "ch.iframe.snode.errorpages";
$value["product"][12] = "ch.iframe.snode.events";
$value["product"][13] = "ch.iframe.snode.faq";
$value["product"][14] = "ch.iframe.snode.feedmanager";
$value["product"][15] = "ch.iframe.snode.feedreader";
$value["product"][16] = "ch.iframe.snode.filemanager";
$value["product"][17] = "ch.iframe.snode.footer";
$value["product"][18] = "ch.iframe.snode.formmanager";
$value["product"][19] = "ch.iframe.snode.forum";
$value["product"][20] = "ch.iframe.snode.gallery";
$value["product"][21] = "ch.iframe.snode.guestbook";
$value["product"][22] = "ch.iframe.snode.header";
$value["product"][23] = "ch.iframe.snode.history";
$value["product"][24] = "ch.iframe.snode.hr";
$value["product"][25] = "ch.iframe.snode.i18n";
$value["product"][26] = "ch.iframe.snode.info";
$value["product"][27] = "ch.iframe.snode.installer";
$value["product"][28] = "ch.iframe.snode.jobcenter";
$value["product"][29] = "ch.iframe.snode.licensemanager";
$value["product"][30] = "ch.iframe.snode.locations";
$value["product"][31] = "ch.iframe.snode.messages";
$value["product"][32] = "ch.iframe.snode.navigation";
$value["product"][33] = "ch.iframe.snode.newsletter";
$value["product"][34] = "ch.iframe.snode.nodepermissions";
$value["product"][35] = "ch.iframe.snode.objects";
$value["product"][36] = "ch.iframe.snode.packagebuilder";
$value["product"][37] = "ch.iframe.snode.packaging_units";
$value["product"][38] = "ch.iframe.snode.permissions";
$value["product"][39] = "ch.iframe.snode.pluginwizard";
$value["product"][40] = "ch.iframe.snode.projects";
$value["product"][41] = "ch.iframe.snode.relations";
$value["product"][42] = "ch.iframe.snode.roombooking";
$value["product"][43] = "ch.iframe.snode.search";
$value["product"][44] = "ch.iframe.snode.securitycenter";
$value["product"][45] = "ch.iframe.snode.settings";
$value["product"][46] = "ch.iframe.snode.shop";
$value["product"][47] = "ch.iframe.snode.shop_orders";
$value["product"][48] = "ch.iframe.snode.starter";
$value["product"][49] = "ch.iframe.snode.statistics";
$value["product"][50] = "ch.iframe.snode.survey";
$value["product"][51] = "ch.iframe.snode.tasks";
$value["product"][52] = "ch.iframe.snode.thememanager";
$value["product"][53] = "ch.iframe.snode.translations";
$value["product"][54] = "ch.iframe.snode.units";
$value["product"][55] = "ch.iframe.snode.usermanager";
$value["product"][56] = "ch.iframe.snode.virtual";
            
XT::setValue("value",$value);

foreach ($value["product"] as $product) {
    	$selectedprod[$product]=true;
}

XT::assign('SELECTEDPRODUCTS',$selectedprod);

?>