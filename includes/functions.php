<?php

function rezultat_recaptcha($response_key, $user_ip) {
$secret_key = "6LcE1v8ZAAAAAJvABYeH3YjWXjxDRLSVlinBX89D";
$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response_key&remoteip=$user_ip";
$response = file_get_contents($url);
$response = json_decode($response);
return $response->success;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
