<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "info@autotrasportibovi.com"; // CAMBIA CON LA TUA MAIL
    $subject = "Nuovo messaggio dal sito Autotrasporti Bovi";
    
    $request_type = $_POST["request_type"];
    
    $email_content = "Tipo di richiesta: $request_type\n\n";
    
    if ($request_type == "azienda") {
        $name = strip_tags(trim($_POST["name_azienda"]));
        $email = filter_var(trim($_POST["email_azienda"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone_azienda"]);
        $service = $_POST["service"];
        
        $email_content .= "Nome Azienda: $name\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Telefono: $phone\n";
        $email_content .= "Tipo di Trasporto: $service\n";
    } elseif ($request_type == "candidatura") {
        $name = strip_tags(trim($_POST["name_cand"]));
        $surname = strip_tags(trim($_POST["surname"]));
        $email = filter_var(trim($_POST["email_cand"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone_cand"]);
        $position = $_POST["position"];
        $message = trim($_POST["message_cand"]);
        
        $email_content .= "Nome: $name\n";
        $email_content .= "Cognome: $surname\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Telefono: $phone\n";
        $email_content .= "Candidatura per: $position\n";
        $email_content .= "Messaggio:\n$message\n";
        
        // Handle CV upload
        if (isset($_FILES['cv']) && $_FILES['cv']['error'] == UPLOAD_ERR_OK) {
            $cv_name = $_FILES['cv']['name'];
            $cv_tmp = $_FILES['cv']['tmp_name'];
            // For simplicity, just mention it in email. In production, save to server or attach.
            $email_content .= "\nCV allegato: $cv_name\n";
            // You might want to move_uploaded_file to a directory
        }
    }

    $headers = "From: $email";

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