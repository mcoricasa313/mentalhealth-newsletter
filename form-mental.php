<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar reCAPTCHA
    $recaptcha_secret = "6LdcW0cpAAAAAJ22i7H5P3OHMlq9nCama9-yM2R_";
    $recaptcha_response = $_POST['g-recaptcha-response'];

    $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}";
    $recaptcha_data = json_decode(file_get_contents($recaptcha_url));

    if (!$recaptcha_data->success) {
        die("La verificación de reCAPTCHA falló. Vuelve atrás y vuelve a intentarlo.");
    }

    // Guardar el correo electrónico en un archivo de texto
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $registro = "Email: {$email}\n";
        $archivo = "registros.txt";

        // Guardar en el archivo
        file_put_contents($archivo, $registro, FILE_APPEND | LOCK_EX);

        echo "Registro exitoso. Gracias por registrarte.";
    } else {
        echo "El correo electrónico proporcionado no es válido. Vuelve atrás y vuelve a intentarlo.";
    }
} else {
    // Redireccionar si se intenta acceder directamente a procesar.php
    header("Location: index.php");
    exit();
}
?>
