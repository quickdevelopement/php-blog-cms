<?php 
    include 'config.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // user Exists
        $exitst = $conn->query("SELECT * FROM admins WHERE email = '$email'");
        if($exitst->num_rows > 0) {
            header("Location: register.php?error=Email already exists");
            exit();
        };

        // Permission
        $role = "user";
        $permission = $conn->query("SELECT * FROM admins");
        if($permission->num_rows == 0) {
            $role = "admin";
            $stmt = $conn->prepare("INSERT INTO admins (name, email, password, role) VALUES (?, ?, ?, ?)"); 
            $stmt->bind_param("ssss", $name, $email, $password, $role);
            if($stmt->execute()) {
                header("Location: login.php?success=Account created successfully");
                exit();
            }else{
                header("Location: register.php?error=Something went wrong");
                exit();
            }
        }else {
            header("Location: contact.php?error=Permission Denied! Please contact admin");
            exit();
        }
    }
?>

<?php include 'includes/header.php'; ?>

<?php include "includes/alert.php"; ?>
<script>
        document.title = "Register Now || Blog CMS";
    </script>

<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-bold text-gray-900 dark:text-white">
            <img class="w-8 h-8 mr-2" src="./uploads/logo.png" alt="logo">
            Quick Development
        </a>
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Register now as an admin
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
                    <button type="submit"
                        class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Sign
                        up</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        have an already account? <a href="login.php"
                            class="font-medium text-green-600 hover:underline dark:text-green-500">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>