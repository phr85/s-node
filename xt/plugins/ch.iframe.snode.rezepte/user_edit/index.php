<?PHP

if(!XT::getValue('id')){
    $GLOBALS['plugin']->setValue('id', XT::getSessionValue('recipeID'));
}else{
    $GLOBALS['plugin']->setSessionValue('recipeID',XT::getValue('id'));
}

$recipe_id = XT::getValue("id");

if($recipe_id > 0){
    $result = XT::query("
        SELECT
            a.c_date,
            a.c_user,
            a.m_date,
            a.m_user,
            a.portions,
            a.create_duration,
            a.rest_duration,
            a.kcal,
            a.complexity,
            a.ca_price,
            a.rating_avg,
            d.*
        FROM
            " . XT::getTable('rezepte') . " as a
        LEFT JOIN
            " . XT::getTable('r_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "')
        WHERE a.id = " . $recipe_id ,__FILE__,__LINE__,0);

    $data = XT::getQueryData($result);

    if($data[0]['c_user'] != XT::getUserID()){
        exit();
    }
    XT::assign("DATA", $data[0]);

    // Units
    $result = XT::query("
    SELECT 
        u.id,
        u.standard, 
        udet.short,
        udet.full
    FROM 
        " . XT::getTable('units') . " as u
    LEFT JOIN
        " . XT::getTable('units_det') . " as udet on (u.id = udet.id AND udet.lang='" . XT::getPluginLang() . "')
    " ,__FILE__,__LINE__,0);

    XT::assign("UNITS", XT::getQueryData($result));

    // Images

    $result = XT::query("
        SELECT
            i.image_id as image,
            i.image_version as version,
            i.is_main_image as main,
            i.position
        FROM
            " . XT::getTable('images') . " as i
        WHERE
            i.recipe_id = " . XT::getValue('id') . "
        ORDER BY
            i.position ASC"
    ,__FILE__,__LINE__,0);
    XT::assign("IMAGE",XT::getQueryData($result));


    // ingridients
    $result = XT::query("
    SELECT 
        r2i.*, 
        un.standard,
        idet.* 
    FROM 
        " . XT::getTable('r2i') . "  as r2i
    LEFT JOIN 
        " . XT::getTable('i_details') . " as idet  on (r2i.ingridient_id = idet.id AND idet.lang='" . XT::getPluginLang() . "')
    LEFT JOIN 
        " . XT::getTable('units') . "  as un  on (un.id = r2i.unit_id)
    WHERE 
        r2i.recipe_id=" . $recipe_id . " 
    ORDER 
        by r2i.position asc" ,__FILE__,__LINE__,0);

    XT::assign("INGRIDIENTS", XT::getQueryData($result));


    // Fetch content
    if($GLOBALS['plugin']->getParam("style") != ""){
        $style = $GLOBALS['plugin']->getParam("style");
    }else{
        $style = "default.tpl";
    }
    $content = XT::build($style);
}
?>