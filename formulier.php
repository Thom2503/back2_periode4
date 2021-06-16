<?php
  session_start();

  include "php/html.php";
  include "count_people.php";

  $token = bin2hex(openssl_random_pseudo_bytes(32));
	$_SESSION['token'] = $token;

  display_header("Inschrijven");

  ?>
    <main>
      <?php if (getPeopleCount() >= 10): ?>
        <div class="form">
          <h2>Helaas...</h2>
          <p>Je bent te laat met het inschrijven. <br>
            Maar blijf de pagina checken het kan zijn dat iemand uit de lijst word verwijderd. <br>
            We hopen dat degene die gewonnen hebben een gezellige tijd hebben tijdens de eerste wedstrijd van het Nederlands Elftal! 
          </p>
        </div>
      <?php else: ?>
        <form class="form" action="php/inschrijf_verwerk.php" method="post">
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"/>
          <h2>Hier inschrijven</h2>
          <h3>Voornaam</h3>
          <input type="text" name="voornaam" placeholder="Voornaam">
          <h3>Achternaam</h3>
          <input type="text" name="achternaam" placeholder="Achternaam">
          <h3>Geboortedatum</h3>
          <input type="date" name="datum">
          <h3>Telefoon</h3>
          <input type="text" name="telefoon" placeholder="Telefoon">
          <h3>Email</h3>
          <input type="text" name="email" placeholder="Email"><br><br>
          <input class="submit" type="Submit" name="submit" value="Inschrijven!">
        </form>
      <?php endif; ?>
    </main>
  <?php

  display_footer();

 ?>
