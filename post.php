<?php include "conn.php";
include "functions.php";
include "includes/nav2.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <title>Blog</title>
</head>


<body style="background-color: aliceblue; text-overflow:hidden;">


  <div class="row">
    <div class="col-sm-6"><?php

                          $id = $_GET['id'];
                          $res = mysqli_query($con, "SELECT * FROM  post WHERE id=$id ");
                          $row = mysqli_fetch_assoc($res);
                          ?>
      <div class="container m-auto mt-3 row">
        <div class="col-12">
          <div class="card mb-3 mt-3">

            <div class="card-body ">
              <h2 class="card-title"><?php echo $row['title'] ?></h2>
              <span class="badge bg-primary ">Posted
                on<?= date('F j Y', strtotime($row['created_at']))  ?></span>
              <span class="badge bg-danger"><?php echo getcategory($con, $row['category_id']) ?></span>
              <div class="border-bottom mt-3">
              </div>

              <?php
              $post_images = (getimagesbyid($con, $row['id']));
              ?>

              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <?=
                  $c = 1;
                  foreach ($post_images as $image) {
                    if ($c > 1) {
                      $sw = "";
                    } else {
                      $sw = "active";
                    } ?>

                    <div class="carousel-item <?= $sw ?>">
                      <img src="images/<?= $image['image'] ?>" class="d-block w-100" alt="...">
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
              }   ?>
              <p class="card-text"><?php echo $row['content'];  ?></p>
              <!-- Go to www.addthis.com/dashboard to customize your tools -->
              <div class="addthis_inline_share_toolbox"></div>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Comment Here
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color:aquamarine;">
                      <h5 class="modal-title" id="exampleModalLabel">Comment Here </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="background-color:aliceblue;">
                      <form action="" method="post">
                        <div class="mb-3">
                          <input type="hidden" name="post_id">
                          <label for="exampleInputEmail1" class="form-label">Email address</label>
                          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Name</label>
                          <input type="text" name="name" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-floating">
                          <textarea class="form-control" placeholder="Leave a comment here" name="comment" id="floatingTextarea2" style="height: 100px"></textarea>
                          <label for="floatingTextarea2">Leave Comment Hare</label>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mt-4">Submit Comment</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>



            </div>

          </div>
          <h1>This is comment section</h1>
          <hr style="margin-right:20px">
          <table class="table-borderless" style="border: none; ">
            <?php

            $id = $_GET['id'];
            $query = mysqli_query($con, "SELECT * FROM comments WHERE post_id=$id ORDER BY id DESC");
            while ($cs = mysqli_fetch_assoc($query)) {
            ?>
              <tr class="mt-2">
                <td>
                  <h5><?php echo $cs['name']; ?></h5> (posted on<?= date('F j Y', strtotime($cs['created_at']))  ?>)
                </td>
                <td><?php echo $cs['comment']; ?></td>
              </tr>

            <?php } ?>
          </table>

        </div>
      </div>
    </div>


    <!-- this is  for   side page this is show the   related post of present post-->


    <div class="col-sm-6 mt-4">
      <div>
        <h1>This is Related Post section</h1>
        <hr style="margin-right:20px;">
        <?php
        $pquery = "SELECT * FROM post WHERE category_id={$row['category_id']} ORDER BY  id DESC";
        $res = mysqli_query($con, $pquery);
        while ($rpost = mysqli_fetch_assoc($res)) {
          if ($rpost['id'] == $id) {
            continue;
          } ?>




          <div class="card mb-3 mt-3" style="margin-right:20px;">
            <a href="post.php?id=<?php echo $rpost['id']; ?> " style="text-decoration:none; color:black;">
              <div class="row g-0">
                <div class="col-md-5">
                  <img src="./images/<?php echo $row['image']; ?>" height="200px" width="380px" alt="not found">
                </div>
                <div class="col-md-7 " style="max-height:200px; min-height:200px; ">
                  <div class="card-body">
                    <div class=row>
                      <div class="col-9">
                        <h3 class="card-title  "><?php echo $rpost['title'] ?></h3>
                      </div>
                      <div class="col-3">
                        <p class="card-text"><small class="text-muted"><?= date('F j Y', strtotime($rpost['created_at']))  ?></small></p>
                      </div>

                    </div>

                  </div>
                </div>
              </div>
          </div><?php   } ?>
        </a>
        <a href="/blog/" class="btn btn-secondary"><-- Previous Page</a>
      </div>
    </div>
  </div>


  <div class="mt-5"><?php include "includes/footer.php"; ?></div>


  </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
  </script>
  <!-- Go to www.addthis.com/dashboard to customize your tools -->
  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-62c26ab703182ef5"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>


</html>