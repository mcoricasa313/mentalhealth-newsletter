<?php
require 'vendor/autoload.php'; // Include SendGrid library

date_default_timezone_set('America/New_York');


$apiKey = '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'; // Replace with your SendGrid API key
$sg = new \SendGrid($apiKey);

// Set the recipient list ID
//$toListId = 'dce682ed-17fa-4aef-b465-cf15f4b8e016';
//$toListId = 'michael.coricasa313@gmail.com';
//$toListId = 'eduardo@etc.marketing';
//$toListId = 'eduardo@etc.marketing';

echo date('Y-m-d H:i:s') . "\n";
$fechaHoraFlorida = date('Y-m-d');
$pendienteingreso = true;
//$subject = "Florida Conference - Your words were found daily";
$subject = "Welcome to “Your Words Were Found Daily - Florida Conference”";
$archivo = 'bienvenida.txt';
$manejador = fopen($archivo, 'a');
//$archivo = fopen('bienvenida.txt', 'a');

$textocompleto = "";

$contacts_array = array();
$list = array();
try {
    $response = $sg->client->marketing()->contacts()->get();
    //print $response->body() . "\n";
    $contacts = json_decode($response->body(), true);
    foreach ($contacts["result"] as $contact) {
        $email = $contact["email"];
        $first_name = $contact["first_name"];
        $last_name = $contact["last_name"];
        $complete_name = $first_name." ".$last_name;
        $list = $contact["list_ids"];

        $pendienteingreso = true;

        foreach ($list as $item) {
            if ($item == "dce682ed-17fa-4aef-b465-cf15f4b8e016") {
                $mail = new \SendGrid\Mail\Mail();
                $mail->setFrom("websmaster@floridaconference.com", "Florida Conference");
                //$mail->addTo("michael.coricasa313@gmail.com");
                $mail->addTo($email); //produccion
                $lineas = file($archivo, FILE_SKIP_EMPTY_LINES);
                foreach ($lineas as $linea) {
                    //echo "Linea ".$linea."\n";
                    //echo "El email a validar ".$email."\n";
                    if (trim($linea) === trim($email)) {
                        echo "Ya se envio correo de bienvenida ".$email."\n";
                        $pendienteingreso = false;
                    }
                }

                if ($pendienteingreso === true) {
                //if ($fechaHoraFlorida === "2023-12-29" && $pendienteingreso === true&& $email==="eric@etc.marketing") {
                //if ($fechaHoraFlorida === "2023-12-22" && $pendienteingreso === true && $email==="michael.coricasa313@gmail.com") {
                //if ($fechaHoraFlorida === "2023-12-22" && $pendienteingreso === true && $email==="eduardo@etc.marketing") {
                    // Realizar reemplazos de texto
                    echo "Enviando Correo a ". $email ."\n";
                    $replacements = [
                        '{{name}}' => $complete_name,
                    ];
                    $htmlContent = file_get_contents('bienvenida.html');
                    $htmlContent = str_replace(array_keys($replacements), array_values($replacements), $htmlContent);
                    $mail->setSubject($subject);
                    $mail->addContent("text/html", $htmlContent);
                    
                    // Send the email
                    $response = $sg->send($mail); //desbloquear para enviar correos
                    // Display the SendGrid response
                    $linea = "\n".$email;
                    $textocompleto = $textocompleto.$linea;
                    echo $response->statusCode()."\n";
                    //echo $response->body();
                }

            }
        }
    }

    //$archivo = 'bienvenida.txt';
    //file_put_contents($archivo, $textocompleto);
    fwrite($manejador, $textocompleto);
    echo "Línea escrita en $archivo.";

} catch (Exception $ex) {
    echo 'Caught exception: ' . $ex->getMessage();
}


