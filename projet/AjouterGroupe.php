<?php
    session_start();
    $erreur="";
    if($_SESSION["autoriser"]!="oui"){
       header("location:login.php");
       exit();
    }
     if($_SESSION["ajout"]=="not ok"){
         $erreur="Ce groupe existe déjà!";}
     if ($_SESSION["ajout"]=="ok"){
         $erreur="Ajout  avec Succes!";
     }
      $_SESSION["ajout"]="";//pour mettre la valeur de $erreur="" (vide)
?>
<!DOCTYPE html>
<html lang="en">
<head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SCO-ENICAR ajouter groupe</title>
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
          }
          #demo{
            color:red;
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
                <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
                <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
                <a class="dropdown-item" href="#">Ajouter Groupe</a>
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
      
            <li class="nav-item active">
              <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
          <img style="width: 120px;" src="logoenicarthage.jpg" alt="">
        </div>
      </nav>
      
<main role="main">
        <div class="jumbotron">
            <div style="text-align: center;" class="container">
              <h1 class="display-4">Ajouter un Groupe</h1>
              <p>Saisir le Groupe à ajouter</p>
            </div>
        </div>

        <div class="container">
            <!-- TRAVAILLER ICI-->
            <h5 class="erreur"> <?php echo $erreur;?></h5>
            <form action="ajoutG.php" method="GET"  >
                <div class="form-group">
                  <input type="text" id="classe" name="groupe" class="form-control" placeholder="saisir le groupe" required pattern="[A-Z]{4}[1-3]{1}-[A-E]{1}"
                  title="Par Exemple: INFO1-A, GSIL2-E, MECA3-C">
                  <br>
                   <button  type="submit" class="btn btn-primary btn-block" name="ajouter">Ajouter</button>
                </div>
            </form>
               
        </div>

</main>
<footer class="container">
    <p style="text-align: center ;">&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>