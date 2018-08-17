<?php
//Tor Protection
$ip = get_ip();
$dnsbl_lookup = array(
     "tor.dan.me.uk",
     "tor.dnsbl.sectoor.de"
    );
    $reverse_ip   = implode(".", array_reverse(explode(".", $ip)));
    
    foreach ($dnsbl_lookup as $host) {
        if (checkdnsrr($reverse_ip . "." . $host . ".", "A")) {
            die("Tor user detected!");
        }
    }

function get_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    return $ipaddress;
}
