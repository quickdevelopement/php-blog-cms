<?php
session_start();
include 'config.php';
$isLogin = false;
if(!isset($_SESSION['admin_id'])) {
    $isLogin = true;
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
    $author = $post['user_id'];
    $authorName = $conn->query("SELECT * FROM admins WHERE id = '$author'")->fetch_assoc();
    $stmt->close();
}
?>

<?php include 'includes/header.php'; ?>
<script>
    document.title = "Post || Blog CMS";
</script>

<?php include 'includes/navbar.php'; ?>

<div class="container mx-auto ">
    <div class="flex flex-col items-center justify-center px-6 mt-20  min-h-screen">
        <!-- show image -->
        <div class="w-full md:w-3/4 bg-white p-4 rounded-sm shadow-md  ">
            <img src="./uploads/<?php echo $post['image']; ?>" alt="" class="w-full rounded-sm">
        </div>
        <div class=" text-start w-full md:w-3/4 my-4">
            <h4 class="text-md font-bold text-gray-600">
                Author of this post: <?php echo $authorName['name']; ?>
            </h4>
            <p class="text-gray-500 text-sm ">
                Created at: <?php echo $post['created_at']; ?>
            </p>
        </div>
        <div class="w-full max-w-3xl">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-2xl font-bold mb-4">
                    <?php echo $post['title']; ?>
                </h2>
                <p class="text-gray-700 text-base">
                    <?php echo $post['content']; ?>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>