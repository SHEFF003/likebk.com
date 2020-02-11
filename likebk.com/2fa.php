<?php
include_once("GoogleAuthenticator.php");

$secret = 'XVQ2UIGO75XRUKJO';
$time = floor(time() / 30);
$code = "846474";

$g = new GoogleAuthenticator();

print "Current Code is: ";
print $g->getCode($secret,$time);

print "<br>";

print "Check if $code is valid: ";

if ($g->checkCode($secret,$code)) {
    print "YES <br>";   
} else {
    print "NO <br>";
}

$secret = $g->generateSecret();
print "Get a new Secret: $secret <br>";

print "The QR Code for this secret (to scan with the Google Authenticator App: <br>";
echo '<img src="'.$g->getURL('12345','likebk.com',$secret).'">';
print "<br>";