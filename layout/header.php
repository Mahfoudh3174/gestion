<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">

    
        <!-- Make navbar sticky at the top -->
        <nav class="bg-white p-4 sticky top-0 left-0 right-0 z-50 shadow-md">
            <a href="http://localhost/gestion/admin/dashboard.php" class="text-2xl font-bold">Gestion</a>
            <ul class="flex ml-auto ">
                <li class="mr-4"><a href="http://localhost/gestion/admin/dashboard.php" class="hover:text-gray-300">Accueil</a></li>
                <li class="mr-4"><a href="http://localhost/gestion/admin/enfants/enfants.php" class="hover:text-gray-300">Enfants</a></li>
                <li class="mr-4"><a href="http://localhost/gestion/logout.php" class="hover:text-gray-300">Logout</a></li>
            </ul>
        </nav>
    

    <?php
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: http://localhost/gestion/login.php");
        }
    ?>

    <!-- Your page content -->
    <div class="mb-4">
        
    </div>

</body>
</html>
