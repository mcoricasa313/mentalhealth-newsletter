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
$fechaHoraFlorida = date('Y-m-d H');
$pendienteingreso = true;
//$subject = "Florida Conference - Your words were found daily";
$subject = "";


$contacts_array = array();
$list = array();
try {
    $response = $sg->client->marketing()->contacts()->get();
    //print $response->body() . "\n";
    $contacts = json_decode($response->body(), true);
    foreach ($contacts["result"] as $contact) {
        $email = $contact["email"];
        $list = $contact["list_ids"];
        foreach ($list as $item) {
            if ($item == "dce682ed-17fa-4aef-b465-cf15f4b8e016") {


                //now we send the email
                // Create a dynamic template email
                $mail = new \SendGrid\Mail\Mail();
                $mail->setFrom("websmaster@floridaconference.com", "Florida Conference");
                $mail->addTo($email); //produccion
                //$mail->addTo("eric@etc.marketing"); //test
                //$mail->addTo("michael.coricasa313@gmail.com");
                //$mail->addTo("eric@etc.marketing");
                //$mail->setTemplateId("d-8506299783f04b67a231db1e90e9ec81"); // Replace with your template ID


                // Attach a file
                $attachment = new \SendGrid\Mail\Attachment();
                $attachment->setType('application/word');
                $attachment->setDisposition('attachment');

                // Nombre del archivo de texto
                $archivo = 'logs.txt';
                // Leer todas las líneas del archivo en un array
                $lineas = file($archivo, FILE_IGNORE_NEW_LINES);
                // Mostrar cada línea
                foreach ($lineas as $linea) {
                    //echo $linea . "<br>";
                    if ($linea === $fechaHoraFlorida) {
                        # code...
                        //echo "Ya se envio correo el día de hoy"."\n";
                        $pendienteingreso = false;
                    }
                }

                //if ($fechaHoraFlorida === "2023-12-22" && $pendienteingreso === true && $email==="michael.coricasa313@gmail.com") {
                if ($fechaHoraFlorida === "2024-01-01 06" && $pendienteingreso === true) {
                    echo "Enviando Correo a ". $email ."\n";
                    $subject = "Florida Conference Newsletter - Genesis 1,2 – Additional Reading, Patriarchs and Prophets chapter 2, 'The Creation'";

                    $attachment->setContent(file_get_contents('words/January 1 Monday.docx')); // Replace with the actual file path
                    $attachment->setFilename('January 1 Monday.docx');

                    // Realizar reemplazos de texto
                    $replacements = [
                        '{{url_english}}' => 'https://floridaconference.com/event/devotion-patriarchs-and-prophets-chapter-2/',
                        '{{url_spanish}}' => 'https://floridaconference.com/event/devotion-patriarcas-y-profetas/',
                        '{{tittle}}' => 'Genesis 1,2 – Additional Reading, Patriarchs and Prophets chapter 2, "The Creation" - Florida Conference Newsletter',
                        '{{today}}' => date('Y-d-m'),
                    ];
                    $htmlContent = file_get_contents('plantilla.html');

                    $htmlContent = str_replace(array_keys($replacements), array_values($replacements), $htmlContent);
                    $mail->setSubject($subject);
                    $mail->addContent("text/html", $htmlContent);

 
                    //$mail->addAttachment($attachment);
                    // Send the email
                    //$response = $sg->send($mail);
                    // Display the SendGrid response
                    echo $response->statusCode()."\n";
                    echo $response->body();
                }


                if ($fechaHoraFlorida === "2024-01-02 05" && $pendienteingreso === true) {
                    echo "2024-01-02 05 Enviando Correo a ". $email ."\n";
                    $subject = "Florida Conference Newsletter - Genesis 3,4 - Commentary: Patriarchs and Prophets, chapters 3 - 5";
                    // Realizar reemplazos de texto
                    $replacements = [
                        '{{url_english}}' => 'https://floridaconference.com/event/devotion-january-2/',
                        '{{url_spanish}}' => 'https://floridaconference.com/event/devotion-enero-2/',
                        '{{tittle}}' => 'Genesis 3,4 - Commentary: Patriarchs and Prophets, chapters 3 - 5 - Florida Conference Newsletter',
                        '{{today}}' => date('m-d-Y'),
                    ];
                    $htmlContent = file_get_contents('plantilla.html');

                    $htmlContent = str_replace(array_keys($replacements), array_values($replacements), $htmlContent);
                    $mail->setSubject($subject);
                    $mail->addContent("text/html", $htmlContent);
                    $response = $sg->send($mail);
                    echo $response->statusCode()."\n";
                    echo $response->body();
                }

                if ($fechaHoraFlorida === "2024-01-03 06" && $pendienteingreso) {
                    echo "2024-01-03 06 Enviando Correo a ". $email ."\n";
                    $subject = "Florida Conference Newsletter - Genesis 5, 6 - Additional Reading: Patriarchs and Prophets Chapter 6, 'Seth and Enoch'";
                    // Realizar reemplazos de texto
                    $replacements = [
                        '{{url_english}}' => 'https://floridaconference.com/event/devotion-january-3/',
                        '{{url_spanish}}' => 'https://floridaconference.com/event/devotion-enero-3/',
                        '{{tittle}}' => 'Genesis 5, 6 - Additional Reading: Patriarchs and Prophets Chapter 6, "Seth and Enoch" - Florida Conference Newsletter',
                        '{{today}}' => date('m-d-Y'),
                    ];
                    $htmlContent = file_get_contents('plantilla.html');

                    $htmlContent = str_replace(array_keys($replacements), array_values($replacements), $htmlContent);
                    $mail->setSubject($subject);
                    $mail->addContent("text/html", $htmlContent);
                    $response = $sg->send($mail);
                    echo $response->statusCode()."\n";
                    echo $response->body();
                }

                if ($fechaHoraFlorida === "2024-01-04 06" && $pendienteingreso) {
                    echo "Enviando Correo a ". $email ."\n";
                    $subject = "Florida Conference Newsletter - Genesis 3,4 - Commentary: Patriarchs and Prophets, chapters 3 - 5";
                    // Realizar reemplazos de texto
                    $replacements = [
                        '{{url_english}}' => 'https://floridaconference.com/event/devotion-january-2/',
                        '{{url_spanish}}' => 'https://floridaconference.com/event/devotion-enero-2/',
                        '{{tittle}}' => 'Genesis 3,4 - Commentary: Patriarchs and Prophets, chapters 3 - 5 - Florida Conference Newsletter',
                        '{{today}}' => date('m-d-Y'),
                    ];
                    $htmlContent = file_get_contents('plantilla.html');

                    $htmlContent = str_replace(array_keys($replacements), array_values($replacements), $htmlContent);
                    $mail->setSubject($subject);
                    $mail->addContent("text/html", $htmlContent);
                    $response = $sg->send($mail);
                    echo $response->statusCode()."\n";
                    echo $response->body();
                }

                if ($fechaHoraFlorida === "2024-01-05 06" && $pendienteingreso) {
                    echo "Enviando Correo a ". $email ."\n";
                    $subject = "Florida Conference Newsletter - Genesis 3,4 - Commentary: Patriarchs and Prophets, chapters 3 - 5";
                    // Realizar reemplazos de texto
                    $replacements = [
                        '{{url_english}}' => 'https://floridaconference.com/event/devotion-january-2/',
                        '{{url_spanish}}' => 'https://floridaconference.com/event/devotion-enero-2/',
                        '{{tittle}}' => 'Genesis 3,4 - Commentary: Patriarchs and Prophets, chapters 3 - 5 - Florida Conference Newsletter',
                        '{{today}}' => date('m-d-Y'),
                    ];
                    $htmlContent = file_get_contents('plantilla.html');

                    $htmlContent = str_replace(array_keys($replacements), array_values($replacements), $htmlContent);
                    $mail->setSubject($subject);
                    $mail->addContent("text/html", $htmlContent);
                    $response = $sg->send($mail);
                    echo $response->statusCode()."\n";
                    echo $response->body();
                }

            }
        }
    }

    //var_dump($contacts_array);
    //echo implode(",", $contacts_array);
    // Grabar en archivo
    $archivo = 'logs.txt';
    // Línea que deseas escribir en el archivo
    $linea = $fechaHoraFlorida;
    // Escribir la línea en el archivo (sobrescribir contenido existente)
    file_put_contents($archivo, $linea);
    echo "Línea escrita en $archivo.";

} catch (Exception $ex) {
    echo 'Caught exception: ' . $ex->getMessage();
}


