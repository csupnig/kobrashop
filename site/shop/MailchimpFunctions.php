<?php

class MailchimpFunctions
{
    public static function registerUser($firstname, $lastname, $company, $email) {
        // API to mailchimp ########################################################
        $list_id = option('mailchimp.list.id');
        $authToken = option('mailchimp.api.key');
        // The data to send to the API

        $postData = array(
            "email_address" => $email,
            "status" => "subscribed",
            "merge_fields" => array(
                "FNAME"=> $firstname,
                "LNAME"=>$lastname,
                "FIRMA"=>$company
            )
        );

        // Setup cURL
        $ch = curl_init('https://us16.api.mailchimp.com/3.0/lists/'.$list_id.'/members/');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: apikey '.$authToken,
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));
        // Send the request
        $response = curl_exec($ch);
        //var_dump($response);
    }
}
