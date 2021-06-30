<?php
  session_start();

  $uuid = $_GET['id'];
  $email = $_GET['e'];
  $voornaam = $_GET['v'];
  $achternaam = $_GET['a'];
  $unieke = $_GET['u'];

  include "php/html.php";
  include "php/config.php";
  include "php/email.php";
  include "php/mail_delete.php";

  $token = bin2hex(openssl_random_pseudo_bytes(32));
	$_SESSION['token'] = $token;

  //function om errors makkelijker te maken. en maakt het wat mooier uitzien
  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  display_header("Inloggen");

  ?>
    <main>
        <?php
          if (isset($_POST['submit']))
          {
              $firstName = htmlspecialchars($_POST['voornaam'], ENT_QUOTES);
              $lastName = htmlspecialchars($_POST['achternaam'], ENT_QUOTES);
              $uniqueCode = htmlspecialchars($_POST['uniek'], ENT_QUOTES);
              $UUID = htmlspecialchars($_POST['uuid'], ENT_QUOTES);
              $emailAdres = $_POST['email'];

              if(!empty($firstName) || !empty($lastName) || !empty($uniqueCode) || !empty($UUID) || !empty($emailAdres))
              {
                if (email_validate($emailAdres))
                {
                  if ($firstName == $voornaam && $lastName == $achternaam && $unieke == $uniqueCode && $UUID == $uuid && $emailAdres == $email)
                  {
                    $query = "DELETE FROM `inschrijver` WHERE Inschrijf_ID = ? AND Voornaam = ? AND Achternaam = ? AND Email = ? AND UniekeCode = ?";

                    if ($stmt = mysqli_prepare($mysqli, $query))
                    {
                      mysqli_stmt_bind_param($stmt, "ssssi", $UUID, $firstName, $lastName, $emailAdres, $uniqueCode);

                      if(!mysqli_stmt_execute($stmt))
                      {
                        error("Er is iets fout gegaan met het verbinden met de database probeer het later opnieuw!");
                      } else
                      {
                        $result = mysqli_stmt_get_result($stmt);

                        if (!$result)
                        {
                          delete_mail($emailAdres, $firstName, $lastName, $emailAdres, $uniqueCode);

                          mysqli_stmt_close($stmt);

                          header("Location: index.php");
                        } else
                        {
                          error("Er is iets fout gegaan!");
                        }
                      }
                    } else
                    {
                      error("Er is iets fout gegaan bij het klaar zetten van de mysql server...");
                    }
                  } else
                  {
                    error("Een van de velden klopt niet meer!");
                  }
                } else
                {
                  error("Emailadres klopt niet!");
                }
              } else
              {
                error("Sommige velden zijn leeg gelaten!");
              }
          } else
          {
         ?>
        <form class="form" method="post">
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"/>
          <input type="hidden" name="voornaam" value="<?php echo $voornaam ?>">
          <input type="hidden" name="achternaam" value="<?php echo $achternaam ?>">
          <input type="hidden" name="email" value="<?php echo $email ?>">
          <input type="hidden" name="uniek" value="<?php echo $unieke ?>">
          <input type="hidden" name="uuid" value="<?php echo $uuid ?>">
          <h2><?php echo $voornaam." ".$achternaam ?> Verwijderen</h2>
          <h3>Voornaam</h3>
          <input type="text" value="<?php echo $voornaam ?>" disabled>
          <h3>Achternaam</h3>
          <input type="text" value="<?php echo $achternaam ?>" disabled>
          <h3>Email</h3>
          <input type="text" value="<?php echo $email ?>" disabled>
          <h3>Unieke Code</h3>
          <input type="text" value="<?php echo $unieke ?>" disabled> <br> <br>
          <input class="submit" type="Submit" name="submit" value="Inschrijven!">
        </form>
        <?php
          }
         ?>
    </main>
  <?php

  display_footer();

 ?>
