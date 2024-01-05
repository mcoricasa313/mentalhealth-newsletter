<?php
require 'vendor/autoload.php'; // Include SendGrid library

$apiKey = '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'; // Replace with your SendGrid API key
$sg = new \SendGrid($apiKey);

$contacts_array =array();
$list  = array();
try {
    //$response = $sg->client->marketing()->contacts()->limit(9999)->get();
    $response = $sg->client->marketing()->contacts()->get();
    print $response->body() . "\n";
    $contacts = json_decode($response->body(),true);
    foreach ($contacts["result"] as $contact) {
        $email = $contact["email"];
        $first_name = $contact["first_name"];
        $last_name = $contact["last_name"];
        $list = $contact["list_ids"];
        foreach ($list as $item) {
            if ($item == "dce682ed-17fa-4aef-b465-cf15f4b8e016") 
            {
                echo "Email: $email\n";        
                echo "Name: $first_name $last_name \n";        
                array_push($contacts_array,$email);
            }
        }        
    }

    var_dump($contacts_array);
    //echo implode(",",$contacts_array);

} catch (Exception $ex) {
    echo 'Caught exception: '.  $ex->getMessage();
}
