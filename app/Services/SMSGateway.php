<?php

namespace App\Services;


class SMSGateway {

    public static function sendSMS($message,$phone) 
    {
        include(base_path('smsgateway/vendor') . '/autoload.php');

        $array_fields['phone_number'] = $phone;
        $array_fields['message'] = $message;
        $array_fields['device_id'] = 127464;
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY0NjI5MTMwMiwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjkzMjc5LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.WBaXW6ZqyNApd1aQaDI08CVZvtglh_NHewGWWgaX5MU";
        // $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY0NTE2OTAxMCwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjkzMDU5LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.A6n6B6uRngFQAenkb_-jtiYx4vIdiNv4od7m2KwzlIM";
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

        return $err;
    }
}