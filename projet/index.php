<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   if(date("H")<18)
      $bienvenue="Bonjour et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
   else
      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
?>
<!doctype html>
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
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron" id="test">
    <div class="container" id="fond">
      <h1 class="display-3" id="text"><p style="color: black;" ><?php echo $bienvenue?> </p> </h1>
      <p><a class="btn btn-primary btn-lg" href="information.html" role="button">enicarthage formation &raquo;</a></p>
    </div>
</main>


<footer class="container">
  <p style="text-align: center ;">&copy; ENICAR 2021-2022</p>
</footer>


   
      
  </body>
</html>
