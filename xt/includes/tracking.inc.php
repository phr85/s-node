<?php

if($GLOBALS['cfg']->get('system','tracking_mode') > 0){
    // Tracking Mode 1 = Only logged in users
    if($GLOBALS['cfg']->get('system','tracking_mode') == 1){
        if($GLOBALS['auth']->isAuth()){
            $GLOBALS['db']->query("
                INSERT INTO
                    " . $GLOBALS['cfg']->get('database', 'prefix') . "tracking (
                        user_id,
                        session_id,
                        call_time,
                        page_url,
                        agent,
                        host,
                        addr,
                        uri,
                        tpl,
                        referer
                ) VALUES (
                        " . $GLOBALS['auth']->getUserID() . ",
                        '" . session_id() . "',
                        " . TIME . ",
                        '" . $_SERVER['QUERY_STRING'] . "',
                        '" . $_SERVER['HTTP_USER_AGENT'] . "',
                        '" . gethostbyaddr($_SERVER['REMOTE_ADDR']) . "',
                        '" . $_SERVER['REMOTE_ADDR'] . "',
                        '" . @$_SERVER['REQUEST_URI'] . "',
                        " . $GLOBALS['tpl_id'] . ",
                        '" . getenv('HTTP_REFERER') . "'
                );"
            ,__FILE__,__LINE__);
        }
    } else {

        // Tracking Mode 2 = All Users
        if($GLOBALS['cfg']->get('system','tracking_mode') == 2){
            if($GLOBALS['auth']->isAuth()){
                $GLOBALS['db']->query("
                    INSERT INTO
                        " . $GLOBALS['cfg']->get('database', 'prefix') . "tracking (
                            user_id,
                            session_id,
                            call_time,
                            page_url,
                            agent,
                            host,
                            addr,
                            uri,
                            tpl,
                            referer
                    ) VALUES (
                        " . $GLOBALS['auth']->getUserID() . ",
                        '" . session_id() . "',
                        " . TIME . ",
                        '" . $_SERVER['QUERY_STRING'] . "',
                        '" . $_SERVER['HTTP_USER_AGENT'] . "',
                        '" . gethostbyaddr($_SERVER['REMOTE_ADDR']) . "',
                        '" . $_SERVER['REMOTE_ADDR'] . "',
                        '" . @$_SERVER['REQUEST_URI'] . "',
                        " . $GLOBALS['tpl_id'] . ",
                        '" . getenv('HTTP_REFERER') . "'
                    );"
                );
            } else {
                $GLOBALS['db']->query("
                    INSERT INTO
                        " . $GLOBALS['cfg']->get('database', 'prefix') . "tracking (
                            user_id,
                            session_id,
                            call_time,
                            page_url,
                            agent,
                            host,
                            addr,
                            uri,
                            tpl,
                            referer
                    ) VALUES (
                        0,
                        '" . session_id() . "',
                        " . TIME . ",
                        '" . $_SERVER['QUERY_STRING'] . "',
                        '" . $_SERVER['HTTP_USER_AGENT'] . "',
                        '" . gethostbyaddr($_SERVER['REMOTE_ADDR']) . "',
                        '" . $_SERVER['REMOTE_ADDR'] . "',
                        '" . @$_SERVER['REQUEST_URI'] . "',
                        " . $GLOBALS['tpl_id'] . ",
                        '" . getenv('HTTP_REFERER') . "'
                    );"
                );
            }
        }
    }
}
?>