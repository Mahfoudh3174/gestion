<?php
require __DIR__ . '/../../layout/header.php';
if(!isset($_SESSION['admin']))
{header("Location: http://localhost/gestion/login.php");
    exit;
}
require __DIR__ . '/../../connect.php'; // Database connection
require __DIR__ . '/../../model/Employe.php';
require __DIR__ . '/../../db/enfants.php';

$email = $password = $nom = $prenom = $adresse = $tel = '';
$errors = [];
$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et nettoyage des données

    $nom = trim($_POST["nom"] );
    $prenom = trim($_POST["prenom"] );
    $adresse = trim($_POST["adresse"] );
    $tel = trim($_POST["tel"] );

    // Validation des champs
    

    if (empty($nom)) {
        $errors["nom"] = "Le nom est requis.";
    }
    if (empty($prenom)) {
        $errors["prenom"] = "Le prénom est requis.";
    }
    if (empty($adresse)) {
        $errors["adresse"] = "L'adresse est requise.";
    }
    if (empty($tel)) {
        $errors["tel"] = "Le téléphone est requis.";
    }

    if (empty($errors)) {
        $enfant = new Enfant();
        $enfant->setNom($nom);
        $enfant->setPrenom($prenom);
        $enfant->setAdresse($adresse);
        $enfant->setTel($tel);

        $db = new ManageEnfant();
        if ($db->isExiste($enfant)) {
            $_SESSION['error'] = "Enfant déjà existant.";
        } else {
            $db->ajouterEnfant($enfant);
            $_SESSION['success'] = "Enfant ajouté avec succès.";
            header("Location: http://localhost/gestion/admin/dashboard.php");
            
        }
    }
}
?>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-md m-auto ">
    <?php if (!empty($message)): ?>
        <div class="text-green-500 p-2 text-center"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php
    if(isset($_SESSION['success'])){?>
    <span class="text-green-500 p-2 text-center"><?= $_SESSION['success'] ?></span>
    <?php unset($_SESSION['success']);
    }elseif(isset($_SESSION['error'])){?>
    <span class="text-red-500 p-2 text-center"><?= $_SESSION['error'] ?></span>
    <?php unset($_SESSION['error']);
    }
     ?>

    <span class="text-red-400 p-1 w-full"><?= $errors['general'] ?? '' ?></span>
    
    <h2 class="text-green-500 text-center text-2xl font-bold mb-4">Ajouter Employé</h2>
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

        <div>
            <label class="block text-gray-700 text-lg font-semibold mb-1" for="email">Email</label>
            <input class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" 
                   value="<?= htmlspecialchars($email) ?>" type="email" id="email" name="email" />
            <div class="text-red-400 p-1 w-full"><?= $errors['email'] ?? '' ?></div>
        </div>

        <button type="submit" class="w-full bg-green-500 text-white font-semibold py-2 rounded-md hover:bg-green-600 transition duration-300">
            Enregistrer
        </button>
    </form>
</div>
</body>

<?php
require __DIR__ . '/../layout/footer.php';
?>
