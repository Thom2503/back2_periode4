<?php
  function send_mail($to, $uuid, $voornaam, $achternaam, $datum, $telefoon, $uniekeCode)
  {
    $to_email = $to;
    $subject = "Inschrijving kaartjes GLR";
    $body = "
      Uw gegevens uit het inschrijfformulier:
      - $voornaam $achternaam
      - $datum
      - $telefoon
      En onthoud uw unieke code die staat hier:
      $uniekeCode
    ";
    $headers = "From: GLR kaartjes";

    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email successfully sent to $to_email... <br> Je kan nu in je inbox kijken en check dan de informatie. <br> <button onclick='history.back(); return false;'>Ga terug</button>";
    } else {
        echo "Email sending failed... <br> <button onclick='history.back(); return false;'>Ga terug</button>";
    }
  }
?>
