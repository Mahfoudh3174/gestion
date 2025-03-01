<?php
session_start();

require 'model/Enfant.php';
require 'db/enfants.php';
$user = $password = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Récupération et nettoyage des données
  $user = trim($_POST["user"]);
  $password = trim($_POST["password"]);

  // Validation des champs
  if (empty($user)) {
    $errors["user"] = "email ou telephone est requis.";
  }
  if (empty($password)) {
    $errors["password"] = "Le mot de passe est requis.";
  }

  if (empty($errors)) {
    $db = new ManageEnfant();
    $enfant = new Enfant();
    $enfant->setEmail($user);
    $enfant->setTel($user);
    $enfant->setPassword($password);
    if ($db->isExiste($enfant)) {
      $_SESSION['user'] = $user;
      header("Location: http://localhost/gestion/index.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
  </head>
  <body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-md">
      <h2 class="text-green-500 text-center text-2xl font-bold mb-4">Login</h2>
      <form action="" method="post" class="space-y-4">
        <div>
          <label class="block text-gray-700 text-lg font-semibold mb-1" for="email">Email ou Telephone</label>
          <input class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" type="text" id="email" name="user" required />
        </div>
        <div>
          <label class="block text-gray-700 text-lg font-semibold mb-1" for="password">Password</label>
          <input class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" type="password" id="password" name="password" required />
        </div>
        <button type="submit" class="w-full bg-green-500 text-white font-semibold py-2 rounded-md hover:bg-green-600 transition duration-300">
          Se connecter
        </button>
        <a href="http://localhost/gestion/signup.php" class="text-green-500 text-center font-bold block">signup</a>

      </form>
    </div>
  </body>
</html>
