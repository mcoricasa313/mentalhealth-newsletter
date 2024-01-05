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

$archivo_correos = 'correos.txt';
$manejador = fopen($archivo_correos, 'a');
$contacts = file($archivo_correos, FILE_SKIP_EMPTY_LINES);


$list = array();
try {
    //print $response->body() . "\n";
    //$contacts = json_decode($response->body(), true);

    foreach ($contacts as $email) {
        $mail = new \SendGrid\Mail\Mail();
        $mail->setFrom("websmaster@floridaconference.com", "Florida Conference");
        $mail->addTo($email); //produccion
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
    
        if ($fechaHoraFlorida === "2024-01-03 16" && $pendienteingreso) {
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
            //$response = $sg->send($mail);
            echo $response->statusCode()."\n";
            echo $response->body();
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


