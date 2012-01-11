<?php

// Set Base ID
XT::setBaseID(3200);

// Add configuration variables
XT::addConfig('whois_servers', array(
    "de"    => "whois.denic.de",
    "com"   => "rs.internic.net",
    "net"   => "rs.internic.net",
    "org"   => "whois.pir.org",
    "info"  => "whois.afilias.net",
    "biz"   => "whois.biz",
    "at"    => "whois.nic.at",
    "ch"    => "whois.nic.ch",
    "li"    => "whois.nic.ch",
    "co.uk" => "whois.nic.uk",
    "tv"    => "whois.www.tv",
    "cc"    => "whois.enic.cc",
    "dk"    => "whois.dk-hostmaster.dk",
    "it"    => "whois.nic.it",
    "ws"    => "whois.worldsite.ws"
    )
);

?>