<?php ?>
<nav class="navbar sticky-top navbar-expand-lg navbar-blue bg-blue" style="background-color:blue;">

  <b><a class="navbar-brand" href="/blog" style="color:#FFC300 ; margin-left:25px; font-size: 35;">YourBlogs</a></b>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarScroll">
    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
      <?php $query = "SELECT * FROM menu";

      $r = mysqli_query($con, $query);
      while ($menu = mysqli_fetch_assoc($r)) {
        $no = getsubmenuno($con, $menu['id']);
        if (!$no) { ?>
          <li class="nav-item " style="color:white;">
            <a class="nav-link" style="color:white; font-size:25px;" aria-current="page" href="<?= $menu['action'] ?>"><?= $menu['name'] ?></a>
          </li>

        <?php
        } else {
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="<?= $menu['action'] ?>" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $menu['name'] ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <?php $submenues = getsubmenu($con, $menu['id']);
              foreach ($submenues as $sm) {  ?>
                <li><a class="dropdown-item" style="color:white" href="<?= $sm['action'] ?>"><?= $sm['name'] ?></a></li>
              <?php  } ?>

            </ul>
          </li>
        <?php  } ?>
      <?php
      } ?>



    </ul><!--
    <form class="d-flex" style="margin-right:55px; margin-top:6px;">
      <input class="form-control me-4" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-danger" type="submit">Search</button>
    </form>-->
  </div>

</nav>