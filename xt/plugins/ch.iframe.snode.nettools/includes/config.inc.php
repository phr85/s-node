<?php

// Base ID
$GLOBALS['plugin']->setBaseID(7200);

$GLOBALS['plugin']->addConfig('cmd_ping', '/bin/ping', 'Ping command');
$GLOBALS['plugin']->addConfig('cmd_whois', '/usr/bin/whois', 'Whois command');
$GLOBALS['plugin']->addConfig('cmd_nslookup', '/usr/bin/nslookup', 'Nslookup command');
$GLOBALS['plugin']->addConfig('cmd_traceroute', '/usr/sbin/traceroute', 'Traceroute command');
$GLOBALS['plugin']->addConfig('cmd_dig', '/usr/bin/dig', 'Dig command');

// Add configuration variables
XT::addConfig('whois_servers', array(
    "ch"    => "whois.nic.ch",
    "de"    => "whois.denic.de",
    "at"    => "whois.nic.at",
    "li"    => "whois.nic.ch",
    "com"   => "rs.internic.net",
    "net"   => "rs.internic.net",
    "org"   => "whois.pir.org",
    "info"  => "whois.afilias.net",
    "biz"   => "whois.biz",
    "co.uk" => "whois.nic.uk",
    "tv"    => "whois.www.tv",
    "cc"    => "whois.enic.cc",
    "dk"    => "whois.dk-hostmaster.dk",
    "it"    => "whois.nic.it",
    "ws"    => "whois.worldsite.ws"
    )
);
?>
