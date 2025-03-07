<?php
session_start();

require 'model/Enfant.php';
require 'db/enfants.php';
$nom = $prenom = $adresse = $tel = $password = '';
$errors = [];
$enfant = new Enfant(); // Initialisation des variables

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et nettoyage des données
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $adresse = trim($_POST["adresse"]);
    $tel = trim($_POST["tel"]);
  

    // Validation des champs
    if (empty($nom) || !preg_match("/^[a-zA-Z-' ]*$/", $nom)) {
        $errors["nom"] = "Le nom ne peut pas être vide.";
    }
    $enfant->setNom($nom);
    if (empty($prenom)|| !preg_match("/^[a-zA-Z-' ]*$/", $prenom)) {
        $errors["prenom"] = "Le prénom ne peut pas être vide.";
    }
    $enfant->setPrenom($prenom);
    if (empty($adresse) || !preg_match("/^[a-zA-Z-' ]*$/", $adresse)) {
        $errors["adresse"] = "L'adresse est requise.";
    }
    $enfant->setAdresse($adresse);
    if (empty($tel)) {
        $errors["tel"] = "Le téléphone est requis.";
    } elseif (!preg_match("/^[2-4]\d{7}$/", $tel)) {
        $errors["tel"] = "Numéro invalide (8 chiffres requis mattel/chinguitel/mauritel).";
    }
    $enfant->setTel($tel);

    
    if ($db->isExiste($enfant)) {
        $_SESSION["error"] = "Cet enfant existe déjà";
        
    }

    // Si aucune erreur, insérer dans la base de données
    if (empty($errors)) {
        $db->ajouterEnfant($enfant);
        
        $_SESSION["success"] = "Inscription effectuée avec succès";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Inscription</title>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-md">
    <?php
    if(isset($_SESSION['success'])){?>
    <span class="text-green-500 p-2 text-center"><?= $_SESSION['success'] ?></span>
    <?php
    }elseif(isset($_SESSION['error'])){?>
    <span class="text-red-500 p-2 text-center"><?= $_SESSION['error'] ?></span>
    <?php
    }
     ?>
        <h2 class="text-green-500 text-center text-2xl font-bold mb-4">Inscription</h2>
        <form action="" method="post" class="space-y-4">
            <div>
                <label class="block text-gray-700 text-lg font-semibold mb-1" for="nom">Nom</label>
                <input class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" 
                       value="<?= htmlspecialchars($nom) ?>" type="text" id="nom" name="nom" />
                <div class="text-red-400 p-1 w-full"><?= $errors['nom'] ?? '' ?></div>
            </div>

            <div>
                <label class="block text-gray-700 text-lg font-semibold mb-1" for="prenom">Prénom</label>
                <input class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" 
                       value="<?= htmlspecialchars($prenom) ?>" type="text" id="prenom" name="prenom" />
                <div class="text-red-400 p-1 w-full"><?= $errors['prenom'] ?? '' ?></div>
            </div>

            <div>
                <label class="block text-gray-700 text-lg font-semibold mb-1" for="adresse">Adresse</label>
                <input class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" 
                       value="<?= htmlspecialchars($adresse) ?>" type="text" id="adresse" name="adresse" />
                <div class="text-red-400 p-1 w-full"><?= $errors['adresse'] ?? '' ?></div>
            </div>

            <div>
                <label class="block text-gray-700 text-lg font-semibold mb-1" for="telephone">Téléphone</label>
                <input class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" 
                       value="<?= htmlspecialchars($tel) ?>" type="tel" id="telephone" name="tel" />
                <div class="text-red-400 p-1 w-full"><?= $errors['tel'] ?? '' ?></div>
            </div>


            <button type="submit" class="w-full bg-green-500 text-white font-semibold py-2 rounded-md hover:bg-green-600 transition duration-300">
                S'inscrire
            </button>
            <a href="http://localhost/gestion/login.php" class="text-green-500 text-center font-bold block">Login</a>
        </form>
    </div>
</body>

</html>
