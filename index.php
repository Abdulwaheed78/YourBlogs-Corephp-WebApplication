<?php include 'conn.php';
include('functions.php');
include("includes/nav3.php");

if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$post_per_page = 5;
$result = ($page - 1) * $post_per_page;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <title>HOME</title>
</head>

<body style="background-color: aliceblue;">
  <!--code for   blog post in showing first latest page-->
  <?php
  $query = mysqli_query($con, "SELECT * FROM post ORDER BY id desc LIMIT 1");
  $data = mysqli_fetch_assoc($query);
  $laest_post_id = $data['id'];;
  ?>

  <div class="row">
    <div class="col-sm-6">

      <div>
        <div class="card mt-3 " style="margin-left: 20px;">
          <div class="card-header">
            <h3 class="card-title  text-center text-danger">Latest BLog Page</3>
          </div>
          <div class="card-body ">
            <h2 class="card-title"><?php echo $data['title'] ?></h2>
            <span class="badge bg-primary ">Posted
              on<?= date('F j Y', strtotime($data['created_at']))  ?></span>
            <span class="badge bg-danger"><?php echo getcategory($con, $data['category_id']) ?></span>
            <div class="border-bottom mt-3">
            </div>

            <?php
            $post_images = (getimagesbyid($con, $data['id']));
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
                    <img src="images/<?= $image['image'] ?>" class="d-block w-100" height="500px" alt="Not">
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
              $post_id = $data['id'];
              $id = $_POST['post_id'];
              $name = $_POST['name'];
              $email = $_POST['email'];
              $comment = $_POST['comment'];
              $sql = mysqli_query($con, "INSERT INTO comments (email,name,comment,post_id) VALUES('$email' ,'$name', '$comment',$post_id)");
            }   ?>
            <p class="card-text"><?php echo $data['content'];  ?></p>
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
      </div>
      <div class="row mt-3" style="margin-left:12px;">

        <h1>Comments Table</h1>

        <table class="table-borderless" style="border: none; ">
          <?php
          $post_id = $data['id'];
          $id = $post_id;
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



    <!--this is side bar for all data showing in side page -->
    <div class="col-sm-6">

      <div class="container m-auto mt-3 row">
        <div class="col-12">
          <?php
          if (isset($_GET['search'])) {
            $keyword = $_GET['search'];
            $res = mysqli_query($con, "SELECT * FROM  post WHERE title LIKE '%$keyword%' ORDER BY id DESC LIMIT $result,$post_per_page");
          } else {
            $res = mysqli_query($con, "SELECT * FROM  post ORDER BY id DESC LIMIT $result,$post_per_page");
          }
          while ($row = mysqli_fetch_assoc($res)) { ?>
            <div class="card mb-3" style="max-width: 900px; ">
              <a href="post.php?id=<?php echo $row['id']; ?> " style="text-decoration:none;color:black">
                <div class="row g-0">

                  <div class="col-md-5" >
                    <img src="./images/<?php echo $row['image'];?>" height="200px" width="380px" alt="not found">
                  </div>

                  <div class="col-md-7" style="max-height:200px; min-height:200px; ">
                    <div class="card-body">
                      <div class=row>
                        <div class="col-9">
                          <h3 class="card-title "><?php echo $row['title'] ?></h3>
                        </div>
                        <div class="col-3">
                          <p class="card-text"><small class="text-muted"><?= date('F j Y', strtotime($row['created_at']))  ?></small></p>
                        </div>
                      </div>

                      <div>
                      </div>
                    </div>
                  </div>
                </div>
            </div><?php   } ?>
          </a>
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
            <ul class="pagination justify-content-center">
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

    </div>
  </div>




  <!--This code for footer included in this section -->

  <body>
    <div class="col-12 mt-5">
      <?php include "includes/footer.php"; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>

</html>