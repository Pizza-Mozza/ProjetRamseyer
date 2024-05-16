<?php
session_start();




if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php"); // ou vers une page de confirmation
    exit();
}

// ...


// Récupérer la liste des étudiants dans la table etudiant

// 1. Connexion à la base de donnée db_intro
/**
 * @var PDO $pdo
 */
require_once '../base.php';
require_once BASE_PROJET .
    '/src/config/db-config.php';
require_once BASE_PROJET .
    '/src/_partials/header.php';
// 2. Préparation de la requête
$requete = $pdo->prepare(query: "SELECT * FROM produit");

// 3. Exécution de la requête
$requete->execute();

// 4. Récupération des enregistrements
// Un enregistrement = un tableau associatif
$produits = $requete->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Flying Horse</title>
</head>
<body class="bg-secondary-subtle">
<h1 class="text-center mt-3 text-primary">Bienvenue chez Flying Horse Studio <?php if (isset($_SESSION['email']) && isset($_SESSION['mdp'])) {  echo $_SESSION['email'] . " !</h1>";}?></h1>
<h3 class="text-center">Présentation du studio </h3>

<div class="w-50 mx-auto shadow p-4 bg-light-subtle mt-3 mb-5 rounded-4 bg-gradient">
<p>Flying Horse Studio est un studio indépendant ayant pour objectif principal de proposer aux joueurs des jeux qui les combleront de satisfaction au lieu de combler le compte en banque d'actionnaire ignorant la qualité.</p>
</div>
<div class="d-flex mt-2">
    <div class=" rounded-4 p-3 flex-fill">
        <div class="container ">
            <!-- Votre code -->
            <div class="row text-center  ">
                <?php foreach ($produits as $produit) : ?>
                    <div class="card border-dark  mb-3 me-2 bg-light-subtle " style="max-width: 20rem;">
                        <div class="card-body shadow-lg p-3 mb-1 bg-body rounded">
                            <h4 class="card-title "><a href="recup-param.php?id_produit=<?= $produit['id_produit'] ?>
                        "><img class="img-fluid " src="<?= $produit["image_produit"] ?> "style="width: 250px ;height:350px" alt=""</h4>
                            <p class="card-text"><?= $produit["nom_produit"] ?></p></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once BASE_PROJET .
    '/src/_partials/footer.php';?>
</body>
</html>