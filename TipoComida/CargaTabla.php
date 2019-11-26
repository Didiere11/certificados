<?php
      include_once("../Utilerias/BaseDatos.php");
      $padre = consultaPadreTutor();
      foreach ($padre as $tupla){
          $idpadre = $tupla['idpadre'];  
          $nom = $tupla['nompadre'];
          $corr = $tupla['correopadre'];
          $parent = $tupla['parentesco'];
          $dom = $tupla['dompadre'];
          $tel = $tupla['telpadre'];
          echo "<tr id='$idpadre'><td>$nom</td><td>$corr</td><td>$parent</td><td>$tel</td><td>
<i class='material-icons edit' data-idpadre='$idpadre' data-nom='$nom' data-corr='$corr'data-paren='$parent' data-dom='$dom' data-tel='$tel'>create</i>
<i class='material-icons delete' data-idpadre='$idpadre'>delete_forever</i></td></tr>";
      }
?>