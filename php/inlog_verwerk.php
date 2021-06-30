<?php
  session_start();

  include "html.php";

  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  $ww = "#1Geheim";
  $username = "admin";

  display_header("Inloggen verwerken...", $inFolder = true);

  ?>
    <main>
      <?php
      if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['csrf_token'])
		  {
        if (isset($_POST['submit']))
        {
          $gebruikersnaam = htmlspecialchars($_POST['gebruikersnaam'], ENT_QUOTES);
          $wachtwoord = htmlspecialchars($_POST['wachtwoord'], ENT_QUOTES);
          if (!empty($gebruikersnaam) && !empty($wachtwoord))
          {
            if ($gebruikersnaam == $username)
            {
              if ($wachtwoord == $ww)
              {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $gebruikersnaam;
                $_SESSION['password'] = $wachtwoord;


                header("location: ../index.php");
              } else
              {
                error("Wachtwoord is incorrect");
              }
            } else
            {
              error("Gebruikersnaam is incorrect!");
            }
          } else
          {
            error("Sommige velden zijn leeg gelaten!");
          }
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
