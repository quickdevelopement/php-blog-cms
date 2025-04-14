<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
};

$admin = $conn->query("SELECT * FROM admins WHERE id = " . $_SESSION['admin_id'])->fetch_assoc();
if($admin['role'] != "admin") {
    header("Location: users.php?error=Permission Denied! Please contact admin");
};


    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role= $_POST['role'];

        // user Exists
        $exitst = $conn->query("SELECT * FROM admins WHERE email = '$email'");
        if($exitst->num_rows > 0) {
            header("Location: register.php?error=Email already exists");
            exit();
        };

        // Permission
        if($admin['role'] == "admin") {
            $stmt = $conn->prepare("INSERT INTO admins (name, email, password, role) VALUES (?, ?, ?, ?)"); 
            $stmt->bind_param("ssss", $name, $email, $password, $role);
            if($stmt->execute()) {
                header("Location: posts.php?success=Account created successfully");
                exit();
            }else{
                header("Location: create-post.php?error=Something went wrong");
                exit();
            }
        }
        else {
            header("Location: ../contact.php?error=Permission Denied! Please contact admin");
            exit();
        }
    }
?>

<?php include "../includes/header.php"; ?>

<script>
    document.title = "Create User || Ariful Islam";
</script>
<!-- Navigation   -->
<?php include "./navigation.php"; ?>

<!-- Sidebar   -->
<?php include "./sidebar.php"; ?>
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0  xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Register as an Author
                </h1>
                <form class="space-y-4 md:space-y-6" method="post">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            Fullname</label>
                        <input type="name" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="John Doe" required="">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="">


                    </div>
                    <div>

                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                            option</label>
                        <select id="role" name="role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="user">User</option>
                            <option value="admin">Admin</option>

                        </select>

                    </div>
                    <button type="submit"
                        class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create</button>

                </form>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>