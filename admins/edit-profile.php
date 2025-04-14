<?php include "../config.php";

session_start();
if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
;

$admin = $conn->query("SELECT * FROM admins WHERE id = " . $_SESSION['admin_id'])->fetch_assoc();


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE admins SET name = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $description, $_SESSION['admin_id']);
    if($stmt->execute()) {
        header("Location: profile.php?success=Profile updated successfully");
        exit();
    }else{
        header("Location: profile.php?error=Something went wrong");
        exit();
    }
}

?>
<?php include "../includes/header.php"; ?>

<script>
    document.title = "Edit Post || Ariful Islam";
</script>
<!-- Navigation   -->
<?php include "navigation.php"; ?>

<!-- Sidebar   -->
<?php include "./sidebar.php"; ?>

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class=" bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Post header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Profile: Id No- <?= $_GET['id']; ?>
                </h3>

            </div>
            <!-- row body -->
            <div class="p-4 md:p-5 space-y-4">

                <form method="post" >
                    <div class="my-3">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fullname of Admin</label>
                        <input type="title" name="name" id="title" value="<?= $admin['name']; ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="React is a open source javaScript Library" required="">
                    </div>
                    <div class="my-3">

                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">About Admin</label>
                        <textarea id="content" rows="4" name="description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."><?= $admin['description']; ?></textarea>

                    </div>
                    
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>