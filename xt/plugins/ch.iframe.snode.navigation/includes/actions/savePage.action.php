<?php
 // If external link is disabled
$ext_link = XT::getValue('ext_link');
if(XT::getValue("refertoextlink") != 1){
    $ext_link = '';
    XT::setValue('blank',0);
}
if(!XT::getValue('blank')){
    XT::setValue('blank',0);
}

// If node detail row is not created already
if(XT::getValue('creation_user') == ''){
    $GLOBALS['plugin']->setValue('creation_user',$GLOBALS['auth']->getUserID());
    $GLOBALS['plugin']->setValue('creation_date',time());
}

// Delete existing node details
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('navigation_details') . "
    WHERE
        node_id = " . XT::getValue('node_id') . "
        AND lang = '" . XT::getValue('save_lang') . "'
    ",__FILE__,__LINE__);

// Update node details
XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('navigation_details') . "
    (
        node_id,
        lang,
        title,
        pagetitle,
        tpl_file,
        author,
		revisit_after,
        copyright,
        ext_link,
        blank,
        target,
        public,
        description,
        keywords,
        mod_user,
        mod_date,
        creation_user,
        creation_date,
        article_id,
        article_layout,
        visible,
        image,
        image_version,
        show_in_overview,
        active,
        nav_image,
        nav_image_generated_enabled,
        nav_image_generated_params,
        nav_image_version,
        nav_image_rollover,
        nav_image_rollover_generated_enabled,
        nav_image_rollover_generated_params,
        nav_image_rollover_version,
        nav_image_active,
        nav_image_active_generated_enabled,
        nav_image_active_generated_params,
        nav_image_active_version,
        nav_image_active_rollover,
        nav_image_active_rollover_generated_enabled,
        nav_image_active_rollover_generated_params,
        nav_image_active_rollover_version,
        rewrite_name,
        header,
        footer,
        css,
        based_on_tpl
    ) VALUES (
        " . XT::getValue('node_id') . ",
        '" . XT::getValue('save_lang') . "',
        '" . XT::getValue('title') . "',
        '" . XT::getValue('pagetitle') . "',
        '" . XT::getValue('tpl_file') . "',
        '" . XT::getValue('author') . "',
		'" . XT::getValue('revisit_after') . "',
        '" . XT::getValue('copyright') . "',
        '" . XT::getValue('ext_link') . "',
        '" . XT::getValue('blank') . "',
        '" . XT::getValue('target') . "',
        '" . XT::getValue('public') . "',
        '" . XT::getValue('description') . "',
        '" . XT::getValue('keywords') . "',
        '" . XT::getUserID() . "',
        '" . time() . "',
        '" . XT::getValue('creation_user') . "',
        '" . XT::getValue('creation_date') . "',
        '" . XT::getValue('article_id') . "',
        '" . XT::getValue('article_layout') . "',
        '" . XT::getValue('visible') . "',
        '" . XT::getValue('image') . "',
        '" . XT::getValue('image_version') . "',
        '" . XT::getValue('show_in_overview') . "',
        '" . XT::getValue('active') . "',
        '" . XT::getValue('nav_image') . "',
        '" . XT::getValue('nav_image_generated_enabled') . "',
        '" . XT::getValue('nav_image_generated_params') . "',
        '" . XT::getValue('nav_image_version') . "',
        '" . XT::getValue('nav_image_rollover') . "',
        '" . XT::getValue('nav_image_rollover_generated_enabled') . "',
        '" . XT::getValue('nav_image_rollover_generated_params') . "',
        '" . XT::getValue('nav_image_rollover_version') . "',
        '" . XT::getValue('nav_image_active') . "',
        '" . XT::getValue('nav_image_active_generated_enabled') . "',
        '" . XT::getValue('nav_image_active_generated_params') . "',
        '" . XT::getValue('nav_image_active_version') . "',
        '" . XT::getValue('nav_image_active_rollover') . "',
        '" . XT::getValue('nav_image_active_rollover_generated_enabled') . "',
        '" . XT::getValue('nav_image_active_rollover_generated_params') . "',
        '" . XT::getValue('nav_image_active_rollover_version') . "',
        '" . XT::getValue('rewrite_name') . "',
        '" . XT::getValue('header') . "',
        '" . XT::getValue('footer') . "',
        '" . XT::getValue('css') . "',
        '" . XT::getValue('based_on_tpl') . "'
    )
",__FILE__,__LINE__);

// Get all subentries
$result = XT::query("
    SELECT
        b.id, c.css, c.header, c.footer
    FROM 
        " . XT::getTable('navigation') . " as a INNER JOIN
        " . XT::getTable('navigation') . " as b ON (b.l > a.l AND b.r < a.r)
    LEFT JOIN
        " . XT::getTable('navigation_details') . " as c ON (c.node_id = b.id)
    WHERE
        a.id = " . XT::getValue('node_id') . "
",__FILE__,__LINE__);

$data = array();
while($srow = $result->FetchRow()){
    $data[] = $srow['id'];

    // Save nav image settings and style settings recursive
    if($srow['header']=="" && XT::getValue('header')!=""){
        XT::query("
        UPDATE
            " . XT::getTable('navigation_details') . "
        SET
            header = '" . XT::getValue('header') . "'
        WHERE
            node_id = " . $srow['id'] . "
        AND 
            lang = '" . XT::getPluginLang() . "'
    ",__FILE__,__LINE__);
    }

    if($srow['footer']=="" && XT::getValue('footer') !=""){
        XT::query("
        UPDATE
            " . XT::getTable('navigation_details') . "
        SET
            footer = '" . XT::getValue('footer') . "'
        WHERE
            node_id = " . $srow['id'] . "
        AND 
            lang = '" . XT::getPluginLang() . "'
    ",__FILE__,__LINE__);
    }

    if($srow['css']==""){
        XT::query("
        UPDATE
            " . XT::getTable('navigation_details') . "
        SET
            css = '" . XT::getValue('css') . "'
        WHERE
            node_id = " . $srow['id'] . "
        AND 
            lang = '" . XT::getPluginLang() . "'
    ",__FILE__,__LINE__);
    }
}

// Create template file for this node
if(!file_exists(PAGES_DIR . XT::getValue("tpl_file"))){
    file_put_contents(PAGES_DIR . XT::getValue("tpl_file"), file_get_contents($GLOBALS['tpl']->template_dir . 'includes/skeleton.tpl'));
}

// Index keywords and description
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getValue('node_id'),$GLOBALS['plugin']->getContentType("Page"),XT::getValue('public'));
if(!empty($ext_link)){
    $search->link($ext_link);
}
$search->add(XT::getValue("keywords"), 1);
$search->setLang(XT::getValue('save_lang'));
$search->build(XT::getValue("title"), XT::getValue("description"));
$search->setImage(XT::getValue('image'));

$GLOBALS['plugin']->setAdminModule("e");

?>
