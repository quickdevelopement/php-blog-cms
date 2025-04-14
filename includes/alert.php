<?php
    if(isset($_GET['success'])) {
        ?>
            <div id="alert" class=" z-60 absolute top-2  right-1 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded border-l-8 " role="alert">
                <span class="block sm:inline bold text-2xl"> <?php echo $_GET['success']; ?> </span>
            </div>
        <?php
    }elseif(isset($_GET['error'])) {
        ?>
            <div id="alert" class=" z-60 absolute top-2  right-1  bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded  border-l-8" role="alert">
                <span class="block sm:inline"> <?php echo $_GET['error']; ?> </span>
            </div>
        <?php
    } 
?>