<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YourBlogs</title>

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <!-- Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
    /* Custom CSS to remove border */
    .navbar-expand-lg.navbar-light.fixed-top {
      border: none;
    }

    @media (max-width: 992px) {
      body {
        overflow-x: hidden; /* Prevent scrolling when the navbar is open */
      }

      .navbar-collapse {
        position: fixed;
        top: 50px;
        left: 0;
        padding-left: 15px;
        padding-right: 15px;
        padding-bottom: 15px;
        width: 75%;
        height: 100%;
        background-color: black; /* Set background color to black */
        color: white; /* Set text color to white */
      }

      .navbar-collapse.collapsing {
        left: -75%;
        transition: height 0s ease;
      }

      .navbar-collapse.show {
        left: 0;
        transition: left 300ms ease-in-out;
      }

      .navbar-toggler.collapsed~.navbar-collapse {
        transition: left 500ms ease-in-out;
      }

      .navbar-nav .nav-link {
        color: white !important; /* Set text color of nav items to white */
        font-weight: bold;
      }

      .form-control,
      .btn-outline-primary {
        display: none; /* Hide search input and button */
      }
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top pl-2 pr-2" style="background-color: #FFFFFF; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <div class="container order-first">
      <a class="navbar-brand" href="/" style="color: black; font-weight: bold;">
        <h4>YourBlogs</h4>
      </a>
      <button class="navbar-toggler navbar-toggler-start flex-lg-grow-0" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-lg-last flex-lg-shrink-0" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 " style="--bs-scroll-height: 100px;">
          <?php
          $query = "SELECT * FROM menu";
          $r = mysqli_query($con, $query);
          while ($menu = mysqli_fetch_assoc($r)) {
            $no = getsubmenuno($con, $menu['id']);
            if (!$no) {
          ?>
              <li class="nav-item">
                <a class="nav-link" style="text-decoration:none;color:black; font-weight:bold;" aria-current="page" href="<?= $menu['action'] ?>"><?= $menu['name'] ?></a>
              </li>
            <?php
            } else {
            ?>
              <li class="nav-item dropdown">
                <a style="text-decoration:none;color:black; font-weight:bold;" class="nav-link dropdown-toggle" href="<?= $menu['action'] ?>" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?= $menu['name'] ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                  <?php
                  $submenues = getsubmenu($con, $menu['id']);
                  foreach ($submenues as $sm) {
                  ?>
                    <li><a class="dropdown-item" href="<?= $sm['action'] ?>"><?= $sm['name'] ?></a></li>
                  <?php
                  }
                  ?>
                </ul>
              </li>
          <?php
            }
          }
          ?>
        </ul>
        <form action="searchresult.php" method="get" class="d-flex mt-2">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <script>
    // Close navbar when clicking anywhere on the screen
    $(document).on('click', function(event) {
      var target = $(event.target);
      if (!target.closest('.navbar').length && $('.navbar-collapse').hasClass('show')) {
        $('.navbar-toggler').trigger('click');
      }
    });
  </script>

</body>

</html>
