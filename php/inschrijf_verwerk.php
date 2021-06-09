<?php
  session_start();

  include "date.php";
  include "email.php";
  include "uuid.php";
  include "html.php";
  include "telephone.php";
  include "config.php";

  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  $uniekeCode = rand(pow(10, 5-1), pow(10, 5)-1);
  $uuid = uuidv4();

  display_header("Inschrijving verwerken...", $inFolder = true);

  ?>
    <main>
      <?php
      if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['csrf_token'])
		  {
        if (isset($_POST['submit']))
        {
          $voornaam = htmlspecialchars($_POST['voornaam'], ENT_QUOTES);
          $achternaam = htmlspecialchars($_POST['achternaam'], ENT_QUOTES);
          $telefoon = htmlspecialchars($_POST['telefoon'], ENT_QUOTES);
          $datum = htmlspecialchars($_POST['datum'], ENT_QUOTES);
          $email = $_POST['email'];
          if (!empty($voornaam) && !empty($achternaam) && !empty($telefoon) && !empty($datum) && !empty($email))
          {
            if(checkIsAValidDate($datum))
            {
              if (email_validate($email))
              {
                if(telephone_validate($telefoon))
                {
                  $stmt = mysqli_prepare($mysql, 'INSERT INTO `inschrijver`
											(`Inschrijf_ID`, `Voornaam`, `Achternaam`, `Geboortedatum`, `Telefoonnummer`, `Email`, `UniekeCode`)
											VALUES (?, ?, ?, ?, ?, ?, ?)');

											mysqli_stmt_bind_param($stmt, 'ssssssi', $uuid, $voornaam, $achternaam, $datum, $telefoon, $email, $uniekeCode);

											mysqli_stmt_execute($stmt);

											$result = mysqli_stmt_get_result($stmt);
                } else
                {
                  error("Telefoon nummer klopt niet");
                }
              } else
              {
                error("Emailadres klopt niet!");
              }
            } else
            {
              error("Datum klopt niet!");
            }
          } else
          {
            error("Sommige velden zijn leeg gelaten!");
          }
        } else
        {
          error("Formulier is niet ingevuld!");
        }
      } else
      {
        error("CRSF Token is incorrect!");
      }
       ?>
    </main>
  <?php

  display_footer();

 ?>
