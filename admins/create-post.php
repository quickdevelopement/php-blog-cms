<?php
session_start();
include "../config.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
;

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['admin_id'];

    // Image Upload
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $imgName = "posts-".time() ."-" . $image;
    $image_path = "../uploads/" . $imgName;

    if(!move_uploaded_file($image_tmp, $image_path)) {
        header("Location: create-post.php?error=Failed to upload image");
        exit();
    };

    $stmt = $conn->prepare("INSERT INTO posts (title, content, image, user_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $content, $imgName, $user_id);
    if($stmt->execute()) {
        header("Location: posts.php?success=Post created successfully");
        exit();
    };
}


?>
<?php include "../includes/header.php"; ?>

<script>
    document.title = "Posts || Blog CMS";
</script>

<?php include "./navigation.php"; ?>
<?php include "../includes/alert.php"; ?>

<?php include "./sidebar.php"; ?>

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class=" bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Post header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create a new post
                </h3>

            </div>
            <!-- Post body -->
            <div class="p-4 md:p-5 space-y-4">


                <form method="POST" enctype="multipart/form-data">
                    <div class="my-3">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            Post Title</label>
                        <input type="title" name="title" id="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="React is a open source javaScript Library" required="">
                    </div>
                    <div class="my-3">

                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post
                            Details</label>
                        <textarea id="content" rows="4" name="content"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."></textarea>

                    </div>
                    <div class="my-3 ">

                        <label class="text-base text-slate-900 font-medium mb-3 block">Upload file</label>

                        <input type="file" name="image" id="image"
                            class="w-full text-gray-900 border-gray-300 font-medium text-sm bg-gray-100 border file:cursor-pointer cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-black file:hover:bg-gray-200 file:text-white rounded" />
                        <p class="text-xs text-slate-500 mt-2">PNG, JPG SVG, WEBP, and GIF are Allowed.</p>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>



<?php include "../includes/footer.php"; ?>