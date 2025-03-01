<?php
require __DIR__ . '/../layout/header.php';

if (!isset($_SESSION['admin'])) {
    header("Location: http://localhost/gestion/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: http://localhost/gestion/admin/dashboard.php");
    exit;
}

require __DIR__ . '/../connect.php'; // Database connection
require __DIR__ . '/../model/Employe.php';
require __DIR__ . '/../db/emloyees.php';

$idemploye = $_GET['id'];
$db = new ManageEmploye();
$resultat = $db->findEmploye($idemploye);
$row = $resultat->fetch_assoc();

if (!$row) {
    $_SESSION['error'] = "Employé introuvable.";
    header("Location: http://localhost/gestion/admin/dashboard.php");
}

// Pre-fill fields with existing data
$email = $row['email'];
$nom = $row['nom'];
$prenom = $row['prenom'];
$adresse = $row['adresse'];
$tel = $row['tel'];

$errors = [];
$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $email = trim($_POST["email"] ?? '');
    $nom = trim($_POST["nom"] ?? '');
    $prenom = trim($_POST["prenom"] ?? '');
    $adresse = trim($_POST["adresse"] ?? '');
    $tel = trim($_POST["tel"] ?? '');

    // Validate fields
    if (empty($email)) {
        $errors["email"] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Format d'email invalide.";
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

    // If no errors, proceed with update
    if (empty($errors)) {
        $employe = new Employe();
        $employe->setId($idemploye);
        $employe->setEmail($email);
        $employe->setNom($nom);
        $employe->setPrenom($prenom);
        $employe->setAdresse($adresse);
        $employe->setTel($tel);

        if ($db->updateEmploye($employe)) {
            $_SESSION['success'] = "Employé mis à jour avec succès.";
            header("Location: http://localhost/gestion/admin/dashboard.php");
        } else {
            $errors["general"] = "Erreur lors de la mise à jour.";
        }
    }
}
?>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-md m-auto">
    <?php if (!empty($message)): ?>
        <div class="bg-green-500 text-white p-3 rounded text-center"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if (!empty($errors['general'])): ?>
        <div class="bg-red-500 text-white p-3 rounded text-center"><?= htmlspecialchars($errors['general']) ?></div>
    <?php endif; ?>

    <h2 class="text-green-500 text-center text-2xl font-bold mb-4">Modifier Employé</h2>
    <form action="" method="post" class="space-y-4">
        <div>
            <label class="block text-gray-700 text-lg font-semibold mb-1" for="nom">Nom</label>
            <input class="w-full border rounded-md px-4 py-2" value="<?= htmlspecialchars($nom) ?>" type="text" id="nom" name="nom" />
            <div class="text-red-400"><?= $errors['nom'] ?? '' ?></div>
        </div>

        <div>
            <label class="block text-gray-700 text-lg font-semibold mb-1" for="prenom">Prénom</label>
            <input class="w-full border rounded-md px-4 py-2" value="<?= htmlspecialchars($prenom) ?>" type="text" id="prenom" name="prenom" />
            <div class="text-red-400"><?= $errors['prenom'] ?? '' ?></div>
        </div>

        <div>
            <label class="block text-gray-700 text-lg font-semibold mb-1" for="adresse">Adresse</label>
            <input class="w-full border rounded-md px-4 py-2" value="<?= htmlspecialchars($adresse) ?>" type="text" id="adresse" name="adresse" />
            <div class="text-red-400"><?= $errors['adresse'] ?? '' ?></div>
        </div>

        <div>
            <label class="block text-gray-700 text-lg font-semibold mb-1" for="tel">Téléphone</label>
            <input class="w-full border rounded-md px-4 py-2" value="<?= htmlspecialchars($tel) ?>" type="tel" id="tel" name="tel" />
            <div class="text-red-400"><?= $errors['tel'] ?? '' ?></div>
        </div>

        <div>
            <label class="block text-gray-700 text-lg font-semibold mb-1" for="email">Email</label>
            <input class="w-full border rounded-md px-4 py-2" value="<?= htmlspecialchars($email) ?>" type="email" id="email" name="email" />
            <div class="text-red-400"><?= $errors['email'] ?? '' ?></div>
        </div>


        <button type="submit" class="w-full bg-green-500 text-white font-semibold py-2 rounded-md hover:bg-green-600">
            Mettre à jour
        </button>
    </form>
</div>
</body>

<?php require __DIR__ . '/../layout/footer.php'; ?>
