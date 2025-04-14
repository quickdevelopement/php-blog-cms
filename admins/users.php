<?php 
session_start();
include "../config.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
;
$admins = $conn->query("SELECT * FROM admins WHERE role = 'admin'");
$users = $conn->query("SELECT * FROM admins WHERE role = 'user'");   

?>
<?php include "../includes/header.php"; ?>

<script>
    document.title = "Users || Blog CMS";
</script>
<?php include "../includes/alert.php"; ?>
<!-- Navigation   -->
<?php include "./navigation.php"; ?>

<!-- Sidebar   -->
<?php include "./sidebar.php"; ?>
<div class="p-4 sm:ml-64 bg-gray-200">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 my-14">
        <div class="grid grid-cols-3 gap-4 mb-10">
            <div class="flex items-center justify-center rounded-sm bg-gray-50 dark:bg-gray-800">
                <h4 class="text-md text-bold text-gray-900 dark:text-gray-100">
                    Total Admin: <strong class="text-2xl"><?= $admins->num_rows; ?></strong>
                </h4>

            </div>
            <div class="flex items-center justify-center rounded-sm bg-gray-50 dark:bg-gray-800">
                <h4 class="text-md text-bold text-gray-900 dark:text-gray-100">
                    Total User: <strong class="text-2xl"><?= $users->num_rows; ?></strong>
                </h4>


            </div>
            <div class="flex justify-center items-center">
            <a href="./create-user.php" type="button"
                        class="text-md text-bold border-dashed text-center block hover:bg-green-200  w-full h-full border-2 border-gray-700 text-gray-900 bg-gray-50 px-4 py-4 leading-normal rounded-sm dark:text-gray-100">Add
                        Author</a>
            </div>
        </div>

        <div class="grid md:grid-cols-2 grid-cols-1 gap-4 bg-gray-100 my-10">
            <div class="flex flex-col justify-center rounded-sm bg-gray-50 p-3  dark:bg-gray-800">
         
                    <h4 class="text-md text-xl text-bold text-gray-900 dark:text-gray-100">
                        Users
                    </h4>
                   


                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-3 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($user = $users->fetch_assoc()) { ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row"
                                        class="px-3 py-4 ">
                                       <?php if ($user["avatar"] == null) { ?>
                                            <img class="w-6 h-6 rounded-full  border-2 border-green-800 "
                                            src="https://ui-avatars.com/api/?name=<?= $user["name"] ?>" alt="user photo">
                                        <?php } else { ?>
                                            <img class="w-6 h-6 rounded-full border-2 border-green-800 " src="<?="../uploads/". $user["avatar"]; ?>" alt="<?= $user["name"]; ?>">
                                        <?php } ?>
                                    </th>
                                    <td class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?= $user["name"]; ?>
                                    </td>
                                    <td class="px-2 py-4">
                                        <?= $user["email"]; ?>
                                    </td>
                                    <td class="px-2 py-4 flex flex-row ">
                                    <a href="./edit-post.php?id=<?= $row["id"]; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                </svg>

                                            </a>
                                            <a href="./delete.php?id=<?= $row["id"]; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                <svg class="w-6 h-6 text-red-900 dark:text-white"
                                                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24">
                                                    <path
                                                        d="M 10.806641 2 C 10.289641 2 9.7956875 2.2043125 9.4296875 2.5703125 L 9 3 L 4 3 A 1.0001 1.0001 0 1 0 4 5 L 20 5 A 1.0001 1.0001 0 1 0 20 3 L 15 3 L 14.570312 2.5703125 C 14.205312 2.2043125 13.710359 2 13.193359 2 L 10.806641 2 z M 4.3652344 7 L 5.8925781 20.263672 C 6.0245781 21.253672 6.877 22 7.875 22 L 16.123047 22 C 17.121047 22 17.974422 21.254859 18.107422 20.255859 L 19.634766 7 L 4.3652344 7 z">
                                                    </path>
                                                </svg>
                                            </a>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="flex flex-col  p-3 justify-center rounded-sm bg-gray-50 dark:bg-gray-800">
                <h4 class="text-md text-xl text-bold text-gray-900 dark:text-gray-100">
                    Admins
                </h4>
                <div class="relative overflow-x-auto ">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                                <th scope="col" class="px-3 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($admin = $admins->fetch_assoc()) { ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row"
                                        class="px-3 py-4 ">
                                       <?php if ($admin["avatar"] == null) { ?>
                                            <img class="w-6 h-6 rounded-full  border-2 border-green-800 "
                                            src="https://ui-avatars.com/api/?name=<?= $admin["name"] ?>" alt="admin photo">
                                        <?php } else { ?>
                                            <img class="w-6 h-6 rounded-full border-2 border-green-800 " src="<?= "../uploads/". $admin["avatar"]; ?>" alt="<?= $admin["name"]; ?>">
                                        <?php } ?>
                                    </th>
                                    <td class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?= $admin["name"]; ?>
                                    </td>
                                    <td class="px-2 py-4">
                                        <?= $admin["email"]; ?>
                                    </td>
                                    <td class="px-2 py-4 flex flex-row">
                                    <a href="./edit-post.php?id=<?= $row["id"]; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                </svg>

                                            </a>
                                            <a href="./delete.php?id=<?= $row["id"]; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                <svg class="w-6 h-6 text-red-900 dark:text-white"
                                                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24">
                                                    <path
                                                        d="M 10.806641 2 C 10.289641 2 9.7956875 2.2043125 9.4296875 2.5703125 L 9 3 L 4 3 A 1.0001 1.0001 0 1 0 4 5 L 20 5 A 1.0001 1.0001 0 1 0 20 3 L 15 3 L 14.570312 2.5703125 C 14.205312 2.2043125 13.710359 2 13.193359 2 L 10.806641 2 z M 4.3652344 7 L 5.8925781 20.263672 C 6.0245781 21.253672 6.877 22 7.875 22 L 16.123047 22 C 17.121047 22 17.974422 21.254859 18.107422 20.255859 L 19.634766 7 L 4.3652344 7 z">
                                                    </path>
                                                </svg>
                                            </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>
</div>

<?php include "../includes/footer.php"; ?>