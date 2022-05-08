<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }else{
  
  if(isset($_REQUEST['module']) && isset($_REQUEST['check'])){
    include("connexion.php");
    $etat=$_REQUEST['etat'];
     $module=$_REQUEST['module'];
     $choix=$_REQUEST['check'];
     foreach($choix as $value){
       $chaine=explode('_',$value);
       $dt = DateTime::createFromFormat('d/m/Y', $chaine[0]);
       $date=$dt->format('Y-m-d');
       $heure=$chaine[1];
       $cin=intval($chaine[2]); 

         $sel=$pdo->prepare("select * from absence where cin=? and date=? and heure=? and module=? limit 1");
         $sel->execute(array($cin,$date,$heure,$module));
         $tab=$sel->fetchAll();
         if(count($tab)>0){
            $erreur=-1;
            header("location:saisirAbsence.php?erreur=$erreur");
            // absence deja inscrit
         }else{
            $req="insert into absence(date,heure,etat,module,cin) values ('$date','$heure',$etat,'$module',$cin)";
            $reponse = $pdo->exec($req) or die("error");
            $erreur =1;
            header("location:saisirAbsence.php?erreur=$erreur");
         } 

     }
   }
 }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Walid SAAD">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SCO-ENICAR</title>
    <!-- Bootstrap core CSS -->
<link href="bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="jquery.min.js"></script>
<script src="bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
    <style>
      li {
              border-right: 1px solid #bbb;
              border-color: cornflowerblue;
         }
         li:last-child {
               border-right: none;
          }

      /*Ajouter fond image dynamique*/
      .jumbotron{
        background-position:center;
        background-size:cover;
        text-align:center;
        justify-content:center;
      }
      
    </style>

  </head>
  <body>
    <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-info">
      <div>
      <img style="width: 80px;" src="logoa.png" alt="">
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul style="margin-left: auto; margin-right: auto;" class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
      
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>        
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
              <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
              <a class="dropdown-item" href="AjouterGroupe.php">Ajouter Groupe</a>
              <a class="dropdown-item" href="ModifierGroupe.php">Modifier Groupe</a>
              <a class="dropdown-item" href="SupprimerGroupe.php">Supprimer Groupe</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="ajouterEtudiant.php">Ajouter Etudiant</a>
              <a class="dropdown-item" href="ChercherEtudiant.php">Chercher Etudiant</a>
              <a class="dropdown-item" href="ModifierEtudiant.php">Modifier Etudiant</a>
              <a class="dropdown-item" href="SupprimerEtudiant.php">Supprimer Etudiant</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
              <a class="dropdown-item" href="etatAbsence.php">État des absences pour un groupe</a>
            </div>
          </li>

          <li  class="nav-item active">
            <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
          </li>

        </ul>
      </div>
      <div>
        <img style="width: 120px;" src="logoenicarthage.jpg" alt="">
      
      </div>
    </nav> 
  </header>

    </head>

    <body>      
<main role="main">
        <div class="jumbotron">
            <div class="container">
              <h1 class="display-4">Signaler l'absence pour tout un groupe</h1>
              <p>Pour signaler, annuler ou justifier une absence, choisissez d'abord le groupe, le module puis l'étudiant concerné!</p>
            </div>
          </div>

<div class="container">
<form method="get" action="">
<div class="form-group">
  <label for="semaine">Choisir une semaine:</label><br>
  <input id="semaine" type="week" name="debut" size="10" class="datepicker"/>
</div>
  <div class="form-group">
<label for="classe">Choisir un groupe:</label><br>

<label for="classe">Groupe:</label><br>
<select id="classe" name="id"  class="custom-select custom-select-sm custom-select-lg">
                    <?php
                      include("connexion.php");
  $req="SELECT * FROM groupe";
  $reponse = $pdo->query($req);
  $tab=$reponse->fetchAll();
  if(count($tab)>0){
   foreach($tab as $value){

   

?>

    <option value="<?=$value["nom"]?>"><?php echo $value["nom"];?></option>
    <?php
   } 

       
   }
   ?>

   </select>
   </div>
   <button type="submit" class="btn btn-primary btn-block">Afficher</button>
  </form>

<?php
  if (isset($_REQUEST["id"])){
    $s=$_REQUEST['debut'];
    
    $id=$_REQUEST["id"];
    $sel=$pdo->prepare("SELECT * FROM etudiant WHERE Classe=? order by nom");
    $sel->execute(array($id));
    $count=$sel->rowcount();
    if($count>0){
        $tab=$sel->fetchAll();
        
      
    

  ?>
<form method="get" action="">
<div class="form-group">
  <label for="module">Choisir un module:</label><br>
  <select id="module" name="module"  class="custom-select custom-select-sm custom-select-lg">
      <option value="Tech. Web">Tech. Web</option>
      <option value="SGBD">SGBD</option>
      <option value="Analyse_num">Analyse_num</option>
      <option value="Architecture">Architecture</option>
      <option value="UML">UML</option>
  </select>
  </div>
  <div class="form-group">
  <label for="etat">Choisir :</label><br>
  <select id="etat" name="etat"  class="custom-select custom-select-sm custom-select-lg">
      <option value="1">Justifiée</option>
      <option value="0">Non Justifiée</option>
  </select>
  </div>
<table style="margin-left: auto ; margin-right: auto ;" rules="cols" frame="box">


  <tr><th><center><?=$count?> Etudiants</center></th>
  
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Lundi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Mardi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Mercredi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Jeudi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Vendredi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Samedi</th>
</tr><tr><td>&nbsp;</td>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?=date("d/m/Y", strtotime($s));?></th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?=date("d/m/Y", strtotime($s.'+ 1 days'));?></th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?=date("d/m/Y", strtotime($s.'+ 2 days'));?></th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?=date("d/m/Y", strtotime($s.'+ 3 days'));?></th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?=date("d/m/Y", strtotime($s.'+ 4 days'));?></th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?=date("d/m/Y", strtotime($s.'+ 5 days'));?></th>
</tr><tr><td>&nbsp;</td>
<th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th>
</tr>
<?php
  foreach($tab as $value){
   ?>
<tr    class="row_3"><td><b><?=$value['nom']." ".$value['prenom']?></b></td>
<td><input name="check[]" type="checkbox" value="<?=date("d/m/Y", strtotime($s))."_AM"."_".$value['cin'];?>"></td>
<td><input name="check[]" type="checkbox" value="<?=date("d/m/Y", strtotime($s))."_PM"."_".$value['cin'];?>"></td>
<td><input name="check[]" type="checkbox" value="<?=date("d/m/Y", strtotime($s.'+ 1 days'))."_AM"."_".$value['cin'];?>"></td>
<td><input name="check[]" type="checkbox" value="<?=date("d/m/Y", strtotime($s.'+ 1 days'))."_PM"."_".$value['cin'];?>"></td>
<td><input name="check[]" type="checkbox" value="<?=date("d/m/Y", strtotime($s.'+ 2 days'))."_AM"."_".$value['cin'];?>"></td>
<td><input name="check[]" type="checkbox" value="<?=date("d/m/Y", strtotime($s.'+ 2 days'))."_PM"."_".$value['cin'];?>"></td>
<td><input name="check[]" type="checkbox" value="<?=date("d/m/Y", strtotime($s.'+ 3 days'))."_AM"."_".$value['cin'];?>"></td>
<td><input name="check[]" type="checkbox" value="<?=date("d/m/Y", strtotime($s.'+ 3 days'))."_PM"."_".$value['cin'];?>"></td>
<td><input name="check[]" type="checkbox" value="<?=date("d/m/Y", strtotime($s.'+ 4 days'))."_AM"."_".$value['cin'];?>"></td>
<td><input name="check[]" type="checkbox" value="<?=date("d/m/Y", strtotime($s.'+ 4 days'))."_PM"."_".$value['cin'];?>"></td>
<td><input name="check[]" type="checkbox" value="<?=date("d/m/Y", strtotime($s.'+ 5 days'))."_AM"."_".$value['cin'];?>"></td>
<td><input name="check[]" type="checkbox" value="<?=date("d/m/Y", strtotime($s.'+ 5 days'))."_PM"."_".$value['cin'];?>"></td>
</tr>
<?php
  }
  ?>

</table>
<br>
 <!--Bouton Valider-->
 <button  type="submit" class="btn btn-primary btn-block">Valider</button>
</form>

<?php

}
}


?>
</div>  
</main>

<footer class="container">
    <p style="text-align: center ;">&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>