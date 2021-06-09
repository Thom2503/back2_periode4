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

  $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

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
                  echo "Hallo mensen";
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
