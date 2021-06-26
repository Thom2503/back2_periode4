<?php
  // function send_mail($to, $uuid, $voornaam, $achternaam, $datum, $telefoon, $uniekeCode)
  // {
  //   $to_email = $to;
  //   $subject = "Inschrijving kaartjes GLR";
  //   $body = "
  //     Uw gegevens uit het inschrijfformulier:
  //     - $voornaam $achternaam
  //     - $datum
  //     - $telefoon
  //     En onthoud uw unieke code die staat hier:
  //     $uniekeCode
  //   ";
  //   $headers = "From: GLR kaartjes";
  //
  //   if (mail($to_email, $subject, $body, $headers)) {
  //       echo "Email successvol verzonden naar $to_email... <br> Je kan nu in je inbox kijken en check dan de informatie. <br> <button onclick='history.back(); return false;'>Ga terug</button>";
  //   } else {
  //       echo "Email verzenden gefaald... <br> <button onclick='history.back(); return false;'>Ga terug</button>";
  //   }
  // }

  function send_mail($to, $uuid, $voornaam, $achternaam, $datum, $telefoon, $uniekeCode)
  {

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    $fh = fopen('../config.txt','r'); // is for the password it's in a txt file for safety measures
    while ($line = fgets($fh))
    {
      $password = $line;
    }
    fclose($fh);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'toudoukirin7@gmail.com';               //SMTP username
        $mail->Password   = $password;                              //SMTP password
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('toudoukirin7@gmail.com', 'GLR kaartjes');
        $mail->addAddress($to);     //Add a recipient
        $mail->addReplyTo('toudoukirin7@gmail.com', 'GLR kaartjes');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Aanvraag account voor Portfoliosite - $bedrijf';
        $mail->Body    = "
          Uw gegevens uit het inschrijfformulier: <br>
          - $voornaam $achternaam <br>
          - $datum <br>
          - $telefoon <br>
          En onthoud uw unieke code die staat hier: <br>
          $uniekeCode
        ";

        $mail->send();
        echo "Email successvol verzonden... $to <br>Je kan nu in je inbox kijken en check dan de informatie.<br><button onclick='history.back(); return false;'>Ga terug</button>";
    } catch (Exception $e) {
        echo "Email verzenden fout gegaan... <br> <button onclick='history.back(); return false;'>Ga terug</button> <br> Mailer Error: {$mail->ErrorInfo}";
    }
  }
?>
