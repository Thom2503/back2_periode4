<?php

  session_start();

  if (!$_SESSION['loggedin'])
  {
    header("location: formulier.php");
  }

  include "php/html.php";
  include "php/config.php";
  include "count_people.php";

  function error($message)
  {
    echo $message."<br>";
    echo "<button onclick='history.back(); return false;'>Ga terug</button>";
  }

  display_header("Admin panel");

  ?>
    <main>
      <?php
        //query om gegevens te krijgen van beide bedrijven en studenten
        $query = "SELECT * FROM `inschrijver`";

        if($stmt = mysqli_prepare($mysqli, $query))
        {
          if(!mysqli_stmt_execute($stmt))
          {
            error("Er is iets fout gegaan met het verbinden met de database probeer het later opnieuw!");
          } else
          {
            $result = mysqli_stmt_get_result($stmt);

            if ($result)
            {
              ?>
                <h2>Ingeschreven mensen:</h2>
                <?php if (getPeopleCount() >= 10): ?>
                  <p>Inschrijvingen zitten vol er zijn <?php echo getPeopleCount() ?> mensen ingeschreven.</p>
                <?php else: ?>
                  <p>Er zijn <?php echo getPeopleCount() ?> van de 10 mensen ingeschreven</p>
                <?php endif; ?>
                <table>
                  <thead>
                    <tr>
                      <td>Voornaam</td>
                      <td>Achternaam</td>
                      <td>Geboortedatum</td>
                      <td>Telefoonnummer</td>
                      <td>E-Mail</td>
                      <td>Unieke Code</td>
                      <td>Verwijderen</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($result as $rij): ?>
                      <tr>
                        <td><?php echo $rij['Voornaam'] ?></td>
                        <td><?php echo $rij['Achternaam'] ?></td>
                        <td><?php echo $rij['Geboortedatum'] ?></td>
                        <td><?php echo $rij['Telefoonnummer'] ?></td>
                        <td><?php echo $rij['Email'] ?></td>
                        <td><?php echo $rij['UniekeCode'] ?></td>
                        <td> <a href="verwijder.php?u=<?php echo $rij['UniekeCode'] ?>&id=<?php echo $rij['Inschrijf_ID'] ?>&v=<?php echo $rij['Voornaam'] ?>&a=<?php echo $rij['Achternaam'] ?>&e=<?php echo $rij['Email'] ?>">
                          Verwijder</a> </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              <?php
            } else
            {
              error("Er is iets fout gegaan!");
            }
          }
        }
       ?>
    </main>
  <?php

  display_footer();

 ?>
