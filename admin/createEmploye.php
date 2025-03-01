<?php
require __DIR__ . '/../connect.php'; // Database connection
require __DIR__ . '/../model/Employe.php';
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../db/emloyees.php';

$email = $password = $nom = $prenom = $adresse = $tel = '';
$errors = [];
$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et nettoyage des données
    $email = trim($_POST["email"] ?? '');
    $password = trim($_POST["password"] ?? '');
    $nom = trim($_POST["nom"] ?? '');
    $prenom = trim($_POST["prenom"] ?? '');
    $adresse = trim($_POST["adresse"] ?? '');
    $tel = trim($_POST["tel"] ?? '');

    // Validation des champs
    if (empty($email)) {
        $errors["email"] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Format d'email invalide.";
    }
    
    if (empty($password)) {
        $errors["password"] = "Le mot de passe est requis.";
    } elseif (strlen($password) < 6) {
        $errors["password"] = "Le mot de passe doit contenir au moins 6 caractères.";
    }

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
        $employe = new Employe();
        $employe->setEmail($email);
        $employe->setPassword(password_hash($password, PASSWORD_DEFAULT)); // Hash password
        $employe->setNom($nom);
        $employe->setPrenom($prenom);
        $employe->setAdresse($adresse);
        $employe->setTel($tel);

        $db = new ManageEmploye();
        if ($db->isExiste($employe)) {
            $errors["email"] = "Email déjà existant.";
        } else {
            if ($db->addEmploye($employe)) {
                $message = "Employé ajouté avec succès.";
            } else {
                $errors["general"] = "Une erreur s'est produite lors de l'inscription.";
            }
        }
    }
}
?>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-md m-auto ">
    <?php if (!empty($message)): ?>
        <div class="text-green-500 p-2 text-center"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
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

        <div>
            <label class="block text-gray-700 text-lg font-semibold mb-1" for="password">Mot de passe</label>
            <input class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" 
                   type="password" id="password" name="password" />
            <div class="text-red-400 p-1 w-full"><?= $errors['password'] ?? '' ?></div>
        </div>

        <button type="submit" class="w-full bg-green-500 text-white font-semibold py-2 rounded-md hover:bg-green-600 transition duration-300">
            S'inscrire
        </button>
        <a href="http://localhost/gestion/login.php" class="text-green-500 text-center font-bold block">Login</a>
    </form>
</div>
</body>

<?php
require __DIR__ . '/../layout/footer.php';
?>
