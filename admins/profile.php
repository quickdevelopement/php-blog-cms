<?php
session_start();
include "../config.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
;

$admin = $conn->query("SELECT * FROM admins WHERE id = " . $_SESSION['admin_id'])->fetch_assoc();

?>
<?php include "../includes/header.php"; ?>

<script>
    document.title = "Profile || Blog CMS";
</script>

<?php include "./navigation.php"; ?>
<?php include "../includes/alert.php"; ?>

<?php include "./sidebar.php"; ?>

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="flex gap-10 mb-4">

            <div
                class="flex relative w-40 h-40 items-center border border-ridge border-green-200   justify-center  mb-4 rounded-sm bg-gray-50 dark:bg-gray-800">
                <?php if ($admin["avatar"] == null): ?>
                    <img src="https://ui-avatars.com/api/?name=<?= $admin["name"] ?>" class="w-full h-full rounded-md">
                <?php else: ?>
                    <img src="<?= "../uploads/" . $admin["avatar"] ?>" class="w-full h-full  rounded">
                <?php endif; ?><br>
                <!-- Upload Image  -->
                <button id="upload-image"
                    class="cursor-pointer absolute bottom-0 right-0 opacity-50 hover:opacity-100 duration-500">
                    <svg class="w-10 h-10 text-red-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                    </svg>
                </button>
                <?php include "./profile-picture.php"; ?>
            </div>
            <div class="flex flex-col items-start justify-start h-24 rounded-sm bg-gray-50 dark:bg-gray-800">
                <h2 class="text-2xl text-bold mb-5 text-gray-900 dark:text-gray-500">
                    Name: <?= $admin["name"]; ?>
                </h2>
                <h2 class="text-2xl text-gray-900 dark:text-gray-500">
                    Email: <?= $admin["email"]; ?>
                </h2>
                <h2 class="text-2xl text-gray-900 dark:text-gray-500">
                    Role: <?= $admin["role"]; ?>
                </h2>


            </div>

        </div>
        <div class="flex  relative  justify-start  mb-4 rounded-sm bg-gray-50 dark:bg-gray-800">

            <div class="text-2xl text-gray-400 dark:text-gray-500">
                <h2 class="text-lg text-gray-900 dark:text-gray-500">
                    <?= $admin["description"]; ?>
                </h2>
            </div>

            <a href="./edit-profile.php?id=<?= $admin["id"]; ?>"
                class="font-medium absolute opacity-50 hover:opacity-100 duration-500 right-0 top-0 text-blue-600 dark:text-blue-500 hover:underline">
                <svg class="w-12 h-12 text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>

            </a>
        </div>
    </div>
</div>




<?php include "../includes/footer.php"; ?>