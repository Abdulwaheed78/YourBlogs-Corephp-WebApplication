<style>
  /* Custom CSS to remove border */
  .navbar-expand-lg.navbar-light.fixed-top {
    border: none;
  }
</style>

<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #FFFFFF; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
  <div class="container">
    <a class="navbar-brand" href="/" style="color:black; font-weight:bold;">
      <h4>YourBlogs</h4>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
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
              <a style="text-decoration:none;color:black; font-weight:bold;" class="nav-link dropdown-toggle" href="<?= $menu['action'] ?>" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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