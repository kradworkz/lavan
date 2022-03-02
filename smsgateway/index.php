<?php

require '/vendor/autoload.php';

$array_fields['phone_number'] = '09557650803';
$array_fields['message'] = 'Test';
$array_fields['device_id'] = 95473;

$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzMDcwMzE5NCwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjU2MzU5LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.m0L9M8LyiG9QZ88CUzfmrzRRf9g9ejbxDqLAZLGPkos";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://smsgateway.me/api/v4/message/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "[  " . json_encode($array_fields) . "]",
    CURLOPT_HTTPHEADER => array(
        "authorization: $token",
        "cache-control: no-cache"
    ),
));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}

?>