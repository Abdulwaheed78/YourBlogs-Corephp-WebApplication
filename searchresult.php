<?php include 'admin/conn.php';
include('functions.php');
include("includes/nav3.php");

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$post_per_page = 5;
$result = ($page - 1) * $post_per_page;

#code for   blog post in showing the first latest page
$query = mysqli_query($con, "SELECT * FROM post ORDER BY id desc LIMIT 1");
$data = mysqli_fetch_assoc($query);
$laest_post_id = $data['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>HOME</title>
</head>

<body style="background-color:#F6F9FF;">
    <div class="container mt-5">

        <!-- this is the row for showing the comments and related posts-->
        <div class="container col-md-8" style="margin-top:100px;">
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
                        <a href="post.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:black">
                            <div class="row">
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
                                <div class="col-md-5 order-md-1 mt-3">
                                    <!-- Display the image with specified height and width -->
                                    <img src="./images/<?php echo $row['image']; ?>" class="img-fluid w-100" height="120px" alt="not found">
                                </div>
                            </div>
                        </a>
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
                    ?>
                    <li class="page-item <?= $switch ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>

                    <?php
                    for ($opage = 1; $opage <= $ntotal_pages; $opage++) { ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $opage ?>"><?= $opage  ?></a>
                        </li>
                    <?php } ?>

                    <li class="page-item <?= $nswitch ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>


    </div>
    <!--This code for footer included in this section -->
    <div class="mt-5 text-danger">
        <?php include "includes/footer.php"; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>