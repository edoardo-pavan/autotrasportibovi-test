<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "info@autotrasportibovi.com"; // CAMBIA CON LA TUA MAIL
    $subject = "Nuovo messaggio dal sito Autotrasporti Bovi";
    
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST["phone"]);
    $service = $_POST["service"];
    $message = trim($_POST["message"]);

    $email_content = "Nome: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Telefono: $phone\n";
    $email_content .= "Servizio richiesto: $service\n\n";
    $email_content .= "Messaggio:\n$message\n";

    $headers = "From: $name <$email>";

    if (mail($to, $subject, $email_content, $headers)) {
        echo "Grazie! Il messaggio è stato inviato correttamente.";
        // Opzionale: redirect a una pagina di ringraziamento
        // header("Location: grazie.html");
    } else {
        echo "Si è verificato un errore durante l'invio. Riprova più tardi.";
    }
} else {
    echo "Accesso non autorizzato.";
}
?>