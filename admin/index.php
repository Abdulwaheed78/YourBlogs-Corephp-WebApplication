<?php
session_start();


if (!isset($_SESSION['userLoggedIn'])) {
  header('location:login.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Admin Panel</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Nav bar ======= -->
  <?php
  include("../conn.php");

  include("../functions.php");
  $len = getadmin($con, $_SESSION['username']);

  ?>



  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Admin Panel</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $len['name']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $len['name']; ?></h6>
              <span>Web Devloper</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End  Navigation -->

  </header><!-- End Header -->

  <!-- End Nav bar -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php?">
          <i class="bi bi-grid"></i>
          <span>Publish New Post</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?managepost">
          <i class="bi bi-dash-circle"></i>
          <span>Manage Posts</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <!-- mange image start -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?manageimage">
          <i class="bi bi-dash-circle"></i>
          <span>Manage Images</span>
        </a>
      </li>

      <!-- mange image end -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?managecategory">
          <i class="bi bi-dash-circle"></i>
          <span>Manage Category</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?managemenu">
          <i class="bi bi-dash-circle"></i>
          <span>Manage Menu</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?managesubmenu">
          <i class="bi bi-dash-circle"></i>
          <span>Manage SubMenu</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?managecomment">
          <i class="bi bi-dash-circle"></i>
          <span>Manage Comments</span>
        </a>
      </li>


      <!-- End Error 404 Page Nav -->


    </ul>

  </aside>
  <!-- End Sidebar-->



  <main id="main" class="main">


    <section class="section dashboard">
      <div class="row">
        <?php if (isset($_GET['managepost'])) { ?>
          <pre><h2>Manage Post </h2>

</pre>
          <div class="container mb-3">
            <a href="index.php?" class="btn btn-primary"> Add New Post</a>
          </div>
          <table class="table table-primary">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Post Title</th>
                <th scope="col">Thumbnail Image</th>
                <th scope="col">Content</th>
                <th scope="col">Category Id</th>
                <th scope="col">Created at</th>
                <th scope="col">Action</th>
                
              </tr>
            </thead>
            <tbody>
              <?php
              $r = mysqli_query($con, "SELECT post.id, post.title, post.content, post.created_at, category.name,post.image From post INNER JOIN category ON post.category_id=category.id ORDER BY post.id DESC ");

              while ($run = mysqli_fetch_assoc($r)) {
              ?>
                <tr>
                  <th scope="row"><?php echo $run['id']; ?></th>
                  <td><?php echo $run['title']; ?></tnot foundd>
                  <td><img src="../images/<?php echo $run['image'];?>" height="75px" width="75px" alt="not found"></td>
                  <td><?php echo $run['content']; ?></td>
                  <td><?php echo $run['name']; ?></td>
                  <td><?php echo $run['created_at']; ?></td>
                  <td><a href="../deletepost.php?delete=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-danger">Delete</button></td>

                </tr>
              <?php } ?>
            </tbody>
          </table>

        <?php } elseif (isset($_GET['manageimage'])) { ?>

          <pre><h2>Manage Image / Add Image</h2>

</pre>
          <div class="container mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="small btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Add Images
            </button>
            <?php

            if (isset($_POST['submit'])) {

              $post_id = $_POST['post_id'];
              $image_name = $_FILES['image']['name'];
              $tmpname = $_FILES['image']['tmp_name'];

              $folder = "../images/" . $image_name;

              move_uploaded_file($tmpname, $folder);

              $sub = mysqli_query($con, "INSERT INTO images (image,post_id) VALUES ('$image_name',$post_id)");
            }

            ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Image </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="index.php?manageimage" method="post" enctype="multipart/form-data">
                      <?php

                      ?>

                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"> Enter Post Name</label>
                        <input type="text" name="post_id" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Choose Image</label>
                        <input type="file" name="image" class="form-control" id="exampleInputPassword1" required multiple>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary mt-2">Post Image</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>




          </div>

          <div class="col-6">


            <table class="table table-primary">
              <thead>
                <tr>
                  
                  <th scope="col">Main Carousel Images</th>
                  <th scope="col">Post Name</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $r = mysqli_query($con, "SELECT images.id, images.image,post.title FROM images INNER JOIN post ON images.post_id=post.id");

                while ($run = mysqli_fetch_assoc($r)) {
                ?>
                  <tr>
                    
                    <td> <img src="../images/<?php echo $run['image'] ?>" class="d-block " height="50px" width="100px" alt="not found"></td>
                    <td><?php echo $run['title']; ?></td>
                    <td><a href="../deleteimage.php?delete=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-danger" name="delete">Delete</button></td>

                  </tr>
                <?php } ?>
              </tbody>
            </table>

          </div>


        <?php } elseif (isset($_GET['managecategory'])) { ?>
          <!-- manage comments section start -->

          <pre><h2>Manage Categories / Add category</h2>

  </pre>
          <div class="container mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="small btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Add category
            </button>
            <?php

            if (isset($_POST['submit'])) {
              $name = $_POST['name'];
              $sub = mysqli_query($con, "INSERT INTO category (name) VALUES ('$name')");
            }

            ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="index.php?managecategory" method="post">
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"> Enter Category Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary mt-2">Post Category</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>




          </div>

          <div class="col-6">


            <table class="table table-primary">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Category Name</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $r = mysqli_query($con, "SELECT * FROM category ORDER BY id DESC ");

                while ($run = mysqli_fetch_assoc($r)) {
                ?>
                  <tr>
                    <th scope="row"><?php echo $run['id']; ?></th>
                    <td><?php echo $run['name']; ?></td>

                    <td><a href="../deletecategory.php?delete=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-danger" name="delete">Delete</button></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>

          </div>


          <!-- Manage comments section end  -->


        <?php } elseif (isset($_GET['managemenu'])) { ?>
          <pre><h2>Manage Menu / Add Menu</h2>

  </pre>
          <div class="container mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="small btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Add New Menu
            </button>
            <?php

            if (isset($_POST['submit'])) {
              $name = mysqli_real_escape_string($con, $_POST['name']);
              $action = mysqli_real_escape_string($con, $_POST['action']);
              $sub = mysqli_query($con, "INSERT INTO menu (name,action) VALUES ('$name','$action')");
            }

            ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Menu </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="index.php?managemenu" method="post">
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"> Enter Menu Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"> Enter action Name</label>
                        <input type="text" name="action" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary mt-2">Post Menu</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-primary">

            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Menu Name</th>
                <th scope="col">Link</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $r = mysqli_query($con, "SELECT * FROM menu ORDER BY id DESC ");

              while ($run = mysqli_fetch_assoc($r)) {
              ?>
                <tr>
                  <th scope="row"><?php echo $run['id']; ?></th>
                  <td><?php echo $run['name']; ?></td>
                  <td><?php echo $run['action']; ?></td>
                  <td><a href="../deletemenu.php?delete=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-danger" name="delete">Delete</button></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>



        <?php } elseif (isset($_GET['managesubmenu'])) { ?>
          <pre><h2>Manage SubMenu / Add SubMenu</h2>

  </pre>
          <div class="container mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="small btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Add New SubMenu
            </button>
            <?php

            if (isset($_POST['submit'])) {
              $parentid = mysqli_real_escape_string($con, $_POST['parent_menu_id']);
              $name = mysqli_real_escape_string($con, $_POST['name']);
              $action = mysqli_real_escape_string($con, $_POST['action']);
              $sub = mysqli_query($con, "INSERT INTO submenu (parent_menu_id,name,action) VALUES ($parentid,'$name','$action')");
            }

            ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add SubMenu </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="index.php?managesubmenu" method="post" enctype="multipart/form-data">
            
                      <div class="mb-3">
                        <label class="form-label"> Enter SubmMenu Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label"> Enter action Name</label>
                        <input type="text" name="action" class="form-control" id="exampleInputPassword1" required>
                      </div>
                      <div class="mb-3">
                          <h6>Select Menu</h6>

                          <select class="form-select" id="inputGroupSelect01" name="parent_menu_id">

                            <?php
                            $r = mysqli_query($con, "SELECT * FROM menu ORDER BY id DESC ");
                            while ($row = mysqli_fetch_assoc($r)) { ?>
                              <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                            
                          </select>
                        </div>
                      <button type="submit" name="submit" class="btn btn-primary mt-2">Post SubMenu</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-primary">

            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col"> Parent Menu Id</th>
                <th scope="col">Menu Name</th>
                <th scope="col">Link</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $r = mysqli_query($con, "SELECT * FROM submenu ORDER BY id DESC ");

              while ($run = mysqli_fetch_assoc($r)) {
              ?>
                <tr>
                  <th scope="row"><?php echo $run['id']; ?></th>
                  <td><?php echo $run['parent_menu_id']; ?></td>
                  <td><?php echo $run['name']; ?></td>
                  <td><?php echo $run['action']; ?></td>
                  <td><a href="../deletesubmenu.php?delete=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-danger" name="delete">Delete</button></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>



        <?php } elseif (isset($_GET['managecomment'])) { ?>
          <pre><h2>Manage Comments</h2>

</pre>


          <table class="table table-primary">
            <thead>
              <tr>
                
                <th scope="col">Subscriber Name</th>
                <th scope="col">Comments</th>
                <th scope="col">Post Name</th>
                <th scope="col">Email-id</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $r = mysqli_query($con, "SELECT comments.id,comments.name,comments.comment,post.title,comments.email FROM comments INNER JOIN post ON comments.post_id=post.id ");

              while ($run = mysqli_fetch_assoc($r)) {
              ?>
                <tr>
                  
                  <td><?php echo $run['name']; ?></td>
                  <td><?php echo $run['comment']; ?></td>
                  <td><?php echo $run['title']; ?></td>
                  <td><?php echo $run['email']; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } elseif (isset($_GET['error404'])) { ?>
          <main>
            <div class="container">

              <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <h1>404</h1>
                <h2>The page you are looking for doesn't exist.</h2>
                <a class="btn" href="index.php">Back to home</a>
                <img src="assets/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">
              </section>

            </div>
          </main><!-- End #main -->

        <?php } else { ?>

          <div class="col-lg-10">
            <div class="row">

              <div>
                <form action="index2.php?" method="post" enctype="multipart/form-data">

                  <div class=" card">
                    <div class="card-header">
                      <h5 class="card-title">Write New Post Here</h5>
                    </div>
                    <div class="card-body">

                      <h6><label for="title">Title</label></h6>
                      <input type="text" class="form-control mb-2" name="title" required>
                      <h6> Content</h6>
                      <textarea name="content" id="ckditor" cols="113" rows="10">

                            </textarea>

                      <div class="row">
                        <div class="col mt-3">
                          <h6>Select Category</h6>

                          <select class="form-select" id="inputGroupSelect01" name="category_id">

                            <?php
                            $r = mysqli_query($con, "SELECT * FROM category ORDER BY id DESC ");
                            while ($row = mysqli_fetch_assoc($r)) { ?>
                              <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                            <option selected>Choose...</option>
                          </select>


                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Choose Image</label>
                        <input type="file" name="image" class="form-control" id="exampleInputPassword1" required multiple>
                      </div>



                      </div>
                      <div class="mt-3  mr-3">
                        <button type="submit" name="post" class=" btn btn-primary mt-3" value="">Publish</button>

                      </div>
                    </div>
                </form>
              </div>




            </div>
          </div>
          <!-- Left side columns -->

        <?php } ?>
      </div>

      <!-- End Left side columns -->



      </div>
    </section>
  </main><!-- End #main -->

  <?php include("footeradmin.php"); ?>

  <a href="" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  </script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

<script type="text/javascript">
  // Initialize CKEditor


  CKEDITOR.replace('content', {

    width: "970px",
    height: "200px"

  });
</script>

</html>