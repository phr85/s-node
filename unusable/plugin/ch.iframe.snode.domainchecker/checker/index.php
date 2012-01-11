<?php

// Get request vars
$domain = XT::getValue('domain');
XT::assign('DOMAIN',$domain);
$extension = XT::getValue('ext');
XT::assign('EXTENSION',$extension);

// Assign domain and server list
XT::assign('SERVERS', XT::getConfig('whois_servers'));

// Lookup domain name if it is not empty
if ($domain != '') {
    $domain = $domain . '.' . $extension;
    if(lookup($domain, $extension)){
        // Fetch template "available"
        $content = XT::build('available.tpl');
    } else {
        // Fetch template "not_available"
        $content = XT::build('not_available.tpl');
    }
} else {
    
   
    
    // Fetch default template
    $content = XT::build('default.tpl');
}

// Get whois server function
function get_whois_server($extension){
    $servers = &XT::getConfig('whois_servers');
    return $servers[$extension];
}

// Domain name lookup function
function lookup($domain, $extension){
    
    // Get whois server for domain
    $lookup_server = get_whois_server($extension);

    // No whois server was found for this domain
    if (!$lookup_server) {
        return "";
    }
    
    // Create socket connection to whois server
    $fp = fsockopen($lookup_server,43);
    
    // Send request
    fputs($fp, "$domain\r\n");
    
    // Get response
    $response = "";
    while(!feof($fp)){
        $response .= fgets($fp,128);
    }
    
    // Close connection
    fclose($fp);
    
    // Parse response
    $reg = "/Whois Server: (.*?)\n/i";
    preg_match_all($reg, $response, $matches);
    
    // Should i try a second time ?
    $secondtry = $matches[1][0];
    
    // Second try
    if ($secondtry){
        $fp = fsockopen($secondtry,43);
        fputs($fp, "$domain\r\n");
        $response = "";
        while(!feof($fp)){
            $response.=fgets($fp,128);
        }
        fclose($fp);
    }

    XT::assign('RESPONSE', trim($response));

    // Process results and fetch output
    if(ereg("(No match|free|No entries found|NOT FOUND|Not found|not found in database|We do not have an entry in our database matching your query)",$response)) {
        
        // This domain is available
        return true;
        
    } else {
        
        // This domain is not available
        return false;
        
    }
}
?>