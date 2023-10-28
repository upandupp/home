<?php

// Empfänger-Adresse
$recipient = "contact@upandup.cc";

// Überprüfen, ob das Formular gesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // Überprüfen, ob alle erforderlichen Felder ausgefüllt wurden
    if (!empty($name) && !empty($email) && !empty($message)) {
        $subject = "Neue Nachricht von $name";

        // Zusätzliche Header für den Absender
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        
        // Erweiterung der Nachricht um die Telefonnummer
        $fullMessage = "Von: $name\nE-Mail: $email\n";
        if (!empty($phone)) {
            $fullMessage .= "Telefon: $phone\n";
        }
        $fullMessage .= "Nachricht:\n$message";

        // Senden der E-Mail
        if (mail($recipient, $subject, $fullMessage, $headers)) {
            echo "Ihre Nachricht wurde erfolgreich gesendet!";
        } else {
            echo "Fehler beim Senden der Nachricht. Bitte versuchen Sie es später erneut.";
        }
    } else {
        echo "Bitte füllen Sie alle erforderlichen Felder aus.";
    }
}

?>
