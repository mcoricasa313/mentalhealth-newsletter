<?php
require 'vendor/autoload.php'; // Include SendGrid library

// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

//$apiKey = getenv('SENDGRID_API_KEY');
$apiKey = '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'; // Replace with your SendGrid API key

//$apiKey = getenv('SENDGRID_API_KEY');
/*
$sg = new \SendGrid($apiKey);

try {
    $response = $sg->client->marketing()->contacts()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $ex) {
    echo 'Caught exception: '.  $ex->getMessage();
}
*/
//$apiKey = getenv('SENDGRID_API_KEY');

/*
$sg = new \SendGrid($apiKey);
$id = "dce682ed-17fa-4aef-b465-cf15f4b8e016";

try {
    $response = $sg->client->marketing()->lists()->_($id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $ex) {
    echo 'Caught exception: '.  $ex->getMessage();
}
*/

//$apiKey = getenv('SENDGRID_API_KEY');

/* 

*/

/*
$apiKey = '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'; // Replace with your SendGrid API key
$sg = new \SendGrid($apiKey);
$id = "dce682ed-17fa-4aef-b465-cf15f4b8e016";

try {
    $response = $sg->client->marketing()->lists()->_($id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $ex) {
    echo 'Caught exception: '.  $ex->getMessage();
}
*/

/*
$apiKey = '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'; // Replace with your SendGrid API key
$sg = new \SendGrid($apiKey);
$list_id = "dce682ed-17fa-4aef-b465-cf15f4b8e016";

try {
    $response = $sg->client->contactdb()->lists()->_($list_id)->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $ex) {
    echo 'Caught exception: '.  $ex->getMessage();
}
*/



/*
$sg = new \SendGrid($apiKey);

try {
    $response = $sg->client->contactdb()->lists()->get();
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $ex) {
    echo 'Caught exception: '.  $ex->getMessage();
}
*/


$apiKey = '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'; // Replace with your SendGrid API key
$sg = new \SendGrid($apiKey);
$contacts_array =array();
$list  = array();
try {
    $response = $sg->client->marketing()->contacts()->get();
    //print $response->statusCode() . "\n";
    //print_r($response->headers());
    print $response->body() . "\n";
    $contacts = json_decode($response->body(),true);

    //foreach ($variable as $key => $value) {
        # code...
    //}

    //echo $contacts["result"];
    echo "sersfdsfds"."\n";
    echo count($contacts["result"])."\n";

    foreach ($contacts["result"] as $contact) {

        //var_dump($contact);
        $email = $contact["email"];
        //echo $contact["email"]."\n";
        //echo $c->email."\n";
        //echo $contact->email;
        //$email = $contact->email;
        $list = $contact["list_ids"];

        foreach ($list as $item) {
            # code...
            if ($item == "dce682ed-17fa-4aef-b465-cf15f4b8e016") 
            {
                echo "Correo electrónico: $email\n";        
                array_push($contacts_array,$contact);
            }
        }        
    }


} catch (Exception $ex) {
    echo 'Caught exception: '.  $ex->getMessage();
}
