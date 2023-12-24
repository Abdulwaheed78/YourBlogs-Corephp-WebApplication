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
    <!-- Summernote CSS - CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- //Summernote CSS - CDN Link -->



    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- ... your existing head content ... -->
    <script src="https://cdn.rawgit.com/ejbeaty/tableexport.v5/master/dist/js/tableexport.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
    /* Add the following style */
    #selected-files {
        display: flex;
        flex-wrap: wrap;
    }

    #drop-area {
        border: 2px dashed #4CAF50;
        border-radius: 10px;
        padding: 20px;
        width: 800px;
        text-align: center;
        font-size: 20px;
        color: #4CAF50;
        cursor: pointer;
        background-color: #f9f9f9;
    }

    .thumbnail {
        margin: 10px;
        padding: 5px;
        border: 1px solid #ccc;
        text-align: center;
        width: calc(33.333% - 20px);
        /* Adjust the width of each image to take up 33.333% of the row width, minus the margin */
        box-sizing: border-box;
        position: relative;
        /* Add this style */
    }

    .thumbnail img {
        max-width: 100px;
        max-height: 100px;
    }

    .cancel-btn {
        position: absolute;
        /* Add this style */
        top: 5px;
        /* Add this style */
        right: 5px;
        /* Add this style */
        margin-top: 5px;
        cursor: pointer;
    }
</style>

<body>

    <!-- ======= Nav bar ======= -->
    <?php
    include("conn.php");

    include("../functions.php");
    $len = getadmin($con, $_SESSION['username']);

    ?>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Admin Panel</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->



        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li>
                    <a href="#" onclick="openLink('yourblogs-corephp-webapplication.test/'); return false;">
                        <i class="bi bi-grid"></i> Visit site
                    </a>
                </li>


                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

                        <?php if (!empty($len['profileimage'])) : ?>
                            <img src="<?php echo $len['profileimage']; ?>" alt="Profile" class="rounded-circle">
                        <?php else : ?>
                            <img src="assets/img/profile-img.jpg" alt="Default Profile" class="rounded-circle">
                        <?php endif; ?>

                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $len['full_name']; ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= $len['full_name']; ?></h6>
                            <span><?= $len['job']; ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                <i class="bi bi-gear"></i>
                                <span> See profile</span>
                            </a>
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


    <a href="" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script>
        function openLink(path) {
            var url = 'http://' + path; // You may need to adjust the protocol (http/https) based on your needs
            window.open(url, '_blank');
        }
    </script>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Summernote JS - CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#summernote").summernote({
                height: 300, // Set the height to 300px
                width : 800
            });
        });
    </script>

    <!-- //Summernote JS - CDN Link -->

</body>

</html>