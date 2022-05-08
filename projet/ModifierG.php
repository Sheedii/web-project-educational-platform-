<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
$groupe=$_REQUEST['nom'];
$_SESSION['nom']=$groupe;


include("connexion.php");
         $sel=$pdo->prepare("select * from groupe where nom=? limit 1");
         $sel->execute(array($groupe));
         $tab=$sel->fetchAll();
         if(count($tab)==0){
 
            $_SESSION["modifierG"]="not ok";
            header("location:ModifierGroupe.php");
         }
         else{
            $sel=$pdo->prepare("select * from groupe where nom=? limit 1 ");
            $sel->execute(array($groupe));
            $_SESSION["modifierG"]="ok";
            echo (' <!DOCTYPE html>
            <html lang="en">
            <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>SCO-ENICAR modifier groupe</title>
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
                          <h1 class="display-4">Modifier un Groupe</h1>
                          <p>Remplir le formulaire ci-dessous afin de modifier  un Groupe!</p>
                        </div>
                      </div>
            
            
            <div class="container">
             <form id="myform" method="GET" action="updateG.php">
             <div class="form-group">
               <input type="text" id="nom" name="classe" class="form-control" placeholder="saisir le groupe" required pattern="[A-Z]{4,8}[1-3]{1}-[A-E]{1}"
               title="Pattern INFOX-X. Par Exemple: INFO1-A, GSIL2-E, INFO3-B">
            </div>

            <button  type="submit" class="btn btn-primary btn-block" name="ajouter">Enregistrer</button>
            
            
            </form> 
           </div>  
           </main>

         <footer class="container">
        <p style="text-align: center ;">&copy; ENICAR 2021-2022</p>
         </footer>
       
       <script  src="inscrire.js"></script>
       </body>
       </html>
       ');
           
            @$msg="groupe modifier avec succees";
         }  
}
?>