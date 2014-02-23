<?php

  require_once 'kayttaja.php';
  require_once '../tietokantayhteys.php';

  $sql = "SELECT tunnus, salasana from Kayttaja";
  $kysely = getTietokantayhteys()->prepare($sql);
  $kysely->execute();

  $tulokset = array();
  foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
    $kayttaja = new Kayttaja($tulos->tunnus, $tulos->salasana);
    $tulokset[] = $kayttaja;
  }

?>


<!DOCTYPE HTML>
<html>
  <head><title> Listaustesti </title></head>
  <body>
    <h1> Listaustesti </h1>

    <p> Käyttäjät listattuna: </p>
    <ul>
    <?php foreach($tulokset as $kayttaja) { ?>
      <li><?php echo $kayttaja->getTunnus(); ?></li>
    <?php } ?>
    </ul>
  </body>
</html>
