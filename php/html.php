<?php

  /*
    Header function
  */
  function display_header($title = NULL, $inFolder = false)
  {
    ?>
      <!DOCTYPE html>
      <html lang="nl" dir="ltr">
        <head>
          <meta charset="utf-8">
          <title><?php echo $title ?></title>
          <?php if ($inFolder == true): ?>
            <link rel="stylesheet" href="../css/custom.css">
          <?php else: ?>
            <link rel="stylesheet" href="css/custom.css">
          <?php endif; ?>
        </head>
        <body>
          <header>
            <h1>GLR Wedstrijd</h1>
            <em>Win kaartjes voor de eerste wedstrijd van het Nederlands elftal!</em><br>
            <?php if ($inFolder == true): ?>
              <a href="../inlog.php">Inloggen</a> | <a href="../loguit.php">Uitloggen</a>
            <?php else: ?>
              <a href="inlog.php">Inloggen</a> | <a href="loguit.php">Uitloggen</a>
            <?php endif; ?>
          </header>
    <?php
  }

  /*
    footer function will include external scripts and such
  */

  function display_footer()
  {
    ?>

        </body>
      </html>
    <?php
  }

 ?>
