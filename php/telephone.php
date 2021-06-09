<?php
  function telephone_validate($t)
  {
    //the pattern for telephone regex.
    $pattern = "/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/";

    return (bool)preg_match($pattern, trim($t));
  }
 ?>
