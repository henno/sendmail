<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'config.php';

// Read CSV
$csvFile = fopen(CSV_FILE_PATH, 'r');
fgetcsv($csvFile);  // skip the header

while (($row = fgetcsv($csvFile)) !== FALSE) {
    $firstName = $row[0];
    $lastName = $row[1];
    $email = $row[2];
    $password = $row[3];

    sendMail($firstName, $lastName, $email, $password);
}

fclose($csvFile);

function sendMail($firstName, $lastName, $email, $password) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = SMTP_AUTH_ENABLED;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_ENCRYPTION;
        $mail->Port       = SMTP_PORT;
        $mail->SMTPDebug  = SMTP_DEBUG;

        //Recipients
        $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
        $mail->addAddress($email, $firstName . ' ' . $lastName);  // Add a recipient

        // Read email body from template
        ob_start();  // start output buffering

        // Include the template file or throw an exception if it doesn't exist
        if (!file_exists(CSV_FILE_PATH)) {
            throw new Exception('The file '. CSV_FILE_PATH .' does not exist. Refer to the README.md file for instructions.');
        }
        include 'data/message.php';
        $emailBody = ob_get_clean();  // get the content from the buffer and stop buffering

        $mail->isHTML(true);
        $mail->Subject = MAIL_SUBJECT;
        $mail->Body    = $emailBody;

        $mail->send();

        echo "Message has been sent to $email\n";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}\n";
    }
}
