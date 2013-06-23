<?php

function http_post_fields($url, $fields) {
    
    //url-ify the data for the POST
    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    rtrim($fields_string, '&');

    //open connection
    $ch = curl_init();
    
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, TRUE);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

    //execute post
    $result = curl_exec($ch);

    //close connection
    curl_close($ch);
    return $result;
}

session_destroy();

$myserver = 'http://browserid.opoto.c9.io/';
$fields = array(
    'assertion' => urldecode($_POST['assertion']),
    'audience' => $myserver
);
echo "\nfields: ";
var_dump($fields);

session_start();
echo "\nsession: ";
var_dump($_SESSION);

$response = http_post_fields("https://verifier.login.persona.org/verify", $fields);
$json = json_decode($response);

if (($json->{'status'} == "okay") && ($json->{'audience'} == $myserver)) {
    $_SESSION['user'] = $json->{'email'};
} else {
    http_response_code(500);
}
?>
