<?php

use function PHPSTORM_META\type;

require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../db/emloyees.php';

$db=new ManageEmploye();
$result=$db->getEmployes();




?>
<div class="bg-gray-100 py-8">
<div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-5xl m-auto">
    <a href="http://localhost/gestion/admin/createEmploye.php" class="p-8 w-full bg-green-500 text-white font-semibold py-2 rounded-md hover:bg-green-600 transition duration-300">
        ajouter un emloye </a>

        <table class=" mt-8 min-w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Nom</th>
                    <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Prenom</th>
                    <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Email</th>
                    <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Phone</th>
                    <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Adresse</th>
                    <th colspan="2" class="border border-gray-300 px-4 py-2 text-left font-semibold">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row=$result->fetch_assoc()){  ?>
                <tr class="bg-white">
                    <td class="border border-gray-300 px-4 py-2"><?= $row["nom"] ?? 'NULL' ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= $row["prenom"] ?? 'NULL' ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= $row["email"] ?? 'NULL' ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= $row["tel"] ?? 'NULL' ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= $row["adresse"] ?? 'NULL' ?></td>
                    <td class="border border-gray-300 px-4 py-2"><a href="http://localhost/gestion/admin/updateEmploye.php?id=<?=$row['id']?>" class="bg-blue-500 text-white font-semibold py-2 rounded-md hover:bg-blue-600 transition duration-300 px-5">modifier</a></td>
                    <td class="border border-gray-300 px-4 py-2"><a href="http://localhost/gestion/admin/deleteEmploye.php?id=<?=$row['id']?>" class="bg-red-500 text-white font-semibold py-2 rounded-md hover:bg-red-600 transition duration-300 px-5">supprimer</a></td>
                </tr>
                <?php } ?>
                </tr>
            </tbody>
        </table>
</div>
</div>
<?php
require __DIR__ . '/../layout/footer.php';

?>
