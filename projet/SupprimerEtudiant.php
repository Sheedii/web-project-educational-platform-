<?php
   session_start();
   $erreur="";
   @$supprimer=$_GET["supprimer"];
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
    if($_SESSION["supp"]=="not ok"){
        $erreur="CIN introuvable !";}
    if ($_SESSION["supp"]=="ok"){
        $erreur="Suppression  avec Succes!";}
      $_SESSION["supp"]="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SCO-ENICAR Supprimer Etudiant</title>
        <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap core JS-JQUERY -->
    <script src="jquery.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>

        <!-- Custom styles for this template -->
        <link href="jumbotron.css" rel="stylesheet">

        <style>
            .erreur{
            color:red;
            position:center;
          }
          li {
              border-right: 1px solid #bbb;
              border-color: cornflowerblue;
         }
         li:last-child {
               border-right: none;
          }
        </style>

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-info">
    <img style="width: 80px;" src="logoa.png" alt="">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul style="margin-left: auto; margin-right: auto;" class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
        
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les ??tudiants</a>
                <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
                <a class="dropdown-item" href="#">Ajouter Groupe</a>
                <a class="dropdown-item" href="#">Modifier Groupe</a>
                <a class="dropdown-item" href="#">Supprimer Groupe</a>
      
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
                <a class="dropdown-item" href="etatAbsence.php">??tat des absences pour un groupe</a>
              </div>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link" href="deconnexion.php">Se D??connecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
          <img style="width: 120px;" src="logoenicarthage.jpg" alt="">
        </div>
      </nav>
      
<main role="main">
        <div class="jumbotron">
            <div style="text-align: center;" class="container">
              <h1 class="display-4">Supprimer un ??tudiant</h1>
              <p>Taper le CIN d'??tudiant ?? supprimer!</p>
            </div>
          </div>

          <div class="container">
    <!-- TRAVAILLER ICI-->
    <form action="SupprimerET.php" method="GET" id="myform">
    <h5 class="erreur"> <?php echo $erreur;?></h5>
        <div class="form-group">
            <label for="cin">TAPER CIN:</label><br>
            <input type="text" id="cin" name="cin"  class="form-control" required pattern="[0-9]{8}" title="8 chiffres"/>
        </div>
        <!--Bouton Supprimer-->
        <button  type="submit" class="btn btn-primary btn-block" name="supprimer">Supprimer</button>
    </form>
</div>

</main>
<footer class="container">
    <p style="text-align: center ;">&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>
<?php $erreur="";?>
