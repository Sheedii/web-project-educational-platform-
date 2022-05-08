<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
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
      
<main role="main">
        <div class="jumbotron">
            <div style="text-align: center;" class="container">
              <h1 class="display-4">État des absences pour un groupe</h1>
              <p>Pour afficher l'état des absences, choisissez d'abord le groupe  et la periode concernée!</p>
            </div>
          </div>

<div class="container">
<form method="get" action="">
  <table><tr><td>Date de début (j/m/a) : </td><td>
    <input type="date" name="debut" size="10" class="datepicker"/>
    </td></tr><tr><td>Date de fin : </td><td>
    <input type="date" name="fin" size="10"  class="datepicker"/>
    </td></tr></table>

<div class="form-group">
<label for="classe">Choisir une classe:</label><br>

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
  if(isset($_REQUEST['id']) && isset($_REQUEST['debut']) && isset($_REQUEST['fin'])){
    include("connexion.php");
    $id=$_REQUEST['id'];
     $debut=$_REQUEST['debut'];
     $fin=$_REQUEST['fin'];

         $sel=$pdo->prepare("select a.cin, e.nom as nom,e.prenom as prenom,count(case etat when '1' then 1 else null end) as j,count(case etat when '0' then 1 else null end) as nj, count(*) as total from absence a, etudiant e where e.Classe=? and a.cin=e.cin and a.date BETWEEN ? and ? GROUP BY a.cin");
         $sel->execute(array($id,$debut,$fin));
         $tab=$sel->fetchAll();
         if(count($tab)>0){
  ?>

<div class="table-responsive"> 
  <table class="table table-striped table-hover">
  <thead>
  <tr class="gt_firstrow " ><th >Nom</th><th>Justifiées</th><th >Non justifiées</th><th >Total</th></tr>
  </thead>
  <tbody>
  <?php
  foreach($tab as $value){
   
   ?>
  <tr><td><b><?=$value['nom']." ".$value['prenom']?></b></td><td ><?=$value['j']?></td><td ><?=$value['nj']?></td><td ><?=$value['total']?></td></tr>
 
  <?php
  }
  ?>
  </tbody>
  <tfoot>
  </tfoot>
  </table>
  </div>
  <?php
}
else 
echo"<p>Pas d'absence dans cette periode poue ce groupe</p>";
}
?>
</div>  
</main>
<footer class="container">
    <p style="text-align: center ;">&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>