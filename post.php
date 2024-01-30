<?php include "default.php"; ?>

<style>
    body {
        background-color: #F6F9FF;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
    }

    .post {
        margin-left: 220px;
        margin-right: 220px;
    }
</style>
<style>
    .h5,
    h5 {
        font-size: 25px;
    }

    h6 {
        font-size: 18;
    }

    .card-body {
        margin-top: 100px;
    }

    .abdul {
        padding-left: 25px;
    }


    /* Media query for mobile devices */
    @media only screen and (max-width: 767px) {

        .h5,
        h5 {
            font-size: 16px;
        }

        h6 {
            font-size: 14px;
        }

        p {
            font-size: 12px;
        }

        .abdul {
            padding-left: 0px;
        }

        .card-body {
            padding: 0rem 0rem;
        }

        .post {
            margin-left: 20px;
            margin-right: 20px;
        }
    }

    /* Your existing styles here */

    /* Media query for desktop */
    @media only screen and (min-width: 1000px) {
        /* Add styles for desktop here */

        /* Limit the height of related post images */
        .img-fluid {
            max-height: 196px;
            object-fit: cover;
            /* Maintain aspect ratio */
        }
    }

    /* Media query for tablets */
    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .container {
            width: 100%;
        }

        .card-body {
            margin-top: 70px;
        }

        .abdul {
            padding-left: 25px;
        }

        .card-body {
            padding: 0rem 0rem;
        }

        .post {
            margin-left: 70px;
            margin-right: 70px;
        }

        /* Add more styles as needed to make the content full-width on tablets */
    }

    /* Media query for desktop */
    @media only screen and (min-width: 1000px) {
        /* Add styles for desktop here */

        /* Limit the height of related post images */
        .img-fluid {
            max-height: 196px;
            object-fit: cover;
            /* Maintain aspect ratio */
        }
    }
</style>

<div id="postcon" class="post mt-5">
    <div class=" mt-5">
        <div class="">
            <?php
            $id = $_GET['id'];
            $res = mysqli_query($con, "SELECT * FROM post WHERE id=$id");
            $row = mysqli_fetch_assoc($res);
            ?>
            <div class=" m-auto mt-3 post-content">
                <div class="col-12">
                    <div class=" mb-3 mt-5">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title'] ?></h5>
                            <span class="badge bg-primary ">Posted on<?= date('F j Y', strtotime($row['created_at'])) ?></span>
                            <span class="badge bg-danger"><?php echo getcategory($con, $row['category_id']) ?></span>

                            <div class="border-bottom mt-3"></div>

                            <?php
                            $post_images = (getimagesbyid($con, $row['id']));
                            ?>

                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $c = 1;
                                    foreach ($post_images as $image) {
                                        if ($c > 1) {
                                            $sw = "";
                                        } else {
                                            $sw = "active";
                                        } ?>
                                        <div class="carousel-item <?= $sw ?>">
                                            <img src="images/<?= $image['image'] ?>" class="d-block w-100" style="max-height:600px;  object-fit: cover;" alt="...">
                                        </div>
                                    <?php
                                        $c++;
                                    }
                                    ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>


                            <?php if (isset($_POST['submit'])) {
                                $post_id = $_GET['id'];
                                $id = $_POST['post_id'];
                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                $comment = $_POST['comment'];
                                $sql = mysqli_query($con, "INSERT INTO comments (email,name,comment,post_id) VALUES('$email' ,'$name', '$comment',$post_id)");
                                unset($_POST);
                            } ?>
                            <p class="card-text"><?php echo $row['content']; ?></p>
                            <div class="addthis_inline_share_toolbox"></div>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Comment Here
                            </button>
                            <button class="btn btn-outline-primary" onclick="showShareOptions()">Share</button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Comment Here </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <div class="mb-3">
                                                    <input type="hidden" name="post_id">
                                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Name</label>
                                                    <input type="text" name="name" class="form-control" id="exampleInputPassword1" required>
                                                </div>
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Leave a comment here" name="comment" id="commentInput" style="height: 100px"></textarea>
                                                    <small class="text-muted" id="wordCount">50 words</small>
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-outline-primary mt-4">Submit Comment</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <h5>Related Posts</h5>
                        <hr>
                        <?php
                        $pquery = "SELECT * FROM post WHERE category_id={$row['category_id']} ORDER BY  id DESC";
                        $res = mysqli_query($con, $pquery);
                        while ($rpost = mysqli_fetch_assoc($res)) {
                            if ($rpost['id'] == $id) {
                                continue;
                            } ?>
                            <div class="mb-3">
                                <a href="post.php?id=<?php echo $rpost['id']; ?>" style="text-decoration:none; color:black;">
                                    <div class="row g-0">
                                        <div class="col-md-5 mb-3 mb-md-0">
                                            <img src="./images/<?php echo $rpost['image']; ?>" class="img-fluid w-100" height="150px" alt="not found">
                                        </div>
                                        <div class="abdul col-md-7 mt-md-0 mt-3"> <!-- Add mt-md-0 for medium devices and mt-3 for small devices -->
                                            <div>
                                                <div>
                                                    <h6 class="card-title text-primary"><?php echo $rpost['title'] ?></h6>
                                                </div>
                                                <div class="me-3">
                                                    <p class="card-text"><small class="text-muted"><?= date('F j Y', strtotime($rpost['created_at'])) ?></small></p>
                                                </div>
                                                <div style="max-height: 8.5rem; overflow: hidden;">
                                                    <p>
                                                        <?php
                                                        $contentLines = explode("\n", $rpost['content']);
                                                        $firstTwoLines = implode("\n", array_slice($contentLines, 0, 2));
                                                        echo nl2br($firstTwoLines);
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </a>
                            </div>


                        <?php   } ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="card mt-5">
            <h5 class="card-header bg-dark text-white text-center mb-0">User Comments</h5>
            <div class="card-body mt-0" style="max-height: 300px; overflow-y: auto;">
                <?php
                $id = $_GET['id'];
                $query = mysqli_query($con, "SELECT * FROM comments WHERE post_id=$id ORDER BY id DESC");
                while ($cs = mysqli_fetch_assoc($query)) {
                ?>
                    <div class="body border-bottom mb-3 p-3 shadow">
                        <div class="d-flex align-items-start gap-3">
                            <!-- Circular user image -->
                            <div class="rounded-circle user-image" style="width: 50px; height: 50px; overflow: hidden; background-color: #ddd;">
                                <!-- You can use an actual user image if you have one -->
                                <img src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt="User Image" class="w-100 h-100">
                            </div>

                            <div class="ml-3">
                                <div class="justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title mb-0"><?php echo $cs['name']; ?> </h5>
                                    </div>
                                    <div class="ms-auto">
                                        <small class="text-danger"><?php echo date('M j, Y', strtotime($cs['created_at'])); ?></small>
                                    </div>
                                </div>
                                <p class="card-text" style="color: #555;"><?php echo $cs['comment']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>
</div>

<!--This code for footer included in this section -->
<div class="mt-5 text-danger">
    <?php include "includes/footer.php"; ?>
</div>