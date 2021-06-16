<?php
  function getPeopleCount()
  {
    require "php/config.php";

    //om te kijken hoeveel entries er zijn in een tabel
    $query = "SELECT COUNT(*) FROM inschrijver";

    $result = mysqli_query($mysqli, $query);

    $numRows = mysqli_num_rows($result);
    if ($numRows == 1)
    {
      //pakt de user uit de database
      $row = mysqli_fetch_assoc($result);

      return $row['COUNT(*)'];
    } else
    {
      return 0;
    }
  }

 ?>
