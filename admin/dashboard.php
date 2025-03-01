<?php
require __DIR__ . '/../layout/header.php';
?>
<div class="bg-gray-100 py-8">
<div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-5xl m-auto">
    <a href="http://localhost/gestion/admin/employe.php" class="p-8 w-full bg-green-500 text-white font-semibold py-2 rounded-md hover:bg-green-600 transition duration-300">
        ajouter un emloye</a>

        <table class=" mt-8 min-w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left font-semibold">ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Email</th>
                    <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Phone</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white">
                    <td class="border border-gray-300 px-4 py-2">1</td>
                    <td class="border border-gray-300 px-4 py-2">John Doe</td>
                    <td class="border border-gray-300 px-4 py-2">johndoe@example.com</td>
                    <td class="border border-gray-300 px-4 py-2">123-456-7890</td>
                </tr>
            </tbody>
        </table>
</div>
</div>
<?php
require __DIR__ . '/../layout/footer.php';

?>
