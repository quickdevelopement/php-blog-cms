<?php 
session_start();
include 'config.php';



$result = $conn->query("SELECT * FROM posts ORDER BY updated_at DESC");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $serach = $_POST['search'];
    $result = $conn->query("SELECT * FROM posts WHERE title LIKE '%$serach%' ORDER BY updated_at DESC");
};


?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/alert.php'; ?>
<script>
    document.title = "Home || Blog CMS";
</script>

  <!-- section post  -->
  <section>
        <div class="container mx-auto">
            <div class="p-4 ">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <a href="post.php?id=<?= $row["id"] ?>"
                                class="flex mb-4 p-4 flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row  hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <img class="object-cover w-full rounded-t-lg h-40  md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                    src="./uploads/<?= $row["image"] ?>"
                                    alt="">
                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= $row["title"] ?></h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?= substr($row["content"], 0, 100) ?></p>
                                </div>
                            </a>

                            <?php
                        }
                    }else{
                        ?>

                        <div class="text-center text-2xl font-bold">No post found</div>
                        <?php
                    }
                    ?>

                </div>
            </div>
    </section>


<?php include 'includes/footer.php'; ?>