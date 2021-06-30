<?php
  session_start();

  include "php/html.php";

  $token = bin2hex(openssl_random_pseudo_bytes(32));
	$_SESSION['token'] = $token;

  display_header("Inloggen");

  ?>
    <main>
        <form class="form" action="php/inlog_verwerk.php" method="post">
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"/>
          <h2>Inloggen</h2>
          <h3>Gebruikersnaam</h3>
          <input type="text" name="gebruikersnaam" placeholder="gebruikersnaam">
          <h3>Wachtwoord</h3>
          <input type="password" name="wachtwoord" placeholder="wachtwoord"> <br> <br>
          <input class="submit" type="Submit" name="submit" value="Inschrijven!">
        </form>
    </main>
  <?php

  display_footer();

 ?>
