<?php
$value = XT::getValue("value");
$value["product"][0] = "ch.iframe.snode.addresses";
$value["product"][2] = "ch.iframe.snode.articles";
$value["product"][4] = "ch.iframe.snode.banner";
$value["product"][7] = "ch.iframe.snode.category";
$value["product"][8] = "ch.iframe.snode.core";
$value["product"][9] = "ch.iframe.snode.css";
$value["product"][11] = "ch.iframe.snode.errorpages";
$value["product"][16] = "ch.iframe.snode.filemanager";
$value["product"][17] = "ch.iframe.snode.footer";
$value["product"][18] = "ch.iframe.snode.formmanager";
$value["product"][21] = "ch.iframe.snode.guestbook";
$value["product"][22] = "ch.iframe.snode.header";
$value["product"][23] = "ch.iframe.snode.history";
$value["product"][25] = "ch.iframe.snode.i18n";
$value["product"][26] = "ch.iframe.snode.info";
$value["product"][27] = "ch.iframe.snode.installer";
$value["product"][30] = "ch.iframe.snode.locations";
$value["product"][31] = "ch.iframe.snode.messages";
$value["product"][32] = "ch.iframe.snode.navigation";
$value["product"][35] = "ch.iframe.snode.objects";
$value["product"][41] = "ch.iframe.snode.relations";
$value["product"][43] = "ch.iframe.snode.search";
$value["product"][45] = "ch.iframe.snode.settings";
$value["product"][48] = "ch.iframe.snode.starter";
$value["product"][51] = "ch.iframe.snode.tasks";
$value["product"][52] = "ch.iframe.snode.thememanager";
$value["product"][53] = "ch.iframe.snode.translations";
$value["product"][55] = "ch.iframe.snode.usermanager";
$value["product"][56] = "ch.iframe.snode.virtual";
           
XT::setValue("value",$value);

foreach ($value["product"] as $product) {
    	$selectedprod[$product]=true;
}

XT::assign('SELECTEDPRODUCTS',$selectedprod);

?>