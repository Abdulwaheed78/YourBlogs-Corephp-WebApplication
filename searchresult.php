<?php include "default.php"; ?>



<!-- this is the row for showing the comments and related posts-->
<div class="justify-content-center col-md-12 col-lg-8 mx-auto" style="margin-top:100px;">
    <?php
    if (isset($_GET['search'])) {
        $keyword = $_GET['search'];
        $res = mysqli_query($con, "SELECT * FROM  post WHERE title LIKE '%$keyword%' ORDER BY id DESC LIMIT $result,$post_per_page");
    } else {
        $res = mysqli_query($con, "SELECT * FROM  post ORDER BY id DESC LIMIT $result,$post_per_page");
    }
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <div class="card mt-5">
                <!-- <a href="post.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:black"> -->
                    <div class="row d-flex">
                        <div class="col-md-5 order-md-1 d-flex align-items-center">
                            <!-- Display the image covering the full div -->
                            <img src="./images/<?php echo $row['image']; ?>" class="img-fluid w-100" style="object-fit: cover;" alt="not found">
                        </div>
                        <div class="col-md-7 order-md-2">
                            <div class="card-body">
                                <a href="post.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:blue;">
                                    <h4 class="card-title"><?php echo $row['title']; ?></h4>
                                </a>
                                <p class="card-text">
                                    <small class="text-muted"><?= date('F j, Y', strtotime($row['created_at'])); ?></small>
                                </p>
                                <!-- Display the first 3 lines of content -->
                                <p class="card-text"><?php echo nl2br(mb_strimwidth($row['content'], 0, 150, "...")); ?></p>
                            </div>
                        </div>
                    </div>

                <!-- </a> -->
            </div>
    <?php    }
    } else {
        echo '<div class="d-flex align-items-center justify-content-center" style="height: 80vh;">';
        echo '<h1 class="text-center">Sorry, no blogs found with the search Name ' . htmlspecialchars($keyword) . '</h1>';
        echo '</div>';
    } ?>
    <?php
    if (isset($_GET['search'])) {
        $keyword = $_GET['search'];
        $r = mysqli_query($con, "SELECT * FROM post WHERE id LIKE '%$keyword%'");
    } else {
        $r = mysqli_query($con, "SELECT * FROM post");
    }
    $total_pages = mysqli_num_rows($r);
    $ntotal_pages = ceil($total_pages / $post_per_page);
    ?>
    <nav aria-label="Page navigation example fixed-bottom">
        <ul class="pagination justify-content-center mt-5">
            <?php
            if ($page <= 1) {
                $switch = "disabled";
            } else {
                $switch = "";
            }
            if ($page >= $ntotal_pages) {
                $nswitch = "disabled";
            } else {
                $nswitch = "";
            }

            // Conditionally show "Previous" button
            if ($total_pages > 5 && $page > 1) {
            ?>
                <li class="page-item <?= $switch ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
            <?php
            }

            // Render page links
            for ($opage = 1; $opage <= $ntotal_pages; $opage++) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $opage ?>"><?= $opage ?></a>
                </li>
            <?php
            }

            // Conditionally show "Next" button
            if ($total_pages > 5 && $page < $ntotal_pages) {
            ?>
                <li class="page-item <?= $nswitch ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </nav>

</div>



<!--This code for footer included in this section -->
<div class="mt-5 text-danger">
    <?php include "includes/footer.php"; ?>
</div>